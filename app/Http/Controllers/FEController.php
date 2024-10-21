<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use App\Imports\LeadsImport;
use App\Imports\PartnerBulkLeads;
// use Maatwebsite\Excel\Facades\Excel;


class FEController extends Controller
{
    public function Dashboard(Request $request)
    {
        $user_id = Session::get('user_id');
        $chattings = DB::select("SELECT cc.chat_msg, cc.service_id, cc.date, s.service_name, c.name FROM customer_chatting cc
                INNER JOIN ( SELECT MAX(chat_id) as max_chat_id FROM customer_chatting
                    GROUP BY service_id ) max_chats ON cc.chat_id = max_chats.max_chat_id
                    INNER JOIN services s ON cc.service_id=s.service_id
                    INNER JOIN customers c ON c.id=cc.chat_from
                    WHERE c.is_partner = 2 AND c.added_by = $user_id
                    ORDER BY cc.chat_id DESC");

        // dd($chattings);

        $services = DB::select("SELECT cwt.work, cwt.status, cwt.service_id, cwt.date, s.service_name, c.name FROM customer_work_timeline cwt
                INNER JOIN ( SELECT MAX(id) as max_cwt_id FROM customer_work_timeline
                    GROUP BY service_id ) max_chats ON cwt.id = max_chats.max_cwt_id
                    INNER JOIN services s ON cwt.service_id=s.service_id
                    INNER JOIN customers c ON c.id=cwt.cust_id
                    WHERE c.is_partner = 2 AND c.added_by = $user_id
                    ORDER BY cwt.id DESC");

        // dd($data);
        return view('FED.dashboard', compact('chattings', 'services'));
    }

    public function ManageClient(Request $request)
    {
        $user_id = Session::get('user_id');
        // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' ORDER BY l.id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, s.service_name as SName FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN lead_assign as la ON la.lead_id = l.id
            LEFT JOIN services as s ON s.service_id = l.service
            WHERE la.assign_to = '$user_id'
            AND l.lead_type = 2 AND l.is_customer = 0
            ORDER BY l.id DESC");

            return Datatables::of($data)

                ->addColumn('mark', function ($data) {
                    return '<svg style="cursor: pointer" class="text-success" onclick="GetRemarks(' . $data->id . ')"
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>';
                })
                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="SalesLeadDetails2(' . $data->id . ')">' . $data->name . '</span>';
                })
                ->addColumn('mark3', function ($data) {
                    $s_name = ($data->SName !== null) ? $data->SName : $data->service;
                    return $s_name;
                })


                ->rawColumns(['mark', 'mark2', 'mark3'])
                ->make(true);
        }

