<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use DB, Session;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class WebhookController extends Controller
{

    public function handleWebhook(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Webhook received', ['request' => $request->all()]);

        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
        $razorpaySignature = $request->header('X-Razorpay-Signature');
        $payload = $request->getContent();
        
        $generatedSignature = hash_hmac('sha256', $payload, $webhookSecret);

        if ($razorpaySignature !== $generatedSignature) {
            Log::error('Invalid webhook signature', [
                'received' => $razorpaySignature,
                'generated' => $generatedSignature,
            ]);
            return response()->json(['error' => 'Invalid webhook signature'], 403);
        }

        $event = json_decode($payload, true);
        Log::info('Parsed event', ['event' => $event]);

        if ($event && isset($event['event'])) {
            switch ($event['event']) {
                case 'payment_link.paid':
                    $order_id = $event['payload']['payment_link']['entity']['id'];
                    $payment_id = $event['payload']['payment_link']['entity']['order_id'];
                    $amount = $event['payload']['payment_link']['entity']['amount'];
                    $link_url = $event['payload']['payment_link']['entity']['short_url'];
                    try {



                        DB::table('customer_payment_links')
                            ->where('link_url', $link_url)
                            ->update([
                                'order_id' => $order_id,
                                'payment_id' => $payment_id,
                                'amount' => $amount,
                                'is_payment' => 1,
                            ]);

                        $emiID = DB::table('customer_payment_links')->select('emi_id')->where('link_url', $link_url)->get();

                        $emi_data = DB::table('customer_emi')->select('emi_total_amount', 'emi_paid_amount', 'emi_unpaid_amount')->where('emi_id',  $emiID[0]->emi_id)->get();

                        $total = $emi_data[0]->emi_total_amount;
                        $paid = $emi_data[0]->emi_paid_amount;
                        $unpaid = $emi_data[0]->emi_unpaid_amount;
                        $total_paid = $paid + $amount;
                        $total_unpaid = $total - $total_paid;

                        DB::table('customer_emi')->where('emi_id', $emiID[0]->emi_id)
                            ->update([
                                'emi_paid_amount' => $total_paid,
                                'emi_unpaid_amount' => $total_unpaid,

                            ]);

                        DB::table('customer_emi')->where('emi_id', $emiID[0]->emi_id)
                            ->when($total_unpaid == 0, function ($query) {
                                $query->update(['emi_due_date' => null]);
                            });

                        return response()->json(['status' => 'success']);
                    } catch (\Exception $e) {
                        Log::error('Database insertion error', ['message' => $e->getMessage()]);
                        return response()->json(['error' => 'Database error'], 500);
                    }

                default:
                    Log::warning('Unhandled event type', ['event' => $event['event']]);
                    return response()->json(['error' => 'Unhandled event type']);
            }
        }

        Log::error('Invalid webhook event', ['payload' => $payload]);
        return response()->json(['error' => 'Invalid webhook event'], 400);
    }
}
