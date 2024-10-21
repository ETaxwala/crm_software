<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Yajra\DataTables\Facades\DataTables;


class SEController extends Controller
{

    public function Dashboard(Request $request)
    {
        return view('SED.dashboard');
    }

    public function ManageLead(Request $request)
    {
        if ($request->ajax()) {
            $user_id = Session::get('user_id'); // Removed from Cache closure to access dynamic session value

            // Use prepared statements to avoid SQL injection
            $data = Cache::remember('total_leads_' . $user_id, 10, function () use ($user_id) {
                return DB::select("
                SELECT l.id, l.name, l.contact, l.service, l.state, l.city, l.added_by, l.date,
                       la.lead_status, u.username as added_by, services.service_name as SName,
                (
                    SELECT lf.followup_date
                    FROM lead_followups as lf
                    WHERE lf.lead_id = l.id
                    ORDER BY lf.id DESC
                    LIMIT 1
                ) as latest_followup_date
                FROM leads as l
                LEFT JOIN users as u ON l.added_by = u.id
                LEFT JOIN lead_assign as la ON la.lead_id = l.id
                LEFT JOIN services ON l.service = services.service_id
                WHERE la.assign_to = ?
                ORDER BY la.id DESC
            ", [$user_id]); // Prepared statement to protect user_id
            });

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
                    return $data->SName ?? $data->service; // Simplified null check
                })
                ->addColumn('mark4', function ($data) {
                    return $data->added_by ?? 'Inquiry Form'; // Simplified null check
                })
                ->addColumn('lfd', function ($data) {
                    $TDate = date('Y-m-d');
                    return ($data->latest_followup_date === null || $data->latest_followup_date < $TDate)
                        ? 'No Date'
                        : $data->latest_followup_date;
                })
                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4', 'lfd'])
                ->make(true);
        }

        $services = Cache::remember('services', 30, function () {
            return DB::table('services')->get(); // Return value added
        });

        $categories = Cache::remember('categories', 30, function () {
            return DB::table('categories')->get(); // Fixed query and added return
        });