        $categories = DB::table('categories')->get();
        $services = DB::table('services')->get();
        return view('FED.manage_clients', compact('categories', 'services'));
    }

    public function AddFClient(Request $request)
    {
        $company_id = Session::get('company_id');
        $user_id = Session::get('user_id');
        $AddLead = DB::table('leads')->insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'service' => $request->input('service'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'added_by' => $user_id,
            'lead_type' => 2,
            'company_id' => $company_id
        ]);

        DB::table('lead_assign')
            ->insertGetId([
                'lead_id' => $AddLead,
                'assign_to' => $user_id,
                'lead_type' => 2,
            ]);

        DB::table('leads')->where('id', $AddLead)
            ->update(['is_assign' => 1]);

        if ($AddLead != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function UpdateFClient(Request $request)
    {
        DB::table('leads')
            ->where('id', $request->input('lead_id'))
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'service' => $request->input('service'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
            ]);
    }

    public function GetEmpLeadCount(Request $request)
    {
        $user_id = Session::get('user_id');

        $data = [
            'totalLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->count(),
            'newLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 0)->count(),
            'notintrestedLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 1)->count(),
            'intrestedLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 2)->count(),
            'quotationLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 3)->count(),
            'hotLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 4)->count(),
            'customerLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 5)->count(),
            'notconnectedLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 6)->count(),
            'negotiationLeads' => DB::table('lead_assign')->where('assign_to', $user_id)->where('lead_status', 7)->count(),
        ];

        return response()->json(['data' => $data]);
    }

    public function UpdateLeadStatus(Request $request)
    {
        // dd($request);

        $user_id = Session::get('user_id');
        $lead_id = $request->lead_id2;
        $lead_status = $request->lead_status;
        $lead_remark = $request->lead_remark;
        $token = $request->_token;

        $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id'");

        if (count($customer) > 0) {
            return response()->json(['success' => false,  'message' => 'Already Customer!!']);
        } else {
            if ($lead_status == 5) {



                $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
                    'user_id' => $user_id,
                    'lead_id' => $lead_id,
                    'lead_status' => $lead_status,
                    'lead_remark' => $lead_remark,
                ]);

                DB::table('lead_assign')
                    ->where('lead_id', $lead_id)
                    ->update([
                        'lead_status' => $lead_status,
                    ]);
                DB::table('leads')
                    ->where('id', $lead_id)
                    ->update([
                        'is_customer' => 1,
                    ]);

                $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id'");
                if (count($customer) == 0) {
                    $clients = DB::select("SELECT * FROM leads WHERE id = '$lead_id'");

                    foreach ($clients as $client) {
                        // dd($client->name);
                        DB::table('customers')->insertGetId([
                            'lead_id' => $client->id,
                            'name' => $client->name,
                            'email' => $client->email,
                            'contact' => $client->contact,
                            'service' => $client->service,
                            'state' => $client->state,
                            'city' => $client->city,
                            'customer_token' => $token,
                            'added_by' => $user_id,
                            'is_partner' => 2,
                        ]);
                    }
                }



                if ($AddLeadRemark != 0) {
                    return redirect()->back();
                } else {
                    return redirect()->back();
                }
            } else {
                $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
                    'user_id' => $user_id,
                    'lead_id' => $lead_id,
                    'lead_status' => $lead_status,
                    'lead_remark' => $lead_remark,
                ]);

                DB::table('lead_assign')
                    ->where('lead_id', $lead_id)
                    ->update([
                        'lead_status' => $lead_status,
                    ]);

                if ($AddLeadRemark != 0) {
                    return redirect()->back();
                } else {
                    return redirect()->back();
                }
            }
        }
    }

    public function AddLeadFollowup(Request $request)
    {
        $user_id = Session::get('user_id');
        $lead_id = $request->lead_id3;
        $followup_date = $request->followup_date;
        $followup_remark = $request->followup_remark;

        $AddLeadRemark = DB::table('lead_followups')->insertGetId([
            'user_id' => $user_id,
            'lead_id' => $lead_id,
            'followup_date' => $followup_date,
            'followup_remark' => $followup_remark,
        ]);

        if ($AddLeadRemark != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function GetLeadRemarks(Request $request)
    {
        $lead_id = $request->lead_id;
        // dd($lead_id);
        $data = DB::table('lead_remarks')->where('lead_id', $lead_id)->get();
        // $data = json_encode($data);
        return response()->json(['data' => $data]);
    }

    public function GetFollowupCalls()
    {
        $user_id = Session::get('user_id');
        $date = Date('Y-m-d');
        $followupcalls = DB::select("SELECT * FROM lead_followups
        LEFT JOIN leads ON lead_followups.lead_id = leads.id
        WHERE lead_followups.user_id = '$user_id'
        AND lead_followups.followup_date = '$date'
        ORDER BY lead_followups.id DESC");
        return response()->json(['data' => $followupcalls]);
    }

    public function EmpLeadFilter(Request $request)
    {
        $user_id = Session::get('user_id');

        $lead_status = $request->lead_status;
        // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' AND la.lead_status = '$lead_status' ORDER BY l.id DESC");

        // return response()->json(['data' => $data]);
        if ($lead_status == 'all') {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, s.service_name as SName FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN lead_assign as la ON la.lead_id = l.id
            LEFT JOIN services as s ON s.service_id = l.service
            WHERE la.assign_to = '$user_id'
            AND l.lead_type = 2 AND l.is_customer = 0
            ORDER BY l.id DESC");

            return Datatables::of($data)

                ->addColumn('mark', function ($data) {
                    return '<svg style="cursor: pointer" class="text-success" onclick="GetRemarks(' . $data->id . ')"
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>';
                })
                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="SalesLeadDetails2(' . $data->id . ')">' . $data->name . '</span>';
                })

                ->addColumn('mark3', function ($data) {
                    $s_name = ($data->SName !== null) ? $data->SName : $data->service;
                    return $s_name;
                })


                ->rawColumns(['mark', 'mark2', 'mark3'])
                ->make(true);
        } else {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, s.service_name as SName FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN lead_assign as la ON la.lead_id = l.id
            LEFT JOIN services as s ON s.service_id = l.service
            WHERE la.assign_to = '$user_id'
            AND la.lead_status = '$lead_status'
            AND l.lead_type = 2 AND l.is_customer = 0
            ORDER BY l.id DESC");

            return Datatables::of($data)

                ->addColumn('mark', function ($data) {
                    return '<svg style="cursor: pointer" class="text-success" onclick="GetRemarks(' . $data->id . ')"
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg>';
                })
                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="SalesLeadDetails2(' . $data->id . ')">' . $data->name . '</span>';
                })

                ->addColumn('mark3', function ($data) {
                    $s_name = ($data->SName !== null) ? $data->SName : $data->service;
                    return $s_name;
                })


                ->rawColumns(['mark', 'mark2', 'mark3'])
                ->make(true);
        }
    }


    public function PartnerTraningSection(Request $request)
    {
        return view('FED.traning_section');
    }

    public function FAllServices(Request $request)
    {
        $categories = DB::table('categories')->get();
        $services = DB::select("SELECT * FROM combo_packages cp
        LEFT JOIN services s ON cp.cp_title = s.service_id");
        // dd($services);
        return view('FED.all_services', compact('categories', 'services'));
    }

    public function FCustomerOrders(Request $request)
    {


        $user_id = Session::get('user_id');
        $data = DB::select("SELECT orders.*, orders.id as orderID, cp.*, services.service_id, services.service_name, categories.category_name, customers.*, customer_emi.emi_total_amount, customer_emi.emi_unpaid_amount, customer_emi.emi_due_date, customer_payment_links.* FROM orders
        LEFT JOIN combo_packages as cp ON orders.package_id=cp.cp_id
        LEFT JOIN services ON cp.cp_title=services.service_id
        LEFT JOIN categories ON services.category_id = categories.category_id
        LEFT JOIN customers ON orders.customer_id=customers.id
        LEFT JOIN customer_emi ON customer_emi.order_id = orders.id
        LEFT JOIN customer_payment_links ON customer_payment_links.customer_id = orders.customer_id
        WHERE orders.payment_status=1 AND customers.added_by= '$user_id' AND customers.is_partner=2  ORDER BY orders.id DESC");
        // dd($data);

        if ($request->ajax()) {
            $data = DB::select("SELECT orders.*, orders.id as orderID, cp.*, services.service_id, services.service_name, categories.category_name, customers.*, customer_emi.emi_total_amount, customer_emi.emi_paid_amount, customer_emi.emi_unpaid_amount, customer_emi.emi_due_date, customer_payment_links.* FROM orders
            LEFT JOIN combo_packages as cp ON orders.package_id=cp.cp_id
            LEFT JOIN services ON cp.cp_title=services.service_id
            LEFT JOIN categories ON services.category_id = categories.category_id
            LEFT JOIN customers ON orders.customer_id=customers.id
            LEFT JOIN customer_emi ON customer_emi.order_id = orders.id
            LEFT JOIN customer_payment_links ON customer_payment_links.customer_id = orders.customer_id
            WHERE orders.payment_status=1 AND customers.added_by= '$user_id' AND customers.is_partner=2  ORDER BY orders.id DESC");

            // make orders details


            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg style="cursor:pointer" onclick="AddWorkEffort(' . $data->customer_id . ',' . $data->service_id . ',' . $data->is_approve . ' )" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </span>';
                })

                ->addColumn('mark1', function ($data) {
                    // Create the URL using the route function and then embed it in the returned HTML.
                    $url = route("franchise-single-service", ['service_id' => $data->cp_title, 'customer_id' => $data->customer_id]);
                    return '<a href="' . $url . '">' . htmlspecialchars($data->service_name, ENT_QUOTES, 'UTF-8') . '</a>';
                })


                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="GetCustomerTasks123(' . $data->customer_id . ',' . $data->orderID . ',' . $data->service_id . ',' . $data->is_approve . ')">' . $data->name . '</span>';
                })
                ->addColumn('mark3', function ($data) {
                    $payment_link = $data->link_url;
                    $link = '<a class="badge bg-info me-1 text-white" target="_blanks" href="' . $payment_link . '">Pay Rs - ' . htmlspecialchars($data->emi_unpaid_amount, ENT_QUOTES, 'UTF-8') . '</a>';

                    $pay_now = $data->emi_unpaid_amount ? $link : $data->emi_unpaid_amount;
                    return $pay_now;
                })


                ->rawColumns(['action', 'mark2', 'mark1', 'mark3'])
                ->make(true);
        }

        $oemployees = DB::select("SELECT * FROM users WHERE user_type = 7 ORDER BY id DESC");

        $categories = DB::select("SELECT * FROM categories");
        // dd($services);

        return view('FED.customer_orders', compact('categories'));
    }

    public function FCustomersInquries(Request $request)
    {
        $company_id = Session::get('company_id');
        // $data = DB::select("SELECT * FROM customer_inquiries as ci
        //     LEFT JOIN customers as c ON ci.cust_id = c.id
        //     LEFT JOIN services as s ON ci.service_id=s.service_id
        //     WHERE ci.inquiry_from = 1
        //     ORDER BY ci.inq_id DESC");
        //     dd($data);

        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM customer_inquiries as ci
            LEFT JOIN customers as c ON ci.cust_id = c.id
            LEFT JOIN services as s ON ci.service_id=s.service_id
            WHERE ci.inquiry_from = 2
            ORDER BY ci.inq_id DESC");

            return Datatables::of($data)

                ->make(true);
        }
        return view('FED.inquries');
    }

    function getLeadInfo(Request $request)
    {
        $leadID = $request->leadID;
        $data = DB::table('leads')->where('id', $leadID)->get();
        // return response()->json(['data' => $data]);
        return $data;
    }


    function AddOfflineCustomer(Request $request)
    {
        // dd($request);
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $cust_name = $request->customer_name;
        $cust_business = $request->customer_businessName;
        $cust_email = $request->customer_email;
        $cust_mobile = $request->customer_mobile;
        $cust_state = $request->customer_state;
        $cust_city = $request->customer_city;
        $cust_service = $request->customer_service;
        $cust_paid_amount = $request->customer_paid_amount;
        $cust_unpaid_amount = $request->customer_unpaid_amount;
        $cust_due_date = $request->customer_due_date;
        $cust_comment = $request->customer_comment;
        $cust_total_service_price = $request->customer_total_service_price;
        $cust_payment_mode = $request->customer_payment_mode;
        $cust_token = $request->_token;
        $apply_coupon = $request->apply_coupon;
        $leadID = $request->lead_id3;
        // $payment_screenshot = $request->file('payment_screenshot');



        // dd('error');


        $check__customer = DB::table('customers')->where('lead_id', $leadID)->get();

        if (count($check__customer) > 0) {
            // return redirect()->back()->with('error', 'Already Customer Found');
            // return response()->json([
            //     'error' => 'Resource not found.',
            // ], 500);
            return response()->json(['success' => false, 'error' => 'Already Customer Found']);
        }


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
            'is_partner' => 2,
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


        $payment_screenshot = null;
        if (request()->hasFile('payment_screenshot')) {
            // Get the file from the request
            $HLogo = request()->file('payment_screenshot');

            // Generate a unique filename based on the original name and current timestamp
            $payment_screenshot = md5($HLogo->getClientOriginalName() . time()) . "." . $HLogo->getClientOriginalExtension();

            // Define the destination path where the file will be stored (public/blogs)
            $destinationPath = public_path('/payment');

            // Move the uploaded file to the destination path with the generated filename
            $HLogo->move($destinationPath, $payment_screenshot);
        }


        // if (isNull($payment_screenshot)) {
        //     dd($payment_screenshot);
        // } else {
        //     dd('null2');
        // }




        DB::table('customer_emi')->insertGetId([
            'customer_id' => $custID,
            'order_id' => $oID,
            'emi_type' => $cust_payment_mode,
            'emi_total_amount' => $cust_total_service_price,
            'emi_paid_amount' => $cust_paid_amount,
            'emi_unpaid_amount' => $cust_unpaid_amount,
            'emi_due_date' => $cust_due_date,
            'emi_comment' => $cust_comment,
            'payment_screenshot' => $payment_screenshot,
        ]);

        DB::table('lead_remarks')->insertGetId([
            'user_id' => $user_id,
            'lead_id' => $leadID,
            'lead_status' => 5,
            'lead_remark' => $cust_comment,
        ]);

        DB::table('lead_assign')
            ->where('lead_id', $leadID)
            ->update([
                'lead_status' => 5,
            ]);
        DB::table('leads')
            ->where('id', $leadID)
            ->update([
                'is_customer' => 1,
            ]);

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

        // dd($ss);
        DB::table('operation_tasks')->insertGetId([
            'cust_id' => $custID,
            'service_id' => $sid,
            'task_name' => $ss,
            'added_by' => $user_id,
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



        if ($oID) {
            return redirect()->back()->with('success', 'Order Purchase Successful!!');
        } else {
            return redirect()->back()->with('success', 'Order Not Purchase!!');
        }
    }

    // add offline customer from franchise customer orders page
    function AddOfflineCustomerCO(Request $request)
    {
        // dd($request);
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $cust_name = $request->customer_name;
        $cust_business = $request->customer_businessName;
        $cust_email = $request->customer_email;
        $cust_mobile = $request->customer_mobile;
        $cust_state = $request->customer_state;
        $cust_city = $request->customer_city;
        $cust_service = $request->customer_service;
        $cust_paid_amount = $request->customer_paid_amount;
        $cust_unpaid_amount = $request->customer_unpaid_amount;
        $cust_due_date = $request->customer_due_date;
        $cust_comment = $request->customer_comment;
        $cust_total_service_price = $request->customer_total_service_price;
        $cust_payment_mode = $request->customer_payment_mode;
        $cust_token = $request->_token;
        $apply_coupon = $request->apply_coupon;

        $sID = DB::table('combo_packages')->select('cp_title')->where('cp_id', $cust_service)->get();
        $package_name = DB::table('services')->select('service_name')->where('service_id', $sID[0]->cp_title)->get();

        // dd($package_name[0]->service_name);
        $leadID = DB::table('leads')->insertGetId([
            'name' => $cust_name,
            'email' => $cust_email,
            'contact' => $cust_mobile,
            'service' => $cust_service,
            'state' => $cust_state,
            'city' => $cust_city,
            'added_by' => $user_id,
            'lead_type' => 2,
            'is_assign' => 1,
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
            'is_partner' => 2,
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

        $emi_id = DB::table('customer_emi')->insertGetId([
            'customer_id' => $custID,
            'order_id' => $oID,
            'emi_type' => $cust_payment_mode,
            'emi_total_amount' => $cust_total_service_price,
            'emi_paid_amount' => $cust_paid_amount,
            'emi_unpaid_amount' => $cust_unpaid_amount,
            'emi_due_date' => $cust_due_date,
            'emi_comment' => $cust_comment,
        ]);

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

        // dd($ss);
        DB::table('operation_tasks')->insertGetId([
            'cust_id' => $custID,
            'service_id' => $sid,
            'task_name' => $ss,
            'added_by' => $user_id,
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

        if ($cust_unpaid_amount > 0) {

            $name = $cust_name;
            $email = $cust_email;
            $contact = $cust_mobile;
            $amount = $cust_unpaid_amount;
            $description = 'Payment for ' . $package_name[0]->service_name;
            $expiry_date = 15;
            $customer_id = $custID;
            $package_id = $cust_service;

            $partial_payment = ($amount / 100) * 40;
            try {
                $data = [
                    'amount' => $amount * 100,
                    'currency' => 'INR',
                    'accept_partial' => false,
                    'first_min_partial_amount' => 0,
                    'description' => $description,
                    'customer' => [
                        'name' => $name,
                        'contact' => $contact,
                        'email' => $email
                    ],
                    'notify' => [
                        'sms' => true,
                        'email' => false
                    ],
                    'reminder_enable' => false,
                    'expire_by' => strtotime('+' . $expiry_date . ' day')
                ];



                $paymentLink = $this->razorpay->paymentLink->create($data);
                Log::info('data log', ['data' => $paymentLink]);
                Log::info('Webhook received', ['payment_link' => $paymentLink['short_url']]);
                // dd($paymentLink['short_url']);
                DB::table('customer_payment_links')->insertGetId([
                    'link_url' => $paymentLink['short_url'],
                    'customer_id' => $customer_id,
                    'package_id' => $package_id,
                    'emi_id' => $emi_id,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        }



        if ($oID) {
            return redirect()->back()->with('success', 'Order Purchase Successful!!');
        } else {
            return redirect()->back()->with('success', 'Order Not Purchase!!');
        }
    }




    function GetPriceTotal(Request $request)
    {
        $cp_id = $request->cp_id;
        $data = DB::select("SELECT service_id, cp_type, cp_discount FROM combo_packages WHERE cp_id = '$cp_id'");

        $service_ids = []; // Initialize an array to collect service_ids
        foreach ($data as $item) {
            $service_ids[] = $item->service_id; // Collect service_ids
            $type = $item->cp_type;
            $discount = $item->cp_discount;
        }

        // dd($service_ids);

        // Prepare the string for IN clause
        $service_ids_str = implode(',', $service_ids);

        $data1 = DB::select("SELECT partner_percentage FROM services WHERE service_id IN ($service_ids_str)");
        // dd($data1);

        $service_prices = []; // Initialize an array to collect service_prices
        foreach ($data1 as $item1) {
            $service_prices[] = $item1->partner_percentage; // Collect service_prices
        }
        $sum = array_sum($service_prices);

        switch ($type) {
            case 1:
                $total = $sum - $sum * ($discount / 100);
                break;
            case 2:
                $total = $sum - $sum * ($discount / 100);
                break;
            case 3:
                $total = $sum - $sum * ($discount / 100);
                break;
            case 4:
                $total = $sum - $sum * ($discount / 100);
                break;
        }
        $final_total = floor($total);
        // dd($final_total);

        return response()->json(['data' => $final_total]);
    }

    function CustomerFilter(Request $request)
    {
        $category_id = $request->category_id;
        $package_type = $request->package_type;



        $query = $data = DB::table('orders')
            ->select('orders.*', 'orders.id as orderID', 'cp.*', 'services.service_id', 'services.service_name', 'categories.category_name', 'customers.*', 'customer_emi.emi_unpaid_amount', 'customer_emi.emi_due_date')
            ->leftJoin('combo_packages as cp', 'orders.package_id', '=', 'cp.cp_id')
            ->leftJoin('services', 'cp.cp_title', '=', 'services.service_id')
            ->leftJoin('categories', 'services.category_id', '=', 'categories.category_id')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftJoin('customer_emi', 'customer_emi.order_id', '=', 'orders.id')
            ->where('orders.payment_status', 1)
            ->where('customers.is_partner', 2)
            ->orderby('orders.id', 'DESC');


        // make orders details
        if ($category_id != 0) {
            $query->where('services.category_id', $category_id);
        }
        if ($package_type != 0) {
            $query->where('cp.cp_type', $package_type);
        }
        if ($package_type != 0 && $category_id != 0) {
            $query->where('services.category_id', $category_id)->where('cp.cp_type', $package_type);
        }

        // $query->where('orders.payment_status', 1)->where('categories.category_id', $category_id);
        $data = $query->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                return '<span>
                    <svg style="cursor:pointer" onclick="AddWorkEffort(' . $data->customer_id . ',' . $data->service_id . ')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </span>';
            })
            ->addColumn('mark2', function ($data) {

                return '<span style="cursor:pointer" onclick="GetCustomerTasks123(' . $data->customer_id . ',' . $data->orderID . ',' . $data->service_id . ',' . $data->is_approve . ')">' . $data->name . '</span>';
            })


            ->rawColumns(['action', 'mark2'])
            ->make(true);
    }

    function SingleService(Request $request)
    {
        $serviceID = $request->service_id;
        $customerID = $request->customer_id;
        // $services = DB::select("select * from services where service_id = '$serviceID'");
        $services = DB::select("select * from services where service_id = '$serviceID'");

        $docs = DB::select("select sd_name from service_docs where s_id = '$serviceID'");
        // dd($docs);
        return view('FED.single_service', compact('services', 'serviceID', 'customerID', 'docs'));
    }


    // franchise customers
    function GetDocuments(Request $request)
    {
        $service_id = $request->service_id;
        $customer_id = $request->customer_id;
        $data = DB::select("SELECT * FROM customer_documents WHERE (cd_from='$customer_id' OR cd_to='$customer_id') AND service_id = '$service_id'");
        return $data;
    }


    public function GetClientChatting(Request $request)
    {
        // $user_id = $request->customer_id;
        // $cust_id = 0;
        // $service_id = $request->service_id;

        // $data = DB::table('customer_chatting')
        // ->leftjoin('users', 'users.id', '=', 'customer_chatting.chat_from')
        //     ->where(function ($query) use ($user_id, $cust_id, $service_id) {
        //         $query->where('customer_chatting.chat_from', $user_id)
        //             ->where('customer_chatting.chat_to', $cust_id)
        //             ->where('customer_chatting.service_id', $service_id);
        //     })
        //     ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
        //         $query
        //             ->where('customer_chatting.chat_to', $user_id)
        //             ->where('customer_chatting.service_id', $service_id);
        //     })
        //     ->get();

        $user_id = $request->customer_id;
        $cust_id = 0;
        $service_id = $request->service_id;

        $data = DB::table('customer_chatting')
            ->select(
                'customer_chatting.*',
                'users_from.username as from_name',
                'users_to.username as to_name'
            )
            ->leftJoin('users as users_from', 'users_from.id', '=', 'customer_chatting.chat_from')
            ->leftJoin('users as users_to', 'users_to.id', '=', 'customer_chatting.chat_to')




            ->where(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('customer_chatting.chat_from', $user_id)
                    ->where('customer_chatting.chat_to', $cust_id)
                    ->where('customer_chatting.service_id', $service_id);
            })
            ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('customer_chatting.chat_to', $user_id)
                    ->where('customer_chatting.service_id', $service_id);
            })
            ->get();



        // dd($data);

        return response()->json(['data' => $data]);
    }


    public function CustWorkTimeline(Request $request)
    {
        $service_id = $request->service_id;
        $cust_id = $request->customer_id;

        $data = DB::select("SELECT cwt.*, users.username, users.id FROM  customer_work_timeline as cwt
        LEFT JOIN users ON cwt.added_by = users.id
        WHERE cwt.cust_id = '$cust_id'
        AND cwt.service_id = '$service_id'
        ORDER BY cwt.id DESC");

        return response()->json(['data' => $data]);
    }

    public function CustomerChat(Request $request)
    {

        $user_id = $request->customer_id;
        $service_id = $request->service_id;
        $chat_msg = $request->chat_msg;

        $AddChat = DB::table('customer_chatting')->insertGetId([
            'service_id' => $service_id,
            'chat_from' => $user_id,
            'chat_to' => 0,
            'chat_msg' => $chat_msg,
        ]);

        if ($AddChat != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function UploadDocs(Request $request)
    {
        $user_id = $request->doc_customer_id;
        $cust_doc = $request->file('customer_docs');
        $docs_name = $request->docs_name;
        $service_id = $request->doc_service_id;

        $hotelLogo = null;
        $HLogo = $cust_doc;
        $hotelLogo = $docs_name . "." . $HLogo->getClientOriginalExtension();
        $destinationPath = public_path('/Docs');
        $HLogo->move($destinationPath, $hotelLogo);

        DB::table('customer_documents')->insert([

            'cd_from' => $user_id,
            'cd_to' => 0,
            'cd_name' => $docs_name,
            'cd_doc' => $hotelLogo,
            'service_id' => $service_id,
        ]);


        return redirect()->back()->with('success', 'Docs Upload Successful!!');
    }

    // customer support ticket
    public function CustomerSupportTicket(Request $request)
    {
        // dd($request);
        $cust_id = $request->ticket_customer_id;
        $service_id = $request->ticket_service_id;
        $query = $request->customer_ticket_query;
        $ticketID = DB::table('customer_tickets')->insertGetId([
            'customer_id' => $cust_id,
            'service_id' => $service_id,
            'ticket_msg' => $query,
        ]);
        if (isset($ticketID)) {
            return response(['success' => true, 'msg' => "Ticket Submmited"]);
        } else {
            return response(['success' => false, 'msg' => "Something wrong"]);
        }
    }

    function getData(Request $request)
    {
        $user_id = Session::get('user_id');
        $data = [
            'total_customers' => DB::table('customers')->where('is_partner', 2)->where('added_by', $user_id)->count(),

            'total_sells' => DB::table('customers')
                ->leftJoin('customer_emi', 'customers.id', '=', 'customer_emi.customer_id')
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->sum('customer_emi.emi_total_amount'),

            'collected_amount' => DB::table('customers')
                ->leftJoin('customer_emi', 'customers.id', '=', 'customer_emi.customer_id')
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->sum('customer_emi.emi_paid_amount'),

            'uncollected_amount' => DB::table('customers')
                ->leftJoin('customer_emi', 'customers.id', '=', 'customer_emi.customer_id')
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->sum('customer_emi.emi_unpaid_amount'),
        ];
        return response()->json(['data' => $data]);
    }


    function GetCustomerStatusCount()
    {
        $user_id = Session::get('user_id');
        $data = [
            'totalTasks' => DB::table('operation_tasks')
                ->join('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'notstarted' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('operation_tasks.original_task_status', 1)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'wip' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('operation_tasks.original_task_status', 2)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'pendingfromclient' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('operation_tasks.original_task_status', 3)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'invoiced' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('operation_tasks.original_task_status', 4)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'paymentpending' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('operation_tasks.original_task_status', 8)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'completed' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('operation_tasks.original_task_status', 5)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),

            'notassign' => DB::table('operation_tasks')
                ->leftjoin('customers', 'customers.id', '=', 'operation_tasks.cust_id')
                ->where('is_assign', 0)
                ->where('customers.is_partner', 2)
                ->where('customers.added_by', $user_id)
                ->count(),
        ];
        return response()->json(['data' => $data]);
    }

    function GetCustomerSupportTickets()
    {
        $user_id = Session::get('user_id');
        $data = DB::select("SELECT c.name, s.service_name,ct.ticket_id, ct.service_id, ct.ticket_msg, ct.ticket_answer, ct.is_open, ct.date FROM customer_tickets ct
        LEFT JOIN customers c ON ct.customer_id = c.id
        LEFT JOIN services s ON s.service_id = ct.service_id
        WHERE c.is_partner = 2 AND c.added_by = $user_id
        ORDER BY ct.ticket_id DESC");
        // dd($data);
        return response()->json(['data' => $data]);
    }


    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
    }

    function FEUpdateEMI(Request $request)
    {
        $paid_amount = $request->paid_amount;
        $unpaid_amount = $request->unpaid_amount;
        $emi_no = $request->emi_no;
        $customer_id = $request->customer_id;


        $payment_screenshot = null;
        if (request()->hasFile('payment_screenshot')) {
            $HLogo = request()->file('payment_screenshot');

            $payment_screenshot = md5($HLogo->getClientOriginalName() . time()) . "." . $HLogo->getClientOriginalExtension();

            $destinationPath = public_path('/payment');

            $HLogo->move($destinationPath, $payment_screenshot);
        }


        DB::table('customer_dues')->insertGetId([
            'emi_id' => $emi_no,
            'customer_id' => $customer_id,
            'paid_amount' => $paid_amount,
            'unpaid_amount' => $unpaid_amount,
            'payment_screenshot' => $payment_screenshot,
        ]);


        return redirect()->back();
    }




    public function addBulkLeads(Request $request)
    {
        // dd($request->file('file'));
        try {
            // dd("i'm in try block");
            $data = Excel::import(new PartnerBulkLeads, $request->file('file')->store('files'));
            // dd($data);
            if ($data) {

                return response(['success' => true, 'msg' => "Leads Added"]);
            } else {
                return response(['success' => false, 'msg' => "No data found in the file or error occurred while importing."]);
            }
        } catch (\Exception $e) {
            return response(['success' => false, 'msg' => "Something went wrong2: " . $e->getMessage()]);
        }
    }
}
