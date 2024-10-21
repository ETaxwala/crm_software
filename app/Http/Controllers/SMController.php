<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;

class SMController extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('SM.dashboard');
    }

    public function ManageEmployee(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        // $data = DB::select("SELECT * FROM users WHERE user_type = 3 OR user_type = 4 OR user_type = 5 AND added_by = $user_id ORDER BY id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM users WHERE user_type = 6 AND added_by = $user_id AND company_id = '$company_id' ORDER BY id DESC");

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="SalesEmployeeDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteSalesEmployee(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('SM.manage_employee');
    }


    public function AddSalesEmployee(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $AddEmployee = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'user_type' => 6,
            'added_by' => $user_id,
            'password' => $request->input('password'),
            'user_token' => $request->input('_token'),
            'company_id' => $company_id,
        ]);

        if ($AddEmployee != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }



    public function SalesEmployeeDetail(Request $request)
    {
        $user_id = $request->user_id;
        $data = DB::table('users')->where('id', $user_id)->get();
        return response()->json(['data' => $data]);
    }

    public function UpdateSalesEmployee(Request $request)
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

    public function DeleteSalesEmployee(Request $request)
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


    // ManageCustomers
    public function ManageCustomers(Request $request)
    {
        $user_id = Session::get('user_id');
        if ($request->ajax()) {
            $data = DB::select("SELECT orders.*, orders.id as orderID, cp.*, services.service_id, services.service_name, categories.category_name, customers.* FROM orders
            LEFT JOIN combo_packages as cp ON orders.package_id=cp.cp_id
            LEFT JOIN services ON cp.cp_title=services.service_id
            LEFT JOIN categories ON services.category_id = categories.category_id
            LEFT JOIN customers ON orders.customer_id=customers.id
            WHERE orders.payment_status=1
            ORDER BY orders.id DESC");

            // make orders details


            return Datatables::of($data)

                ->addColumn('mark1', function ($data) {

                    switch ($data->is_approve) {
                        case 0:
                            return '<span class="pointer badge bg-danger me-1 text-white" onclick="showPaymentBox(' . $data->orderID . ')">Not-Approve</span>';

                        case 1:
                            return '<span class="pointer badge bg-success me-1 text-white" onclick="showPaymentBox(' . $data->orderID . ')">Approve</span>';

                    }
                })

                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="GetCustomerTasks123(' . $data->customer_id . ',' . $data->orderID . ',' . $data->service_id . ')">' . $data->name . '</span>';
                })

                ->addColumn('mark3', function ($data) {
                    // Create the URL using the route function and then embed it in the returned HTML.
                    $url = route("sm-single-customer", ['service_id' => $data->cp_title, 'customer_id' => $data->customer_id]);
                    return '<a href="' . $url . '">' . htmlspecialchars($data->service_name, ENT_QUOTES, 'UTF-8') . '</a>';
                })


                ->rawColumns(['mark2','mark1', 'mark3'])
                ->make(true);
        }

        $oemployees = DB::select("SELECT * FROM users WHERE user_type = 7 ORDER BY id DESC");

        $categories = DB::select("SELECT * FROM categories");
        // dd($services);

        return view('SM.customers', compact('oemployees', 'categories'));
    }

    function PaymentDetails(Request $request)
    {
        $cust_id = $request->cust_id;
        $data = DB::table('customer_emi')->where('order_id',$cust_id)->get();
        return response()->json($data);
    }

    function ApproveCustomer(Request $request)
    {
        $cust_id = $request->customer_id;
        $AddEmployee = DB::table('customers')
        ->where('id',$cust_id)
        ->update([
            'is_approve' => 1
        ]);
        if ($AddEmployee != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }


    // all single service/customer functions
    function SingleCustomer(Request $request)
    {
        $serviceID = $request->service_id;
        $customerID = $request->customer_id;
        // $services = DB::select("select * from services where service_id = '$serviceID'");
        $services = DB::select("select * from services where service_id = '$serviceID'");

        $docs = DB::select("select sd_name from service_docs where s_id = '$serviceID'");
        // dd($docs);
        return view('SM.single_customer_service', compact('services', 'serviceID', 'customerID', 'docs'));
    }

    function GetDocuments(Request $request)
    {
        $service_id = $request->service_id;
        $customer_id = $request->customer_id;
        $data = DB::select("SELECT * FROM customer_documents
        WHERE (cd_from='$customer_id' OR cd_to='$customer_id')
        AND service_id = '$service_id'");
        return $data;
    }


    public function GetClientChatting(Request $request)
    {
        $user_id = Session::get('user_id');
        $cust_id = $request->customer_id;
        $service_id = $request->service_id;

        // dd($service_id);
        $data = DB::table('customer_chatting')
            ->where(function ($query) use ($user_id, $cust_id, $service_id) {
                $query
                    ->where('chat_to', $cust_id)
                    ->where('service_id', $service_id);
            })
            ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('chat_from', $cust_id)
                    ->where('service_id', $service_id);
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

        $user_id = Session::get('user_id');
        $service_id = $request->service_id;
        $chat_msg = $request->chat_msg;
        $cust_id = $request->customer_id;

        $AddChat = DB::table('customer_chatting')->insertGetId([
            'service_id' => $service_id,
            'chat_from' => $user_id,
            'chat_to' => $cust_id,
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
        $user_id = Session::get('user_id');
        $cust_id = $request->doc_customer_id;
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
            'cd_to' => $cust_id,
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

function ManagePartners(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        // $data = DB::select("SELECT * FROM users WHERE user_type = 3 OR user_type = 4 OR user_type = 5 AND added_by = $user_id ORDER BY id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM users WHERE user_type = 8 AND added_by = $user_id AND company_id = '$company_id' ORDER BY id DESC");

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="SalesEmployeeDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteSalesEmployee(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('SM.manage_partners');
    }

}