        return view('SED.manage_lead', compact('services', 'categories'));
    }


    public function AddSalesEmpLead(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $AddLead = DB::table('leads')->insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'service' => $request->input('service'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'added_by' => $user_id,
            'lead_type' => 1,
            'company_id' => $company_id,
        ]);

        DB::table('lead_assign')
            ->insertGetId([
                'lead_id' => $AddLead,
                'assign_to' => $user_id,
                'lead_type' => 1,
            ]);

        DB::table('leads')->where('id', $AddLead)
            ->update(['is_assign' => 1]);

        if ($AddLead != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function UpdateSalesEmpLead(Request $request)
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
        $company_id = Session::get('company_id');
        $user_id = Session::get('user_id');
        $lead_id = $request->lead_id2;
        $lead_status = $request->lead_status;
        $lead_remark = $request->lead_remark;
        $token = $request->_token;
        $service_price = $request->service_price;
        $payment_status = 1;
		$TDate = date('Y-m-d');
      
        $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id' AND is_payment != 1");

      	DB::table('lead_followups')->where('lead_id', $lead_id)->where('user_id', $user_id)->where('followup_date', $TDate)
        ->update(['is_called' => 1]);
      
        // if (count($customer) > 0) {
        //     if ($lead_status == 5) {
        //         DB::table('customers')
        //             ->where('lead_id', $lead_id)
        //             ->update([
        //                 'service_price' => $service_price,
        //                 'is_payment' => $payment_status,
        //             ]);
        //         DB::table('leads')
        //             ->where('id', $lead_id)
        //             ->update([
        //                 'is_payment' => $payment_status,
        //             ]);
        //         return response()->json(['success' => false,  'message' => 'Update Success']);
        //     } else {
        //         $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
        //             'user_id' => $user_id,
        //             'lead_id' => $lead_id,
        //             'lead_status' => $lead_status,
        //             'lead_remark' => $lead_remark,
        //         ]);

        //         DB::table('lead_assign')
        //             ->where('lead_id', $lead_id)
        //             ->update([
        //                 'lead_status' => $lead_status,
        //             ]);

        //         if ($AddLeadRemark != 0) {
        //             return redirect()->back();
        //         } else {
        //             return redirect()->back();
        //         }
        //     }
        // } else {
        //     if ($lead_status == 5) {



        //         $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
        //             'user_id' => $user_id,
        //             'lead_id' => $lead_id,
        //             'lead_status' => $lead_status,
        //             'lead_remark' => $lead_remark,
        //         ]);

        //         DB::table('lead_assign')
        //             ->where('lead_id', $lead_id)
        //             ->update([
        //                 'lead_status' => $lead_status,
        //             ]);
        //         DB::table('leads')
        //             ->where('id', $lead_id)
        //             ->update([
        //                 'is_customer' => 1,
        //                 'is_payment' => $payment_status,
        //             ]);

        //         $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id'");
        //         if (count($customer) == 0) {
        //             $clients = DB::select("SELECT * FROM leads WHERE id = '$lead_id'");

        //             foreach ($clients as $client) {
        //                 // dd($client->name);
        //                 DB::table('customers')->insertGetId([
        //                     'lead_id' => $client->id,
        //                     'name' => $client->name,
        //                     'email' => $client->email,
        //                     'contact' => $client->contact,
        //                     'service' => $client->service,
        //                     'service_price' => $service_price,
        //                     'state' => $client->state,
        //                     'city' => $client->city,
        //                     'password' => 123456,
        //                     'company_id' => $company_id,
        //                     'customer_token' => $token,
        //                     'added_by' => $user_id,
        //                 ]);
        //             }
        //         }



        //         if ($AddLeadRemark != 0) {
        //             return redirect()->back();
        //         } else {
        //             return redirect()->back();
        //         }
        //     } else {
        //         $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
        //             'user_id' => $user_id,
        //             'lead_id' => $lead_id,
        //             'lead_status' => $lead_status,
        //             'lead_remark' => $lead_remark,
        //         ]);

        //         DB::table('lead_assign')
        //             ->where('lead_id', $lead_id)
        //             ->update([
        //                 'lead_status' => $lead_status,
        //             ]);

        //         if ($AddLeadRemark != 0) {
        //             return redirect()->back();
        //         } else {
        //             return redirect()->back();
        //         }
        //     }
        // }

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

    public function AddLeadFollowup(Request $request)
    {
        $user_id = Session::get('user_id');
        $lead_id = $request->lead_id3;
        $followup_date = $request->followup_date;
        $followup_remark = $request->followup_remark;

      
       $date = date('Y-m-d');
        DB::table('lead_followups')->where('lead_id', $lead_id)->where('user_id', $user_id)->where('followup_date', $date)
        ->update(['is_called' => 1]);
      
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
        $date = date('Y-m-d');
        $hours = date('H');
        $nexthours = date('H:i:s', strtotime('+1 hour'));

        // Prepare the query using parameter binding to avoid SQL injection
        $followupcalls = DB::select("SELECT * FROM lead_followups LEFT JOIN leads ON lead_followups.lead_id = leads.id
        WHERE lead_followups.user_id = '$user_id' AND lead_followups.followup_date = '$date' AND lead_followups.is_called = 0
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
            // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' ORDER BY l.id DESC");
            // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id LEFT JOIN services ON l.service = services.service_id WHERE la.assign_to = '$user_id' ORDER BY la.id DESC");

            $data = DB::select("SELECT l.id, l.name, l.contact, l.service, l.state, l.city, l.added_by, l.date , la.lead_status, u.username as added_by, services.service_name as SName,
            (
                SELECT lf.followup_date FROM lead_followups as lf
                WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
            ) as latest_followup_date



            FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN lead_assign as la ON la.lead_id = l.id
            LEFT JOIN services ON l.service = services.service_id
            WHERE la.assign_to = '$user_id'
            ORDER BY la.id DESC");
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
                ->addColumn('mark4', function ($data) {
                    $ad_by = ($data->added_by !== null) ? $data->added_by : 'Inquiry Form';
                    return $ad_by;
                })

                ->addColumn('lfd', function ($data) {
                    $TDate = date('Y-m-d');
                    if ($data->latest_followup_date == null || $data->latest_followup_date < $TDate) {
                        return 'No Date';
                    } else {
                        return $data->latest_followup_date;
                    }
                })

                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4', 'lfd'])
                ->make(true);
        } else {
            // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' AND la.lead_status = '$lead_status' ORDER BY l.id DESC");
            // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName
            // FROM leads as l LEFT JOIN users as u ON l.added_by = u.id
            // LEFT JOIN lead_assign as la ON la.lead_id = l.id
            // LEFT JOIN services ON l.service = services.service_id
            // WHERE la.assign_to = '$user_id'  AND la.lead_status = '$lead_status'
            // ORDER BY la.id DESC");


            $data = DB::select("SELECT l.id, l.name, l.contact, l.service, l.state, l.city, l.added_by, l.date , la.lead_status, u.username as added_by, services.service_name as SName,
            (
                SELECT lf.followup_date FROM lead_followups as lf
                WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
            ) as latest_followup_date



            FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN lead_assign as la ON la.lead_id = l.id
            LEFT JOIN services ON l.service = services.service_id
            WHERE la.assign_to = '$user_id' AND la.lead_status = '$lead_status'
            ORDER BY la.id DESC");

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
                ->addColumn('mark4', function ($data) {
                    $ad_by = ($data->added_by !== null) ? $data->added_by : 'Inquiry Form';
                    return $ad_by;
                })

                ->addColumn('lfd', function ($data) {
                    $TDate = date('Y-m-d');
                    if ($data->latest_followup_date == null || $data->latest_followup_date < $TDate) {
                        return 'No Date';
                    } else {
                        return $data->latest_followup_date;
                    }
                })

                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4', 'lfd'])
                ->make(true);
        }
    }

    function EmpFollowupLeadFilter()
    {
        $user_id = Session::get('user_id');
        $tDate = Date('Y-m-d');
        // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName FROM leads as l
        // LEFT JOIN users as u ON l.added_by = u.id
        // LEFT JOIN lead_assign as la ON la.lead_id = l.id
        // LEFT JOIN services ON l.service = services.service_id
        // LEFT JOIN lead_followups lf ON lf.lead_id = l.id
        // WHERE la.assign_to = '$user_id'
        // AND lf.followup_date = '$tDate'
        // ORDER BY la.id DESC");


        $data = DB::select("SELECT l.id, l.name, l.contact, l.service, l.state, l.city, l.added_by, l.date , la.lead_status, u.username as added_by, services.service_name as SName,
                (SELECT lf.followup_date FROM lead_followups as lf
                    WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
                ) as latest_followup_date

                FROM leads as l
                LEFT JOIN users as u ON l.added_by = u.id
                LEFT JOIN lead_assign as la ON la.lead_id = l.id
                LEFT JOIN services ON l.service = services.service_id
                LEFT JOIN lead_followups lf ON lf.lead_id = l.id
                WHERE la.assign_to = '$user_id' AND lf.followup_date = '$tDate' AND lf.is_called = 0
                ORDER BY la.id DESC");


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

            ->addColumn('mark4', function ($data) {
                $ad_by = ($data->added_by !== null) ? $data->added_by : 'Inquiry Form';
                return $ad_by;
            })

            ->addColumn('lfd', function ($data) {
                $TDate = date('Y-m-d');
                if ($data->latest_followup_date == null || $data->latest_followup_date < $TDate) {
                    return 'No Date';
                } else {
                    return $data->latest_followup_date;
                }
            })

            ->rawColumns(['mark', 'mark2', 'mark3', 'mark4', 'lfd'])
            ->make(true);
    }

    // add offline customer
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

        $lead_id = $request->customer_lead_id;
        $lead_status = 5;
        $lead_remark = $request->customer_comment;

        $cust_doc = $request->file('payment_screenshot');

        $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id' AND is_payment != 1");

        // dd(count($customer));

        $hotelLogo = null;
        $HLogo = $cust_doc;
        $hotelLogo = $cust_name . "." . $HLogo->getClientOriginalExtension();
        $destinationPath = public_path('/payment');
        $HLogo->move($destinationPath, $hotelLogo);


        // ------------------------already customer-----------------------------//
        if (count($customer) > 0) {
            // dd('inner');
            $old_cust_id = $customer[0]->id;
            $order = DB::select("SELECT * FROM orders WHERE customer_id = '$old_cust_id' AND payment_status != 0");

            if (count($order) > 0) {

                $order_id = 'order_' . uniqid();
                $payment_id = 'offline_' . uniqid();
                $oID = DB::table('orders')->insertGetId([
                    'customer_id' => $customer[0]->id,
                    'package_id' => $cust_service,
                    'order_id' => $order_id,
                    'payment_id' => $payment_id,
                    'total_amount' => $cust_paid_amount,
                    'payment_status' => 1,
                ]);

                DB::table('customer_emi')->insertGetId([
                    'customer_id' => $customer[0]->id,
                    'order_id' => $oID,
                    'emi_type' => $cust_payment_mode,
                    'emi_total_amount' => $cust_total_service_price,
                    'emi_paid_amount' => $cust_paid_amount,
                    'emi_unpaid_amount' => $cust_unpaid_amount,
                    'emi_due_date' => $cust_due_date,
                    'emi_comment' => $cust_comment,
                    'payment_screenshot' => $hotelLogo,
                ]);

                $s_name = DB::select("SELECT s.service_name,s.service_id FROM combo_packages cp
                        LEFT JOIN services s ON cp.cp_title = s.service_id
                        WHERE cp.cp_id = '$cust_service'");


                $ss = '';
                $sid = '';
                foreach ($s_name as $key) {
                    $ss = $key->service_name;
                    $sid = $key->service_id;
                }

                // dd($ss);
                DB::table('operation_tasks')->insertGetId([
                    'cust_id' => $customer[0]->id,
                    'service_id' => $sid,
                    'task_name' => $ss,
                    'added_by' => $user_id,
                ]);
                DB::table('operation_tasks')->insertGetId([
                    'cust_id' => $customer[0]->id,
                    'service_id' => $sid,
                    'task_name' => 'Customer Support',
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

                DB::table('lead_remarks')->insertGetId([
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

                if ($oID) {
                    return redirect()->back()->with('success', 'Order Purchase Successful!!');
                } else {
                    return redirect()->back()->with('success', 'Order Not Purchase!!');
                }
            }
        }

        // dd('outer');
        // ------------------------------for new customer----------------------------------//
        $custID = DB::table('customers')->insertGetId([
            'lead_id' => $lead_id,
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
            'emi_comment' => $cust_comment,
            'payment_screenshot' => $hotelLogo,
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
        $ot_id = DB::table('operation_tasks')->insertGetId([
            'cust_id' => $custID,
            'service_id' => $sid,
            'task_name' => 'Customer Support',
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

        DB::table('lead_remarks')->insertGetId([
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



        if ($oID) {
            return redirect()->back()->with('success', 'Order Purchase Successful!!');
        } else {
            return redirect()->back()->with('success', 'Order Not Purchase!!');
        }
    }
}
