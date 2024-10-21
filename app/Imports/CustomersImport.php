<?php

namespace App\Imports;

use App\Models\OperationTasksModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB, Session;

class CustomersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {

        $cust_token = 'token_' . uniqid();

        // dd($row);
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $cust_name = $row['name'];
        $cust_business = $row['business'];
        $cust_email = $row['email'];
        $cust_mobile = $row['mobile'];
        $cust_state = $row['state'];
        $cust_city = $row['city'];
        $cust_service = $row['service'];
        $cust_paid_amount = $row['paid'];
        $cust_unpaid_amount = $row['unpaid'];
        $cust_due_date = $row['due'];
        $cust_comment = $row['comment'];
        $cust_total_service_price = $row['amount'];
        $cust_payment_mode = $row['emi'];
        $apply_coupon = $row['coupon'];
        $cust_token = $cust_token;


        // dd($data);

        // Use try-catch block to handle potential exceptions during insertion
        try {




            $leadID = DB::table('leads')->insertGetId([
                'name' => $cust_name,
                'email' => $cust_email,
                'contact' => $cust_mobile,
                'service' => $cust_service,
                'state' => $cust_state,
                'city' => $cust_city,
                'added_by' => $user_id,
                'lead_type' => 1,
                'company_id' => $company_id,
            ]);

            $custID = DB::table('customers')->insertGetId([
                'lead_id' => $leadID,
                'name' => $cust_name,
                'business' => $cust_business,
                'email' => $cust_email,
                'contact' => $cust_mobile,
                'service' => $cust_service,
                'service_price' => $cust_total_service_price,
                'state' => $cust_state,
                'city' => $cust_city,
                'password' => 123456,
                'company_id' => $company_id,
                'customer_token' => $cust_token,
                'added_by' => $user_id,
            ]);



            $order_id = 'order_' . uniqid();
            $payment_id = 'offline_' . uniqid();
            $oID = DB::table('orders')->insertGetId([
                'customer_id' => $custID,
                'package_id' => $cust_service,
                'order_id' => $order_id,
                'payment_id' => $payment_id,
                'total_amount' => $cust_paid_amount,
                'payment_status' => 1,
            ]);

            if (!empty($apply_coupon)) {
                $coupons = DB::table('coupons')->where('coupon_name', $apply_coupon)->get();
                $couponID = '';
                $couponR = '';
                foreach ($coupons as $coupon) {
                    $couponID = $coupon->coupon_id;
                    $couponR = $coupon->coupon_remaining;
                }
                $cReam = $couponR - 1;

                if ($cReam == 0) {
                    DB::table('coupons')->where('coupon_id', $couponID)
                        ->update(['coupon_remaining' => $cReam, 'is_active' => 1]);
                } else {
                    DB::table('coupons')->where('coupon_id', $couponID)
                        ->update(['coupon_remaining' => $cReam]);
                }
            }

            $emi =  DB::table('customer_emi')->insertGetId([
                'customer_id' => $custID,
                'order_id' => $oID,
                'emi_type' => $cust_payment_mode,
                'emi_total_amount' => $cust_total_service_price,
                'emi_paid_amount' => $cust_paid_amount,
                'emi_unpaid_amount' => $cust_unpaid_amount,
                'emi_due_date' => $cust_due_date,
                'emi_comment' => $cust_comment,
            ]);
            // dd($emi);
            $s_name = DB::select("SELECT s.service_name,s.service_id FROM combo_packages cp
                LEFT JOIN services s ON cp.cp_title = s.service_id
                WHERE cp.cp_id = '$cust_service'");


            // dd($s_name);
            $ss = '';
            $sid = '';
            foreach ($s_name as $key) {
                $ss = $key->service_name;
                $sid = $key->service_id;
            }


            $data = [
                'cust_id' => $custID,
                'service_id' => $sid,
                'task_name' => $ss,
                'added_by' => $user_id,
            ];
            // dd($data);
            return new OperationTasksModel($data);
        } catch (\Exception $e) {
            // dd($e->getMessage());

            // Handle the exception (e.g., log the error)
            return ['success' => false, 'msg' => "Something went wrong: " . $e->getMessage()];
        }
    }
}
