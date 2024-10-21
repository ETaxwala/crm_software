<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
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
        $user_id = Session::get('user_id');
        // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' ORDER BY l.id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName FROM leads as l
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

                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4'])
                ->make(true);
        }

        $services  = DB::table('services')->get();
        return view('SED.manage_lead', compact('services'));
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
    // public function UpdateLeadStatus(Request $request)
    // {
    //     // dd($request);
    //     $company_id = Session::get('company_id');
    //     $user_id = Session::get('user_id');
    //     $lead_id = $request->lead_id2;
    //     $lead_status = $request->lead_status;
    //     $lead_remark = $request->lead_remark;
    //     $token = $request->_token;
    //     $service_price = $request->service_price;
    //     $payment_status = $request->payment_status;

    //     $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id' AND is_payment != 1");

    //     if (count($customer) > 0) {
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
    //         if ($lead_status == 5) {



    //             $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
    //                 'user_id' => $user_id,
    //                 'lead_id' => $lead_id,
    //                 'lead_status' => $lead_status,
    //                 'lead_remark' => $lead_remark,
    //             ]);

    //             DB::table('lead_assign')
    //                 ->where('lead_id', $lead_id)
    //                 ->update([
    //                     'lead_status' => $lead_status,
    //                 ]);
    //             DB::table('leads')
    //                 ->where('id', $lead_id)
    //                 ->update([
    //                     'is_customer' => 1,
    //                     'is_payment' => $payment_status,
    //                 ]);

    //             $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id'");
    //             if (count($customer) == 0) {
    //                 $clients = DB::select("SELECT * FROM leads WHERE id = '$lead_id'");

    //                 foreach ($clients as $client) {
    //                     // dd($client->name);
    //                     DB::table('customers')->insertGetId([
    //                         'lead_id' => $client->id,
    //                         'name' => $client->name,
    //                         'email' => $client->email,
    //                         'contact' => $client->contact,
    //                         'service' => $client->service,
    //                         'service_price' => $service_price,
    //                         'state' => $client->state,
    //                         'city' => $client->city,
    //                         'password' => 123456,
    //                         'company_id' => $company_id,
    //                         'customer_token' => $token,
    //                         'added_by' => $user_id,
    //                     ]);
    //                 }
    //             }



    //             if ($AddLeadRemark != 0) {
    //                 return redirect()->back();
    //             } else {
    //                 return redirect()->back();
    //             }
    //         } else {
    //             $AddLeadRemark = DB::table('lead_remarks')->insertGetId([
    //                 'user_id' => $user_id,
    //                 'lead_id' => $lead_id,
    //                 'lead_status' => $lead_status,
    //                 'lead_remark' => $lead_remark,
    //             ]);

    //             DB::table('lead_assign')
    //                 ->where('lead_id', $lead_id)
    //                 ->update([
    //                     'lead_status' => $lead_status,
    //                 ]);

    //             if ($AddLeadRemark != 0) {
    //                 return redirect()->back();
    //             } else {
    //                 return redirect()->back();
    //             }
    //         }
    //     }
    // }
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

        $customer = DB::select("SELECT * FROM customers WHERE lead_id = '$lead_id' AND is_payment != 1");

        if (count($customer) > 0) {
            if ($lead_status == 5) {
                DB::table('customers')
                    ->where('lead_id', $lead_id)
                    ->update([
                        'service_price' => $service_price,
                        'is_payment' => $payment_status,
                    ]);
                DB::table('leads')
                    ->where('id', $lead_id)
                    ->update([
                        'is_payment' => $payment_status,
                    ]);
                return response()->json(['success' => false,  'message' => 'Update Success']);
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
                        'is_payment' => $payment_status,
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
                            'service_price' => $service_price,
                            'state' => $client->state,
                            'city' => $client->city,
                            'password' => 123456,
                            'company_id' => $company_id,
                            'customer_token' => $token,
                            'added_by' => $user_id,
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
        $followupcalls = DB::select("SELECT * FROM lead_followups LEFT JOIN leads ON lead_followups.lead_id = leads.id WHERE lead_followups.user_id = '$user_id' AND lead_followups.followup_date = '$date' ORDER BY lead_followups.id DESC");
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
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id LEFT JOIN services ON l.service = services.service_id WHERE la.assign_to = '$user_id' ORDER BY la.id DESC");

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


                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4'])
                ->make(true);
        } else {
            // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' AND la.lead_status = '$lead_status' ORDER BY l.id DESC");
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id LEFT JOIN services ON l.service = services.service_id WHERE la.assign_to = '$user_id'  AND la.lead_status = '$lead_status' ORDER BY la.id DESC");

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

                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4'])
                ->make(true);
        }
    }

    function EmpFollowupLeadFilter()
    {
        $user_id = Session::get('user_id');
        $tDate = Date('Y-m-d');
        $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name as SName FROM leads as l
        LEFT JOIN users as u ON l.added_by = u.id
        LEFT JOIN lead_assign as la ON la.lead_id = l.id
        LEFT JOIN services ON l.service = services.service_id
        LEFT JOIN lead_followups lf ON lf.lead_id = l.id
        WHERE la.assign_to = '$user_id'
        AND lf.followup_date = '$tDate'
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

                ->rawColumns(['mark', 'mark2', 'mark3', 'mark4'])
                ->make(true);
    }
}
