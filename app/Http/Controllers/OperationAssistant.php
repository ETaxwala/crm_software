<?php

namespace App\Http\Controllers;

use App\Imports\CustomersImport;
use App\Models\User;
use App\Notifications\CustomerNotification;
use App\Notifications\TaskNotification;
use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class OperationAssistant extends Controller
{
    public function index(Request $request)
    {
        
    
        $chattings = DB::select("SELECT cc.chat_msg, cc.service_id, cc.date, s.service_name, c.name FROM customer_chatting cc
                INNER JOIN ( SELECT MAX(chat_id) as max_chat_id FROM customer_chatting
                    GROUP BY service_id ) max_chats ON cc.chat_id = max_chats.max_chat_id
                    INNER JOIN services s ON cc.service_id=s.service_id
                    INNER JOIN customers c ON c.id=cc.chat_from
                    ORDER BY cc.chat_id DESC");

        // dd($chattings);

        $services = DB::select("SELECT cwt.work, cwt.status, cwt.service_id, cwt.date, s.service_name, c.name FROM customer_work_timeline cwt
                INNER JOIN ( SELECT MAX(id) as max_cwt_id FROM customer_work_timeline
                    GROUP BY service_id ) max_chats ON cwt.id = max_chats.max_cwt_id
                    INNER JOIN services s ON cwt.service_id=s.service_id
                    INNER JOIN customers c ON c.id=cwt.cust_id
                    ORDER BY cwt.id DESC");

        // dd($data);
        return view('Assistant.Operation.index', compact('chattings', 'services'));
    }

    public function ManageEmployee(Request $request)
    {
        
        // $data = DB::select("SELECT * FROM users WHERE user_type = 3 OR user_type = 4 OR user_type = 5 AND added_by = $user_id ORDER BY id DESC");

        // dd($data);
        if ($request->ajax()) {
            $user_id = Session::get('user_id');
        $user_type = Session::get('user_type');
            $data = DB::select("SELECT * FROM users WHERE user_type = 7 ORDER BY id DESC");

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $actionButtions = '<span>
                    <svg onclick="OperationEmployeeDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>';
                  if ($data->user_type == 4) {
                    $actionButtions .= '<svg onclick="DeleteOperationEmployee(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                  </svg>';
                  }
                  $actionButtions .='</span>';

                  return $actionButtions;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Assistant.Operation.manage_employee');
    }


    public function AddOperationEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:10',
        ]);

        $user_id = Session::get('user_id');
        $AddEmployee = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'user_type' => 7,
            'added_by' => $user_id,
            'password' => $request->input('password'),
            'user_token' => $request->input('_token')
        ]);

        if ($AddEmployee != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }



    public function OperationEmployeeDetail(Request $request)
    {
        $user_id = $request->user_id;
        $data = DB::table('users')->where('id', $user_id)->get();
        return response()->json(['data' => $data]);
    }

    public function UpdateOperationEmployee(Request $request)
    {
        DB::table('users')
            ->where('id', $request->input('user_id'))
            ->update([
                'username' => $request->input('username'),
                'contact' => $request->input('contact'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
    }

    public function DeleteOperationEmployee(Request $request)
    {
        $user_id = $request->user_id;
        // dd($user_id);
        $deleted = DB::table('users')->where('id', $user_id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'User Deleted successful']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }


    public function ManageCustomer(Request $request)
    {
        $user_id = Session::get('user_id');
        $data = DB::select("SELECT orders.*, orders.id as orderID, cp.*, services.service_id, services.service_name, categories.category_name, customers.*, customer_emi.emi_total_amount, customer_emi.emi_paid_amount, customer_emi.emi_unpaid_amount, customer_emi.emi_due_date FROM orders
            LEFT JOIN combo_packages as cp ON orders.package_id=cp.cp_id
            LEFT JOIN services ON cp.cp_title=services.service_id
            LEFT JOIN categories ON services.category_id = categories.category_id
            LEFT JOIN customers ON orders.customer_id=customers.id
            LEFT JOIN customer_emi ON customer_emi.order_id = orders.id
            WHERE orders.payment_status=1 AND customers.is_approve=1 ORDER BY orders.id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT orders.*, orders.id as orderID, cp.*, services.service_id, services.service_name, categories.category_name, customers.*, customer_emi.emi_total_amount, customer_emi.emi_paid_amount, customer_emi.emi_unpaid_amount, customer_emi.emi_due_date FROM orders
            LEFT JOIN combo_packages as cp ON orders.package_id=cp.cp_id
            LEFT JOIN services ON cp.cp_title=services.service_id
            LEFT JOIN categories ON services.category_id = categories.category_id
            LEFT JOIN customers ON orders.customer_id=customers.id
            LEFT JOIN customer_emi ON customer_emi.order_id = orders.id
            WHERE orders.payment_status=1 AND customers.is_approve=1 ORDER BY orders.id DESC");

            // make orders details


            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg style="cursor:pointer" onclick="AddWorkEffort(' . $data->customer_id . ',' . $data->service_id . ')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </span>';
                })
                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="GetCustomerTasks123(' . $data->customer_id . ',' . $data->orderID . ',' . $data->service_id . ')">' . $data->name . '</span>';
                })


                ->rawColumns(['action', 'mark2'])
                ->make(true);
        }

        $oemployees = DB::select("SELECT * FROM users WHERE user_type = 7 ORDER BY id DESC");

        $categories = DB::select("SELECT * FROM categories");
        

        return view('Assistant.Operation.customers', compact('oemployees', 'categories'));
    }

    public function FetchServices(Request $request)
    {
        $category_id = $request->category_id;
        $data['services'] = DB::select("SELECT * FROM combo_packages cp
        LEFT JOIN services s ON cp.cp_title = s.service_id
        WHERE s.category_id='$category_id'");
        return response()->json($data);
    }

    public function CustWorkTimeline(Request $request)
    {
        $cust_id = $request->cust_id;
        $data = DB::select("SELECT cwt.*, users.username, users.id FROM  customer_work_timeline as cwt LEFT JOIN users ON cwt.added_by = users.id WHERE cwt.task_id = '$cust_id' ORDER BY cwt.id DESC");
        return response()->json(['data' => $data]);
    }

    public function AddWorkEffort(Request $request)
    {
        // dd($request);
        $cust_id = $request->cust_id;
        $work = $request->work;
        $status = $request->status;
        $task_id = $request->task_id;

        $user_id = Session::get('user_id');

        if ($status == 6) {


            DB::table('operation_tasks')->where('task_id', $task_id)
                ->update(['is_assign' => 0, 'is_return' => 1]);

            DB::table('task_assign')->where('task_id', $task_id)
                ->update(['task_status' => 1, 'actual_task_status' => $status]);

            $AddWork = DB::table('customer_work_timeline')->insertGetId([
                'cust_id' => $cust_id,
                'task_id' => $task_id,
                'work' => $work,
                'status' => $status,
                'added_by' => $user_id,
            ]);
        } else {
            DB::table('task_assign')->where('task_id', $task_id)
                ->update(['actual_task_status' => $status]);
            $AddWork = DB::table('customer_work_timeline')->insertGetId([
                'cust_id' => $cust_id,
                'task_id' => $task_id,
                'work' => $work,
                'status' => $status,
                'added_by' => $user_id,
            ]);
        }
        // $AddWork = DB::table('customer_work_timeline')->insertGetId([
        //     'cust_id' => $cust_id,
        //     'task_id' => $task_id,
        //     'work' => $work,
        //     'status' => $status,
        //     'added_by' => $user_id,
        // ]);


        // if ($AddWork != 0) {
        //     return redirect()->back();
        // } else {
        //     return redirect()->back();
        // }
    }

    public function AddCustTask(Request $request)
    {
        // dd($request);
        $cust_id = $request->cust_id;
        $task = $request->cust_task;
        $service_id = $request->service_id;
        $user_id = Session::get('user_id');

        $AddTask = DB::table('operation_tasks')->insertGetId([
            'cust_id' => $cust_id,
            'service_id' => $service_id,
            'task_name' => $task,
            'added_by' => $user_id,
        ]);

        if ($AddTask != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


    public function GetCustTasks(Request $request)
    {
        $cust_id = $request->cust_id;
        $service_id = $request->service_id;
        $data = DB::select("SELECT  operation_tasks.*,operation_tasks.task_id as taskID ,task_assign.*, users.id,users.username FROM operation_tasks LEFT JOIN task_assign ON operation_tasks.task_id = task_assign.task_id LEFT JOIN users ON users.id = task_assign.assign_to WHERE operation_tasks.cust_id = '$cust_id' AND operation_tasks.service_id = '$service_id'  ORDER BY operation_tasks.task_id DESC");
        return response()->json(['data' => $data]);
    }

    public function DeleteCustomerTask(Request $request)
    {
        $task_id = $request->task_id;
        // dd($task_id);
        $deleted = DB::table('operation_tasks')->where('task_id', $task_id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Task Deleted successful']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }

    public function AssignTaskTo(Request $request)
    {
        // dd($request);
        date_default_timezone_set('Asia/Kolkata');
        $task_id = $request->task_id;
        $assign_to = $request->employee_id;
        $due_date = $request->due_date;
        $user_id = Session::get('user_id');
        $currentDateTime = date('Y-m-d H:i:s');

        $taskAssign = DB::table('task_assign')->where('task_id', $task_id)->get();

        if (count($taskAssign) > 0) {
            $AddTask = DB::table('task_assign')
                ->where('task_id', $task_id)
                ->update([
                    'assign_to' => $assign_to,
                    'assign_by' => $user_id,
                    'due_date' => $due_date,
                    'task_status' => 0,
                ]);
        } else {
            $AddTask = DB::table('task_assign')->insertGetId([
                'task_id' => $task_id,
                'assign_to' => $assign_to,
                'assign_by' => $user_id,
                'due_date' => $due_date,
                'assign_date' => $currentDateTime,
            ]);
        }



        DB::table('operation_tasks')
            ->where('task_id', $task_id)
            ->update([
                'is_assign' => 1,
                'is_return' => 0,
            ]);

        if ($AddTask != 0) {
            $task = DB::table('operation_tasks')->select('task_name')->where('task_id',68)->get();
            $taskName = $task[0]->task_name;
            $user_name = Session::get('user_name');
            $users = User::where('id', $assign_to)->get();

            foreach ($users as $user) {
                $user->notify(new TaskNotification($taskName));
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    
    function GetCustomerTaskList(Request $request)
    {
        $data = DB::table('operation_tasks')->get();
        return response()->json(['data' => $data]);
    }

    function GetCustomerServicePrice(Request $request)
    {
        $order_id = $request->order_id;
        $data = DB::select("SELECT * FROM customer_emi WHERE  order_id = '$order_id'");
        return response()->json(['data' => $data]);
    }

    function GetClientChatting(Request $request)
    {
        $user_id = Session::get('user_id');
        $cust_id = $request->cust_id;
        $service_id = $request->service_id;

        // $data = DB::table('customer_chatting')
        //     ->where(function ($query) use ($user_id, $cust_id, $service_id) {
        //         $query
        //             ->where('chat_to', $cust_id)
        //             ->where('service_id', $service_id);
        //     })
        //     ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
        //         $query->where('chat_from', $cust_id)
        //             ->where('service_id', $service_id);
        //     })
        //     ->get();



        $data = DB::table('customer_chatting')
            ->select(
                'customer_chatting.*',
                'users_from.username as from_name',
                'users_to.username as to_name',
                'cust_from.name as from_cust_name',
                'cust_to.name as to_cust_name'
            )
            ->leftJoin('users as users_from', 'users_from.id', '=', 'customer_chatting.chat_from')
            ->leftJoin('users as users_to', 'users_to.id', '=', 'customer_chatting.chat_to')
            ->leftJoin('customers as cust_from', 'cust_from.id', '=', 'customer_chatting.chat_from')
            ->leftJoin('customers as cust_to', 'cust_to.id', '=', 'customer_chatting.chat_to')
            ->where(function ($query) use ($user_id, $cust_id, $service_id) {
                $query
                    ->where('customer_chatting.chat_to', $cust_id)
                    ->where('customer_chatting.service_id', $service_id);
            })
            ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('customer_chatting.chat_from', $cust_id)
                    ->where('customer_chatting.service_id', $service_id);
            })
            ->get();
        // dd($data);


        return response()->json(['data' => $data]);
    }

    function ChatToClient(Request $request)
    {
        $user_id = Session::get('user_id');
        $cust_id = $request->cust_id;
        $chat_msg = $request->chat_msg;
        $service_id = $request->service_id;


        $AddChat = DB::table('customer_chatting')->insertGetId([
            'chat_from' => $user_id,
            'chat_to' => $cust_id,
            'chat_msg' => $chat_msg,
            'service_id' => $service_id,
        ]);

        if ($AddChat != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function GetServicePrice(Request $request)
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

        $data1 = DB::select("SELECT service_price FROM services WHERE service_id IN ($service_ids_str)");
        // dd($data1);

        $service_prices = []; // Initialize an array to collect service_prices
        foreach ($data1 as $item1) {
            $service_prices[] = $item1->service_price; // Collect service_prices
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

    // add offline customers
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
        $cust_unpaid_amount2 = $request->customer_unpaid_amount22;
        $cust_due_date2 = $request->customer_due_date22;
        $cust_comment = $request->customer_comment;
        $cust_total_service_price = $request->customer_total_service_price;
        $cust_payment_mode = $request->customer_payment_mode;
        $cust_token = $request->_token;
        $apply_coupon = $request->apply_coupon;


        $leadID = DB::table('leads')->insertGetId([
            'name' => $cust_name,
            'email' => $cust_email,
            'contact' => $cust_mobile,
            'service' => $cust_service,
            'state' => $cust_state,
            'city' => $cust_city,
            'added_by' => $user_id,
            'lead_type' => 1,
            'is_customer' => 1,
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
            'is_approve' => 1,
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

        DB::table('customer_emi')->insertGetId([
            'customer_id' => $custID,
            'order_id' => $oID,
            'emi_type' => $cust_payment_mode,
            'emi_total_amount' => $cust_total_service_price,
            'emi_paid_amount' => $cust_paid_amount,
            'emi_unpaid_amount' => $cust_unpaid_amount,
            'emi_due_date' => $cust_due_date,
            'second_emi' => $cust_unpaid_amount2,
            'second_emi_due_date' => $cust_due_date2,
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

return redirect()->back()->with('success', 'Order Purchase Successful!!');

        
    }

    function AddBulkOfflineCustomer(Request $request)
    {
        // dd($request);
        try {
            $data = Excel::import(new CustomersImport, $request->file('file')->store('files'));
            // dd($data);
            if ($data) {

                return response(['success' => true, 'msg' => "Customer Added"]);
            } else {
                return response(['success' => false, 'msg' => "No data found in the file or error occurred while importing."]);
            }
        } catch (\Exception $e) {
            return response(['success' => false, 'msg' => "Something went wrong2: " . $e->getMessage()]);
        }

    }

    // GetCustomerSupportTickets
    function GetCustomerSupportTickets()
    {
        $data = DB::select("SELECT c.name, s.service_name,ct.ticket_id, ct.service_id, ct.ticket_msg, ct.ticket_answer, ct.is_open, ct.date FROM customer_tickets ct
        LEFT JOIN customers c ON ct.customer_id = c.id
        LEFT JOIN services s ON s.service_id = ct.service_id
        ORDER BY ct.ticket_id DESC");
        // dd($data);
        return response()->json(['data' => $data]);
    }

    // changeTicketStatus
    function changeTicketStatus(Request $request)
    {
        $ticket_id = $request->ticket_id;
        $ticket_answer = $request->ticket_answer;

        $updateTicket = DB::table('customer_tickets')
            ->where('ticket_id', $ticket_id)
            ->update([
                'ticket_answer' => $ticket_answer,
                'is_open' => 1,
            ]);

        if ($updateTicket) {
            return response()->json(['success' => true, 'msg' => 'Ticket Closed']);
        } else {
            return response()->json(['success' => false, 'msg' => 'Error']);
        }
    }

    function GetCustomerStatusCount()
    {
        $data = [
            'totalTasks' => DB::table('operation_tasks')->count(),

            'notstarted' => DB::table('operation_tasks')
                ->where('original_task_status', 1)->count(),

            'wip' => DB::table('operation_tasks')
                ->where('original_task_status', 2)->count(),

            'pendingfromclient' => DB::table('operation_tasks')
                ->where('original_task_status', 3)->count(),

            'invoiced' => DB::table('operation_tasks')
                ->where('original_task_status', 4)->count(),

            'paymentpending' => DB::table('operation_tasks')
                ->where('original_task_status', 8)->count(),

            'completed' => DB::table('operation_tasks')
                ->where('original_task_status', 5)->count(),

            'notassign' => DB::table('operation_tasks')
                ->where('is_assign', 0)->count(),
        ];
        return response()->json(['data' => $data]);
    }

    function GetCustomerFilter(Request $request)
    {
        $category_id = $request->category_id;
        $package_type = $request->package_type;



        $query = $data = DB::table('orders')
            ->select('orders.*', 'orders.id as orderID', 'cp.*', 'services.service_id', 'services.service_name', 'categories.category_name', 'customers.*', 'customer_emi.emi_total_amount', 'customer_emi.emi_paid_amount', 'customer_emi.emi_unpaid_amount', 'customer_emi.emi_due_date')
            ->leftJoin('combo_packages as cp', 'orders.package_id', '=', 'cp.cp_id')
            ->leftJoin('services', 'cp.cp_title', '=', 'services.service_id')
            ->leftJoin('categories', 'services.category_id', '=', 'categories.category_id')
            ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
            ->leftJoin('customer_emi', 'customer_emi.order_id', '=', 'orders.id')
            ->where('orders.payment_status', 1)->where('customers.is_approve', 1);


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

                return '<span style="cursor:pointer" onclick="GetCustomerTasks123(' . $data->customer_id . ',' . $data->orderID . ',' . $data->service_id . ')">' . $data->name . '</span>';
            })


            ->rawColumns(['action', 'mark2'])
            ->make(true);
    }


    function showtasks(Request $request)
    {
        $oemployees = DB::select("SELECT * FROM users WHERE user_type = 7 ORDER BY id DESC");
        $customers = DB::table('customers')->get();
        return view("Assistant.Operation.manage_tasks", compact('oemployees', 'customers'));
    }
    function GetAllTasks(Request $request)
    {
        $data = DB::table('operation_tasks as ot')
            ->select('ot.task_id', 'ot.task_name', 'u.username', 'ta.assign_date', 'ta.due_date', 'c.name')
            ->leftJoin('customers as c', 'c.id', '=', 'ot.cust_id')
            ->leftJoin('services as s', 's.service_id', '=', 'ot.service_id')
            ->leftJoin('task_assign as ta', 'ta.task_id', '=', 'ot.task_id')
            ->leftJoin('users as u', 'u.id', '=', 'ta.assign_to')
            ->orderby('ot.task_id', 'DESC')
            ->get();

        // dd($data);

        return Datatables::of($data)

            ->addColumn('action', function ($data) {
                return '<span>
            <svg style="cursor:pointer" onclick="AssingTaskTo(' . $data->task_id . ')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
        </span>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    function GetCustomerTaskDetails(Request $request)
    {
        $task_id = $request->task_id;
        $data = DB::select("SELECT cwt.*, users.username, users.id FROM  customer_work_timeline as cwt
        LEFT JOIN users ON cwt.added_by = users.id WHERE cwt.task_id = '$task_id' ORDER BY cwt.id DESC");
        return $data;
    }

    function GetTasksFilter(Request $request)
    {
        $customer_id = $request->customer_id;
        $employee_id = $request->employee_id;



        $query = DB::table('operation_tasks as ot')
            ->select('ot.task_id', 'ot.task_name', 'u.username', 'ta.assign_date', 'ta.due_date', 'c.name')
            ->leftJoin('customers as c', 'c.id', '=', 'ot.cust_id')
            ->leftJoin('services as s', 's.service_id', '=', 'ot.service_id')
            ->leftJoin('task_assign as ta', 'ta.task_id', '=', 'ot.task_id')
            ->leftJoin('users as u', 'u.id', '=', 'ta.assign_to')
            ->orderby('ot.task_id', 'DESC');



        // make orders details
        if ($customer_id != 0) {
            $query->where('c.id', $customer_id);
        }
        if ($employee_id != 0) {
            $query->where('u.id', $employee_id);
        }
        if ($employee_id != 0 && $customer_id != 0) {
            $query->where('c.id', $customer_id)->where('u.id', $employee_id);
        }

        // $query->where('orders.payment_status', 1)->where('categories.category_id', $category_id);
        $data = $query->get();

        return Datatables::of($data)

            ->addColumn('action', function ($data) {
                return '<span>
            <svg style="cursor:pointer" onclick="AssingTaskTo(' . $data->task_id . ')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
        </span>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // generate/create coupon
    function GenerateCoupon(Request $request)
    {
        $type = $request->coupon_type;
        $name = $request->coupon_name;
        $discount = $request->coupon_discount;
        $validity = $request->coupon_validity;
        $uses = $request->coupon_uses;

        // dd($request);

        $coupon = DB::table('coupons')->insertGetId([
            'coupon_type' => $type,
            'coupon_name' => $name,
            'coupon_discount' => $discount,
            'coupon_validity' => $validity,
            'coupon_uses' => $uses,
            'coupon_remaining' => $uses,
        ]);

        if ($coupon != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    function GetAllCoupons()
    {
        $data = DB::table('coupons')->get();
        return response()->json(['data' => $data]);
    }

    function ApplyCouponCode(Request $request)
    {
        $coupon_code = $request->coupon_code;
        $total_price = $request->total_price;

        $coupons = DB::table('coupons')->where('is_active', 0)->where('coupon_name', $coupon_code)->get();

        if (count($coupons) == 0) {
            return response()->json(['error' => 'Coupon Expired or Not Found']);
        }
        $couponType = '';
        $couponDiscount = '';
        foreach ($coupons as $coupon) {
            $couponType = $coupon->coupon_type;
            $couponDiscount = $coupon->coupon_discount;
        }
        switch ($couponType) {
            case 0:
                $data = $total_price - $couponDiscount;
                break;

            case 1:
                $data = $total_price - $total_price * ($couponDiscount / 100);
                break;
        }
        return $data;
    }

    function checkCoupon(Request $request)
    {
        $coupon_name = $request->coupon_name;

        $coupons = DB::table('coupons')->where('is_active', 0)->where('coupon_name', $coupon_name)->get();

        if (count($coupons) > 0) {
            return response()->json(['error' => 'Name already exist, please try another one']);
        } else {
            return response()->json(['done' => 'Name Approved']);
        }
    }

    function OMUpdateEMI(Request $request)
    {
        $paid_amount = $request->paid_amount;
        $unpaid_amount = $request->unpaid_amount;
        $emi_no = $request->emi_no;
        $customer_id = $request->customer_id;
        $added_by = Session::get('user_id');

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
            'added_by' => $added_by,
        ]);
        
        DB::table('customer_emi')->where('emi_id', $emi_no)
            ->update([
                'emi_paid_amount' => $paid_amount,
                'emi_unpaid_amount' => $unpaid_amount,
            ]);

        if ($unpaid_amount == 0) {
            DB::table('customer_emi')->where('emi_id', $emi_no)
                ->update([
                    'emi_due_date' => null,
                ]);
        }


        return redirect()->back();
    }
}
