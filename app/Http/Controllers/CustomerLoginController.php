<?php

namespace App\Http\Controllers;

use App\Models\CustomerDocument;
use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;

class CustomerLoginController extends Controller
{

    function checkCustomerEmail(Request $request)
    {
        $email = $request->email;

        $check_mail = DB::table('customers')->where('email', $email)->get();

        if (count($check_mail) > 0) {
            return response()->json(['error' => 'Email already exist']);
        } else {
            return response()->json(['success' => 'success']);
        }
    }

    function CustomerSignup(Request $request)
    {
        // dd($request);
        $token = $request->_token;
        $name = $request->customer_name;
        $contact = $request->customer_mobile;
        $email = $request->customer_email;
        $password = $request->customer_password;
        $service = $request->customer_service;
        $company_id = 'ETax1';
        $state = 'MH';
        $city = 'MH';


        $check_mail = DB::table('customers')->where('email', $email)->get();

        if (count($check_mail) > 0) {
            return redirect('/customer-login-form')->with('error', 'Email already exist');
        }


        $data = [
            'name' => $name,
            'email' => $email,
            'contact' => $contact,
            'service' => $service,
            'state' => $state,
            'city' => $city,
            'company_id' => $company_id,
            'lead_type' => 1,
            'added_by' => 0,
        ];

        $leadID = DB::table('leads')->insertGetId($data);

        $customer = [
            'lead_id' => $leadID,
            'name' => $name,
            'business' => 'NA',
            'email' => $email,
            'contact' => $contact,
            'service' => $service,
            'service_price' => 0,
            'state' => $state,
            'city' => $city,
            'password' => $password,
            'company_id' => $company_id,
            'customer_token' => $token,
            'added_by' => 0,
        ];

        $cID = DB::table('customers')->insertGetId($customer);

        if ($cID > 0) {
            $user = DB::table('customers')->where('email', $email)->first();

            if ($user) {
                if ($password == $user->password) {
                    if ($user->is_active == 1) {
                        Session::put('customer_from', $user->is_partner);
                        Session::put('token', $user->customer_token);
                        Session::put('user_name', $user->name);
                        Session::put('user_id', $user->id);
                        Session::put('user_type', 0);
                        Session::put('company_id', $user->company_id); // Corrected session key
                        Session::save();

                        return redirect()->route('customer-dashboard');
                    } else {
                        return redirect('/customer-login-form')->with('error', 'Your Account Is Deactive contact your Admin');
                    }
                } else {
                    return redirect('/customer-login-form')->with('error', 'Incorrect Password');
                }
            } else {
                return redirect('/customer-login-form')->with('error', 'Email not exist');
            }
        } else {
            return redirect()->back()->with('error', 'Customer registration failed');
        }
    }

    function CustomerLogin(Request $request)
    {
        $email = $request->customer_email; // Corrected variable names
        $password = $request->customer_password; // Corrected variable names

        $user = DB::table('customers')->where('email', $email)->first();
        // dd($user);

        if ($user) {
            if ($password == $user->password) {
                if ($user->is_active == 1) {
                    Session::put('customer_from', $user->is_partner);
                    Session::put('token', $user->customer_token);
                    Session::put('user_name', $user->name);
                    Session::put('user_id', $user->id);
                    Session::put('user_type', 0);
                    Session::put('company_id', $user->company_id); // Corrected session key
                    Session::save();

                    return redirect()->route('customer-dashboard');
                } else {
                    return redirect('/customer-login-form')->with('error', 'Your Account Is Deactive contact your Admin');
                }
            } else {
                return redirect('/customer-login-form')->with('error', 'Incorrect Password');
            }
        } else {
            return redirect('/customer-login-form')->with('error', 'Email not exist');
        }
    }




