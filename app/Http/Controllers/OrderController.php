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


class OrderController extends Controller
{
    public function BuyFree(Request $request)
    {
        $user_id = Session::get('user_id');
        $token = $request->_token;
        $total_amount = DB::select("SELECT SUM(service_price) as total_amount FROM cart WHERE cust_id = '$user_id'");
        $items = DB::table('cart')->where('cust_id', $user_id)->get();

        dd($items);
    }

    // ---------------------------------------------------------------------
    // ---------------------------------------------------------------------

    // phone pay payment
    public function index()
    {
        // return view('customer.payment-form');
        return response()->json(['result' => 15]);
    }


    public function submitPaymentForm(Request $request)
    {

        // dd($request);
        $request->validate([
            'amount' => 'required',
            'name' => 'required',
        ]);
        $amount = $request->input('amount');
        $name = $request->input('name');

        $customer_id = Session::get('user_id');


        $category_id = $request->input('final_category_id');
        $service_id = $request->input('final_service_id');
        $item_amount = $request->input('final_item_amount');


        $service_ids = array_map('intval', explode(',', $service_id[0]));
        $category_ids = array_map('intval', explode(',', $category_id[0]));
        $item_amounts = array_map('intval', explode(',', $item_amount[0]));

        // dd($data);

        if ($name != '' && $amount != '') {

            $merchantId = env('MERCHANT_ID');

            $redirectUrl = route('confirm');
            $order_id = uniqid();

            // $transaction_data = [
            //     'merchantId' => $merchantId,
            //     'merchantTransactionId' => $order_id,
            //     'merchantUserId' => $order_id,
            //     'amount' => $amount * 100,
            //     'redirectUrl' => $redirectUrl,
            //     'redirectMode' => 'POST',
            //     'callbackUrl' => $redirectUrl,
            //     'paymentInstrument' => [
            //         'type' => 'PAY_PAGE',
            //     ],
            // ];

            // --------------------------------------------------------------------------------//


            $transaction_data = [
                'merchantId' => $merchantId,
                'merchantTransactionId' => $order_id,
                'merchantUserId' => $order_id,
                'amount' => $amount * 100,
                'redirectUrl' => $redirectUrl,
                'redirectMode' => 'POST',
                'callbackUrl' => $redirectUrl,
                'paymentInstrument' => [
                    'type' => 'PAY_PAGE',
                ],
            ];

            $merchantKey = env('SALT_KEY');
            $payloadMain = base64_encode(json_encode($transaction_data));
            $payload = $payloadMain . '/pg/v1/pay' . $merchantKey;
            $checksum = hash('sha256', $payload);
            $finalChecksum = $checksum . '###1';

            // ------------------------------------------------------------------------------------//

            $requestData = json_encode(['request' => $payloadMain]);

            $httpClient = new \GuzzleHttp\Client();

            try {
                $response = $httpClient->post('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay', [
                    'headers' => [

                        'X-VERIFY' => $finalChecksum,
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $requestData,
                ]);

                $res = json_decode($response->getBody());
                // dd($res);
                // Store information into database
                $data = [
                    'total_amount' => $amount,
                    'transaction_id' => $order_id,
                    'payment_status' => 'PAYMENT_PENDING',
                    'response_msg' => $response->getBody(),
                    'providerReferenceId' => '',
                    'merchantOrderId' => '',
                    'checksum' => '',
                ];
                // dd($data);

                DB::table('orders')->insert($data);

                for ($i = 0; $i < count($service_ids); $i++) {
                    $service_id = $service_ids[$i];
                    $category_id = $category_ids[$i];
                    $item_amount = $item_amounts[$i];

                    DB::table('order_items')->insert([
                        'order_id' => $order_id,
                        'customer_id' => $customer_id,
                        'category_id' => $category_id,
                        'service_id' => $service_id,
                        'item_amount' => $item_amount,

                    ]);
                }


                if (isset($res->code) && ($res->code == 'PAYMENT_INITIATED')) {
                    $payUrl = $res->data->instrumentResponse->redirectInfo->url;
                    return redirect()->to($payUrl);
                } else {
                    // HANDLE YOUR ERROR MESSAGE HERE
                    dd('ERROR : ' . $res);
                }
            } catch (\Exception $e) {
                // Handle exception
                dd('Exception: ' . $e->getMessage());
            }
        }
    }



    public function confirmPayment(Request $request)
    {

        $cust_id = Session::get('user_id');

        if ($request->code == 'PAYMENT_SUCCESS') {
            // dd($request);
            $transactionId = $request->transactionId;
            $providerReferenceId = $request->providerReferenceId;
            $merchantOrderId = $request->merchantOrderId;
            // $merchantOrderId = 'sa24@sgdhjg63u2h64bnyuu23h';
            $checksum = $request->checksum;
            // dd($merchantOrderId);
            // Transaction completed, You can add transaction details into the database
            $data = [
                'providerReferenceId' => $providerReferenceId,
                'checksum' => $checksum,
                'payment_status' => 'PAYMENT_SUCCESS',
            ];

            if ($merchantOrderId != '') {
                $data['merchantOrderId'] = $merchantOrderId;
            }

            // Use Eloquent for updates if you have an Eloquent model for orders
            // Order::where('transaction_id', $transactionId)->update($data);
            DB::table('cart')->where('cust_id', $cust_id)->delete();
            DB::table('orders')->where('transaction_id', $transactionId)->update($data);
            DB::table('order_items')->where('order_id', $transactionId)->update(['is_paid' => 1]);

            // return view('customer.confirm_payment', compact('providerReferenceId', 'transactionId'));
            return redirect('/customer-my-services')->with('success', 'Order Purchase Successful!!');
        } else {
            // HANDLE YOUR ERROR MESSAGE HERE
            // return redirect('/customer-all-services')->with('error', 'wrong');
            // dd($request);
            dd('ERROR : ' . $request . ', Please Try Again Later.');
        }
    }


    

    public function initiatePayment(Request $request)
    {
        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');
        // $amount = $request->amount;
        // $api = new Api($api_key, $api_secret);

        // $order = $api->order->create([
        //     'amount' => $amount * 100,
        //     'currency' => 'INR',
        //     'payment_capture' => 1,
        // ]);


        $amount = $request->input('amount');
        $package_id = $request->input('package_id');
        $customer_id = Session::get('user_id');

        $api = new Api($api_key, $api_secret);
        $order  = $api->order->create(array('receipt' => 'ETaxwala', 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order
        $orderId = $order['id'];


        $columns = ['combo_packages.cp_type', 'services.service_name'];
        $pkgs = DB::table('combo_packages')->select($columns)
            ->leftjoin('services', 'services.service_id', '=', 'combo_packages.cp_title')
            ->where('cp_id', $package_id)->get();
        $package_name = $pkgs[0]->service_name;
        $package_type = $pkgs[0]->cp_type;

        // insert data in table
        $data = [
            'customer_id' => $customer_id,
            'package_id' => $package_id,
            'order_id' => $orderId,
            'total_amount' => $amount,
        ];
        // dd($data);

        $oID = DB::table('orders')->insertGetId($data);

        DB::table('customer_emi')->insertGetId([
            'customer_id' => $customer_id,
            'order_id' => $oID,
            'emi_type' => 1,
            'emi_total_amount' => $amount,
            'emi_paid_amount' => $amount,
            'emi_unpaid_amount' => 0,
            'emi_comment' => 'online paid'
        ]);

        // $s_name = DB::select("SELECT s.service_name,s.service_id FROM combo_packages cp LEFT JOIN services s ON cp.cp_title = s.service_id WHERE cp.cp_id = '$package_id'");


        // // dd($s_name);
        // $ss = '';
        // $sid = '';
        // foreach ($s_name as $key) {
        //     $ss = $key->service_name;
        //     $sid = $key->service_id;
        // }

        // dd($ss);
        // DB::table('operation_tasks')->insertGetId([
        //     'cust_id' => $customer_id,
        //     'service_id' => $sid,
        //     'task_name' => $ss,
        //     'added_by' => $customer_id,
        // ]);

       $columns2 = ['name', 'email', 'contact'];
        $customer = DB::table('customers')->select($columns2)->where('id', $customer_id)->get();

        $customer_name = $customer[0]->name;
        $customer_email = $customer[0]->email;
        $customer_contact = $customer[0]->contact;



        $details = [
            'name' => $customer_name,
            'email' => $customer_email,
            'contact' => $customer_contact,
            'package_name' => $package_name,
            'package_type' => $package_type,
        ];
        // dd($details);

        return view('customer.payment-form', compact('order','details'));
        // return view('customer.payment-form');
    }

    public function RXPay(Request $request)
    {

        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');

        $data = $request->all();
        // dd($data);
        // $user = DB::table('orders')->where('order_id', $data['razorpay_order_id'])->first();
        // $user->payment_status = 1;
        // $user->payment_id = $data['razorpay_payment_id'];

        $api = new Api($api_key, $api_secret);


        try {
            $attributes = array(
                'razorpay_signature' => $data['razorpay_signature'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_order_id' => $data['razorpay_order_id']
            );
            $ss = $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (SignatureVerificationError $e) {

            $success = false;
        }




        if ($success) {
            DB::table('orders')->where('order_id', $data['razorpay_order_id'])
            ->update([
                'payment_status' => 1,
                'payment_id' => $data['razorpay_payment_id'],
            ]);


            return redirect('/customer-my-services')->with('success', 'Order Purchase Successful!!');
        } else {

            // dd('error');
            return redirect('/customer-all-services')->with('success', 'Payment Faild!!!');
        }

    }
    
    function subPayment(Request $request)
    {
        // dd($request);
        $amount = $request->input('amount');
        // $amount = 100;
        $package_id = $request->input('package_id');
        $customer_id = Session::get('user_id');

        $columns = ['combo_packages.cp_type', 'services.service_name'];
        $pkgs = DB::table('combo_packages')->select($columns)
            ->leftjoin('services', 'services.service_id', '=', 'combo_packages.cp_title')
            ->where('cp_id', $package_id)->get();
        $package_name = $pkgs[0]->service_name;
        $package_type = $pkgs[0]->cp_type;

        $data = [
            $amount,
            $package_id,
            $package_name,
            $package_type
        ];
        return view('customer.sub_payment', compact('data'));
    }
    
    // partner paymet functions
    function partnersubPayment(Request $request)
    {
        // dd($request);
        $amount = $request->input('customer_total_service_price');
        // $amount = 100;
        $package_id = $request->input('customer_service');
        $customer_id = Session::get('user_id');

        $columns = ['combo_packages.cp_type', 'services.service_name'];
        $pkgs = DB::table('combo_packages')->select($columns)
            ->leftjoin('services', 'services.service_id', '=', 'combo_packages.cp_title')
            ->where('cp_id', $package_id)->get();
        $package_name = $pkgs[0]->service_name;
        $package_type = $pkgs[0]->cp_type;

         $data = [
            $amount,
            $package_id,
            $package_name,
            $package_type,
            $customer_id
        ];
        return view('FED.sub_payment', compact('data'));
    }

    public function partnerinitiatePayment(Request $request)
    {
        // dd($request);
        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');


        $amount = $request->input('amount');
        // $amount = 100;
        $package_id = $request->input('package_id');
        $customer_id = Session::get('user_id');

        $columns = ['combo_packages.cp_type', 'services.service_name'];
        $pkgs = DB::table('combo_packages')->select($columns)
            ->leftjoin('services', 'services.service_id', '=', 'combo_packages.cp_title')
            ->where('cp_id', $package_id)->get();
        $package_name = $pkgs[0]->service_name;
        $package_type = $pkgs[0]->cp_type;

        $api = new Api($api_key, $api_secret);
        $order  = $api->order->create(array('receipt' => 'ETaxwala', 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order
        $orderId = $order['id'];


        // insert data in table
        $data = [
            'customer_id' => $customer_id,
            'package_id' => $package_id,
            'order_id' => $orderId,
            'total_amount' => $amount,
        ];
        // dd($data);

        $oID = DB::table('orders')->insertGetId($data);

        DB::table('customer_emi')->insertGetId([
            'customer_id' => $customer_id,
            'order_id' => $oID,
            'emi_type' => 1,
            'emi_total_amount' => $amount,
            'emi_paid_amount' => $amount,
            'emi_unpaid_amount' => 0,
            'emi_comment' => 'online paid'
        ]);

        // $s_name = DB::select("SELECT s.service_name,s.service_id FROM combo_packages cp LEFT JOIN services s ON cp.cp_title = s.service_id WHERE cp.cp_id = '$package_id'");


        // dd($s_name);
        // $ss = '';
        // $sid = '';
        // foreach ($s_name as $key) {
        //     $ss = $key->service_name;
        //     $sid = $key->service_id;
        // }

        // dd($ss);
        // DB::table('operation_tasks')->insertGetId([
        //     'cust_id' => $customer_id,
        //     'service_id' => $sid,
        //     'task_name' => $ss,
        //     'added_by' => $customer_id,
        // ]);


        $columns2 = ['name', 'email', 'contact'];
        $customer = DB::table('customers')->select($columns2)->where('id', $customer_id)->get();

        $customer_name = $customer[0]->name;
        $customer_email = $customer[0]->email;
        $customer_contact = $customer[0]->contact;



        $details = [
            'name' => $customer_name,
            'email' => $customer_email,
            'contact' => $customer_contact,
            'package_name' => $package_name,
            'package_type' => $package_type,
        ];
        // dd($details);

        return view('FED.payment-form', compact('order', 'details'));
        // return view('customer.payment-form');
        // $data = [
        //     $order,
        //     $details
        // ];
        // return $data;
    }

    public function partnerRXPay(Request $request)
    {

        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');

        $data = $request->all();

        $api = new Api($api_key, $api_secret);


        try {
            $attributes = array(
                'razorpay_signature' => $data['razorpay_signature'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_order_id' => $data['razorpay_order_id']
            );
            $ss = $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (SignatureVerificationError $e) {

            $success = false;
        }




        if ($success) {
            DB::table('orders')->where('order_id', $data['razorpay_order_id'])
                ->update([
                    'payment_status' => 1,
                    'payment_id' => $data['razorpay_payment_id'],
                ]);


            return redirect('/franchise-partner-customer-orders')->with('success', 'Order Purchase Successful!!');
        } else {

            // dd('error');
            return redirect('/franchise-partner-all-services')->with('success', 'Payment Faild!!!');
        }
    }
    
    
    
    
    // payment link and webhook routes
    
    // partial payment testing
    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }
    public function createPaymentLink(Request $request)
    {
        // dd('dddd');
        $amount = 500; // Amount in paise (e.g., 100.00 INR)
        // vYiMqj_A7_h9Tcu

        $name = 'Santosh Asole Ok';
        try {
            $data = [
                'amount' => $amount,
                'currency' => 'INR',
                'accept_partial' => false,
                'first_min_partial_amount' => 0,
                'description' => 'Payment for Order #12345',
                'customer' => [
                    'name' => $name,
                    'contact' => '7030258579',
                    'email' => 'santoshasole9@gmail.com'
                ],
                'notify' => [
                    'sms' => true,
                    'email' => true
                ],
                'reminder_enable' => false,
                'expire_by' => strtotime('+1 day')
            ];

            $paymentLink = $this->razorpay->paymentLink->create($data);
            Log::info('payment link generate ', ['payment_link' => $paymentLink['short_url']]);
            return response()->json([
                'status' => 'success',
                'payment_link' => $paymentLink['short_url']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


// appointment
public function bookAppointment(Request $request)
    {
        // dd($request);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'city' => 'required',
            'message' => 'required',
        ]);


        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');
        $amount = 499;


        $api = new Api($api_key, $api_secret);
        $order  = $api->order->create(array('receipt' => 'ETaxwala', 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order
        $orderId = $order['id'];


        // insert data in table
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'message' => $request->message,
            'added_by' => 'Online Form',
            'order_id' => $orderId,
            'amount' => $amount,
        ];
        // dd($data);

        $oID = DB::table('appointments')->insertGetId($data);
        // DB::table('appointments')->insert($validated);

        // return redirect()->route('pay.appointment', compact('data'));
        return view('appointment_payment', compact('data'));
        // return response()->json([
        //     'message' => "Thanks for Booking...!",
        // ]);
    }





    public function AppointmentPaymentPage(Request $request)
    {
        return view('appointment_payment');
    }


    public function AppointmentPaymentNow(Request $request)
    {
        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');

        $data = $request->all();

        $api = new Api($api_key, $api_secret);


        try {
            $attributes = array(
                'razorpay_signature' => $data['razorpay_signature'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_order_id' => $data['razorpay_order_id']
            );
            $ss = $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (SignatureVerificationError $e) {

            $success = false;
        }




        if ($success) {
            DB::table('appointments')->where('order_id', $data['razorpay_order_id'])
                ->update([
                    'payment_status' => 1,
                    'payment_id' => $data['razorpay_payment_id'],
                ]);


            return redirect('/appointment')->with('success', 'Appointment Book Successful!!');
        } else {

            // dd('error');
            return redirect('/appointment')->with('success', 'Payment Faild!!!');
        }
    }

    

    
    
    
    
}