    public function CustomerDashboard(Request $request)
    {
        $user_id = Session::get('user_id');
        $chattings = DB::select("SELECT cc.chat_msg, cc.service_id, cc.date, s.service_name FROM customer_chatting cc
                INNER JOIN ( SELECT MAX(chat_id) as max_chat_id FROM customer_chatting WHERE chat_to = '$user_id'
                    GROUP BY service_id ) max_chats ON cc.chat_id = max_chats.max_chat_id
                    INNER JOIN services s ON cc.service_id=s.service_id
                    ORDER BY cc.chat_id DESC");

        $services = DB::select("SELECT cwt.work, cwt.status, cwt.service_id, cwt.date, s.service_name FROM customer_work_timeline cwt
                INNER JOIN ( SELECT MAX(id) as max_cwt_id FROM customer_work_timeline WHERE cust_id = '$user_id'
                    GROUP BY service_id ) max_chats ON cwt.id = max_chats.max_cwt_id
                    INNER JOIN services s ON cwt.service_id=s.service_id
                    ORDER BY cwt.id DESC");

        // dd($data);
        return view('customer.dashboard', compact('chattings', 'services'));
    }

    public function CustomerMessages(Request $request)
    {
        $employees = DB::table('users')->where('user_type', 7)->get();
        // dd($employees);
        return view('customer.messages', compact('employees'));
    }


    public function CustomerLogout(Request $request)
    {
        Session::flush();
        Session::regenerate();
        return redirect('/customer-login-form');
    }

    public function CustomerMyServices(Request $request)
    {
        $cust_id = Session::get('user_id');
        $orders = DB::select("SELECT cp.cp_type,cp.cp_title,orders.*, services.service_name, ce.* FROM orders
        LEFT JOIN combo_packages as cp ON orders.package_id=cp.cp_id
        LEFT JOIN services ON cp.cp_title=services.service_id
        LEFT JOIN customer_emi ce ON ce.order_id=orders.id
        WHERE orders.customer_id='$cust_id' AND orders.payment_status=1");
        // dd($orders);
        return view('customer.my_services', compact('orders'));
    }
    public function CustomerAllServices(Request $request)
    {
        $categories = DB::table('categories')->get();

        // dd($serviceIds);
        return view('customer.all_services', compact('categories'));
    }

    // public function GetAllServices(Request $request)
    // {
    //     $category_id = $request->category_id;
    //     $service_name = $request->service_name;
    //     $user_id = Session::get('user_id');


    //     if ($service_name == null || $service_name == '') {
    //         if ($category_id == 0) {
    //             $data = [
    //                 'services' => DB::select("SELECT * FROM services LEFT JOIN categories ON services.category_id = categories.category_id"),
    //                 'serviceIds' => DB::table('cart')->where('cust_id', $user_id)->pluck('service_id')->toArray(),
    //             ];
    //         } else {
    //             $data = [
    //                 'services' => DB::select("SELECT * FROM services LEFT JOIN categories ON services.category_id = categories.category_id WHERE services.category_id='$category_id'"),
    //                 'serviceIds' => DB::table('cart')->where('cust_id', $user_id)->pluck('service_id')->toArray(),
    //             ];
    //         }
    //     } else {
    //         if ($category_id == 0) {
    //             $data = [
    //                 'services' => DB::select("SELECT * FROM services LEFT JOIN categories ON services.category_id = categories.category_id WHERE services.service_name = '%$service_name%'"),
    //                 'serviceIds' => DB::table('cart')->where('cust_id', $user_id)->pluck('service_id')->toArray(),
    //             ];
    //         } else {
    //             $data = [
    //                 'services' => DB::select("SELECT * FROM services LEFT JOIN categories ON services.category_id = categories.category_id WHERE services.category_id='$category_id' AND  services.service_name = '%$service_name%'"),
    //                 'serviceIds' => DB::table('cart')->where('cust_id', $user_id)->pluck('service_id')->toArray(),
    //             ];
    //         }
    //     }


    //     return response()->json(['data' => $data]);
    // }

    public function GetAllServices(Request $request)
    {
        $category_id = $request->category_id;
        $service_name = $request->service_name;
        $user_id = Session::get('user_id');

        // Prepare base query
        $query = DB::table('services')
            ->leftJoin('categories', 'services.category_id', '=', 'categories.category_id');

        // Add conditions based on inputs
        if ($category_id != 0) {
            $query->where('services.category_id', $category_id);
        }
        if ($service_name != null && $service_name != '') {
            $query->where('services.service_name', 'like', '%' . $service_name . '%');
        }

        // Fetch services and service IDs
        $services = $query->get();
        $serviceIds = DB::table('cart')->where('cust_id', $user_id)->pluck('service_id')->toArray();

        $data = [
            'services' => $services,
            'serviceIds' => $serviceIds,
        ];

        return response()->json(['data' => $data]);
    }


    public function UploadDocs(Request $request)
    {
        $user_id = Session::get('user_id');
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

    public function PackageInfo(Request $request)
    {
        $sId = $request->service_id;
        $data = [
            "data1" => DB::select("SELECT * FROM combo_packages WHERE cp_title = '$sId'"),
            "data2" => DB::select("SELECT * FROM services"),
        ];
        return response()->json(['data' => $data]);
    }

    public function SingleService(Request $request)
    {
        // $cust_id = Session::get('user_id');
        // $services = DB::select("SELECT * FROM order_items as ot LEFT JOIN services as s ON s.service_id = ot.service_id WHERE ot.customer_id = '$cust_id'");

        $serviceID = $request->service_id;
        // $services = DB::select("select * from services where service_id = '$serviceID'");
        $services = DB::select("select * from services where service_id = '$serviceID'");

        $docs = DB::select("select sd_name from service_docs where s_id = '$serviceID'");
        // dd($docs);
        return view('customer.single-service', compact('services', 'serviceID', 'docs'));
    }

    // customer inquiry
    public function CustomerInquiry(Request $request)
    {
        // dd($request);
        $cust_id = Session::get('user_id');
        $service_id = $request->query_service_id;
        $query = $request->customer_query;
        $inquiry_from = Session::get('customer_from'); 
        
        $inqID = DB::table('customer_inquiries')->insertGetId([
            'cust_id' => $cust_id,
            'service_id' => $service_id,
            'cust_query' => $query,
            'inquiry_from' => $inquiry_from,
        ]);
        if (isset($inqID)) {
            return response(['success' => true, 'msg' => "Inquiry Submmited"]);
        } else {
            return response(['success' => false, 'msg' => "not"]);
        }
    }

    // customer support ticket
    public function CustomerSupportTicket(Request $request)
    {
        // dd($request);
        $cust_id = Session::get('user_id');
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

    function GetDocuments(Request $request)
    {
        $service_id = $request->service_id;
        $user_id = Session::get('user_id');
        $data = DB::select("SELECT * FROM customer_documents WHERE (cd_from='$user_id' OR cd_to='$user_id') AND service_id = '$service_id'");
        return $data;
    }


    public function GetClientChatting(Request $request)
    {
        $user_id = Session::get('user_id');
        $cust_id = 0;
        $service_id = $request->service_id;

        // dd($service_id);
        $data = DB::table('customer_chatting')
            ->where(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('chat_from', $user_id)
                    ->where('chat_to', $cust_id)
                    ->where('service_id', $service_id);
            })
            ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
                $query
                    ->where('chat_to', $user_id)
                    ->where('service_id', $service_id);
            })
            ->get();



        // dd($data);

        return response()->json(['data' => $data]);
    }


    public function CustWorkTimeline(Request $request)
    {
        $service_id = $request->service_id;
        $cust_id = Session::get('user_id');
        $data = DB::select("SELECT cwt.*, users.username, users.id FROM  customer_work_timeline as cwt
        LEFT JOIN users ON cwt.added_by = users.id
        WHERE cwt.cust_id = '$cust_id'
        AND cwt.service_id = '$service_id'
        ORDER BY cwt.id DESC");

        return response()->json(['data' => $data]);
    }

    public function CustomerChat(Request $request)
    {
        $user_id = Session::get('user_id');
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

    function GetCustomerStatusCount()
    {
        $user_id = Session::get('user_id');
        $data = [
            'totalTasks' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)
                ->count(),
            'notstarted' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)->where('task_assign.actual_task_status', 1)->count(),
            'wip' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)->where('task_assign.actual_task_status', 2)->count(),
            'pendingfromclient' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)->where('task_assign.actual_task_status', 3)->count(),
            'invoiced' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)->where('task_assign.actual_task_status', 4)->count(),
            'paymentpending' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)->where('task_assign.actual_task_status', 8)->count(),
            'completed' => DB::table('operation_tasks')->leftJoin('task_assign', 'operation_tasks.task_id', '=', 'task_assign.task_id')
                ->where('operation_tasks.cust_id', '=', $user_id)->where('task_assign.actual_task_status', 5)->count(),
        ];
        return response()->json(['data' => $data]);
    }

    // GetCustomerOwnTickets
    public function GetCustomerOwnTickets(Request $request)
    {
        $user_id = Session::get('user_id');
        $data = DB::select("SELECT c.name, s.service_name,ct.ticket_id, ct.service_id, ct.ticket_msg, ct.is_open, ct.date FROM customer_tickets ct
        LEFT JOIN customers c ON ct.customer_id = c.id
        LEFT JOIN services s ON s.service_id = ct.service_id
        WHERE ct.customer_id = '$user_id'
        ORDER BY ct.ticket_id DESC");
        // dd($data);
        return response()->json(['data' => $data]);
    }


    function ApplyCouponCode(Request $request)
    {
        // dd($request);
        $coupon_code = $request->coupon_code;
        $total_price = $request->total_price;

        $coupons = DB::table('coupons')->where('is_active', 0)->where('coupon_name', $coupon_code)->get();

        if (count($coupons) == 0) {
            return response()->json(['error' => 'Invalid Coupon']);
        }
        $couponType = '';
        $couponDiscount = '';
        foreach ($coupons as $coupon) {
            $couponType = $coupon->coupon_type;
            $couponDiscount = $coupon->coupon_discount;
        }
        switch ($couponType) {
            case 0:
                $total = $total_price - $couponDiscount;
                $discount = '- Rs ' . $couponDiscount;
                $data = [$total, $discount];
                break;

            case 1:
                $total = $total_price - $total_price * ($couponDiscount / 100);
                $discount = '-' . $couponDiscount . '%';
                $data = [$total, $discount];
                break;
        }
        return $data;
    }
}
