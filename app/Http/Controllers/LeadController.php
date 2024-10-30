<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;


class LeadController extends Controller
{
    public function ManageLeads(Request $request)
    {
        $company_id = Session::get('company_id');
        if ($request->ajax()) {
            $data = DB::select("SELECT l.*, u.username as added_by, services.service_name as SName FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN services ON l.service = services.service_id
            where l.company_id = '$company_id'
            AND l.added_by != 41 AND l.added_by != 63 AND l.added_by != 64 AND l.added_by != 65 AND l.added_by != 70
            ORDER BY l.id DESC");

            return Datatables::of($data)

                ->addColumn('mark', function ($data) {
                    return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
                })
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="SalesLeadDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteSalesLead(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->addColumn('mark3', function ($data) {
                    $s_name = ($data->SName !== null) ? $data->SName : $data->service;
                    return $s_name;
                })
                ->addColumn('mark2', function ($data) {
                    $ad_by = ($data->added_by !== null) ? $data->added_by : 'Inquiry Form';
                    return $ad_by;
                })

                ->rawColumns(['mark', 'action', 'mark3', 'mark2'])
                ->make(true);
        }

        $sales_employees = DB::table('users')->where('user_type', 6)->where('status', 1)->where('company_id', $company_id)->get();
        $services = DB::table('services')->where('company_id', $company_id)->get();
        return view('SM.manage_leads', compact('sales_employees', 'services'));
    }

    public function AddSalesLead(Request $request)
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

        if ($AddLead != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function SalesLeadDetail(Request $request)
    {
        $lead_id = $request->lead_id;
        // $data = DB::table('leads')->where('id', $lead_id)->get();
        // $data = DB::select("SELECT * FROM leads LEFT JOIN services ON leads.service = services.service_id WHERE leads.id = '$lead_id'");

        // $lastfollowupremark = DB::table('lead_followups')->where('lead_id', $lead_id)->get();
        // $lastleadremark = DB::table('lead_remarks')->where('lead_id', $lead_id)->get();

        $data = [
            'details' => DB::select("SELECT * FROM leads LEFT JOIN services ON leads.service = services.service_id WHERE leads.id = '$lead_id'"),
            'lastfollowupremark' => DB::table('lead_followups')->select('followup_remark')->where('lead_id', $lead_id)->orderBy('id', 'desc')->first(),
            'lastleadremark' => DB::table('lead_remarks')->select('lead_remark')->where('lead_id', $lead_id)->orderBy('id', 'desc')->first(),
        ];
        return response()->json(['data' => $data]);
    }

    public function SalesOthersLead(Request $request)
    {
        $lead_id = $request->lead_id;
        // $data = DB::table('leads')->where('id', $lead_id)->get();
        $data = DB::select("SELECT * FROM other_leads LEFT JOIN services ON other_leads.service_id = services.service_id WHERE other_leads.lead_id = '$lead_id'");
        return response()->json(['data' => $data]);
    }


    public function UpdateSalesLead(Request $request)
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

    public function DeleteSalesLead(Request $request)
    {
        $lead_id = $request->lead_id;
        // dd($lead_id);
        $deleted = DB::table('leads')->where('id', $lead_id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'User Deleted successful']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }


    public function AssignSalesLeadTo(Request $request)
    {
        // dd($request);
        // $leadIDs = $request->selected;
        // $userID = $request->user_id;
        // // dd($userID);



        // $check = DB::table('leads')->where('is_assign', 1)->whereIn('id', $leadIDs)->get();
        // if (count($check) > 0) {
        //     return response()->json(['success' => false, 'message' => 'Lead Already Assign!!']);
        // } else {
        //     for ($i = 0; $i < count($leadIDs); $i++) {
        //         $timeLine = DB::table('lead_assign')
        //             ->insertGetId([
        //                 'lead_id' => $leadIDs[$i],
        //                 'assign_to' => $userID,
        //                 'lead_type' => 1,
        //             ]);
        //     }
        //     DB::table('leads')->whereIn('id', $leadIDs)
        //         ->update(['is_assign' => 1]);


        //     return response()->json(['success' => true]);
        // }

        $leadIDs = $request->selected;
        $userID = $request->user_id;

        $check = DB::table('leads')->where('is_assign', 1)->whereIn('id', $leadIDs)->exists();

        if ($check) {

        DB::table('lead_assign')->whereIn('lead_id', $leadIDs)->update(['assign_to' => $userID]);


            return response()->json(['success' => true]);
            // return response()->json(['success' => false, 'message' => 'Lead Already Assign!!']);
        } else {
            $leadAssignData = [];
            foreach ($leadIDs as $leadID) {
                $leadAssignData[] = [
                    'lead_id' => $leadID,
                    'assign_to' => $userID,
                    'lead_type' => 1,
                ];
            }

            $timeLine = DB::table('lead_assign')->insert($leadAssignData);

            DB::table('leads')->whereIn('id', $leadIDs)->update(['is_assign' => 1]);

            return response()->json(['success' => true]);
        }
    }

    public function SalesLeadFilter(Request $request)
    {
        $lead_status = $request->lead_status;
        $company_id = Session::get('company_id');

        if ($lead_status == 'all') {
            $data = DB::select("SELECT l.*, u.username as added_by, services.service_name as SName FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN services ON l.service = services.service_id
            where l.company_id = '$company_id'
            AND l.added_by != 41 AND l.added_by != 63 AND l.added_by != 64 AND l.added_by != 65 AND l.added_by != 70
            ORDER BY l.id DESC");

            return Datatables::of($data)

                ->addColumn('mark', function ($data) {
                    return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
                })
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="SalesLeadDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteSalesLead(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->addColumn('mark3', function ($data) {
                    $s_name = ($data->SName !== null) ? $data->SName : $data->service;
                    return $s_name;
                })
                ->addColumn('mark2', function ($data) {
                    $ad_by = ($data->added_by !== null) ? $data->added_by : 'Inquiry Form';
                    return $ad_by;
                })
                ->rawColumns(['mark', 'action', 'mark3', 'mark2'])
                ->make(true);
        } else {

            $data = DB::select("SELECT l.*, u.username as added_by, services.service_name as SName FROM leads as l
            LEFT JOIN users as u ON l.added_by = u.id
            LEFT JOIN services ON l.service = services.service_id
            WHERE l.is_assign = '$lead_status' and l.company_id = '$company_id'
            AND l.added_by != 41 AND l.added_by != 63 AND l.added_by != 64 AND l.added_by != 65 AND l.added_by != 70
            ORDER BY l.id DESC");

            return Datatables::of($data)

                ->addColumn('mark', function ($data) {
                    return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
                })
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="SalesLeadDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteSalesLead(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })
                ->addColumn('mark3', function ($data) {
                    $s_name = ($data->SName !== null) ? $data->SName : $data->service;
                    return $s_name;
                })
                ->addColumn('mark2', function ($data) {
                    $ad_by = ($data->added_by !== null) ? $data->added_by : 'Inquiry Form';
                    return $ad_by;
                })
                ->rawColumns(['mark', 'action', 'mark3', 'mark2'])
                ->make(true);
        }
    }

     public function SalesLeadWithDetails(Request $request)
    {
        $company_id = Session::get('company_id');


        if ($request->ajax()) {
            $data = DB::select(
                "SELECT
                    l.*,
                    la.lead_status,
                    la.assign_to,
                    u.username as assign_to,
                    us.username as added_by,
                    services.service_name as SName,

                    (
                    SELECT lf.followup_date FROM lead_followups as lf
                    WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
                ) as latest_followup_date

                FROM
                    leads as l
                LEFT JOIN
                    lead_assign as la ON la.lead_id = l.id
                LEFT JOIN
                    services ON l.service = services.service_id
                LEFT JOIN
                    users as u ON la.assign_to = u.id
                LEFT JOIN
                    users as us ON l.added_by = us.id
                WHERE
                    l.company_id = ?
                    AND l.is_assign = 1 AND l.is_customer = 0
                ORDER BY
                    la.id DESC",
                [$company_id]
            );


            // $data = DB::select('CALL GetLeadsWithDetails(?)', [$company_id]);

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

                ->addColumn('checkmark', function ($data) {
                    return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
                })
                ->rawColumns(['checkmark', 'mark', 'mark2', 'mark3', 'mark4', 'lfd'])
                ->make(true);
        }

        $sales_employees = DB::table('users')->where('user_type', 6)->where('status', 1)->where('company_id', $company_id)->get();

        $services = DB::table('services')->where('company_id', $company_id)->get();
        return view('SM.leads_with_details', compact('services', 'sales_employees'));
    }

    public function GetEmpLeadCount(Request $request)
    {

        $company_id = Session::get('company_id');
        $data = [
            'totalLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('leads.company_id', '=', $company_id)->count(),
            'newLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 0)->where('leads.company_id', '=', $company_id)->count(),
            'notintrestedLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 1)->where('leads.company_id', '=', $company_id)->count(),
            'intrestedLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 2)->where('leads.company_id', '=', $company_id)->count(),
            'quotationLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 3)->where('leads.company_id', '=', $company_id)->count(),
            'hotLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 4)->where('leads.company_id', '=', $company_id)->count(),
            'customerLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 5)->where('leads.company_id', '=', $company_id)->count(),
            'notconnectedLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 6)->where('leads.company_id', '=', $company_id)->count(),
            'negotiationLeads' => DB::table('lead_assign')->leftJoin('leads', 'lead_assign.lead_id', '=', 'leads.id')->where('lead_assign.lead_status', 7)->where('leads.company_id', '=', $company_id)->count(),
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
        $payment_status = $request->payment_status;

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
        $company_id = Session::get('company_id');
        $date = Date('Y-m-d');
        $followupcalls = DB::select("SELECT * FROM lead_followups LEFT JOIN leads ON lead_followups.lead_id = leads.id
        WHERE lead_followups.followup_date = '$date' AND leads.company_id = '$company_id' ORDER BY lead_followups.id DESC");
        return response()->json(['data' => $followupcalls]);
    }

    public function EmpLeadFilter(Request $request)
    {
        $company_id = Session::get('company_id');

        $lead_status = $request->lead_status;
        // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' AND la.lead_status = '$lead_status' ORDER BY l.id DESC");

        // return response()->json(['data' => $data]);
        if ($lead_status == 'all') {
            // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' ORDER BY l.id DESC");
            $data = DB::select(
                "SELECT
                    l.*,
                    la.lead_status,
                    la.assign_to,
                    u.username as assign_to,
                    us.username as added_by,
                    services.service_name as SName,
                    (
                SELECT lf.followup_date FROM lead_followups as lf
                WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
            ) as latest_followup_date
                FROM
                    leads as l
                LEFT JOIN
                    lead_assign as la ON la.lead_id = l.id
                LEFT JOIN
                    services ON l.service = services.service_id
                LEFT JOIN
                    users as u ON la.assign_to = u.id
                LEFT JOIN
                    users as us ON l.added_by = us.id
                WHERE
                    l.company_id = ?
                    AND l.is_assign = 1
                ORDER BY
                    la.id DESC",
                [$company_id]
            );

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

                ->addColumn('checkmark', function ($data) {
                    return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
                })
                ->rawColumns(['checkmark', 'mark', 'mark2', 'mark3', 'mark4', 'lfd'])
                ->make(true);
        } else {


            $data = DB::select(
                "SELECT
                        l.*,
                        la.lead_status,
                        la.assign_to,
                        u.username as assign_to,
                        us.username as added_by,
                        services.service_name as SName,
                        (
                SELECT lf.followup_date FROM lead_followups as lf
                WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
            ) as latest_followup_date
                    FROM
                        leads as l
                    LEFT JOIN
                        lead_assign as la ON la.lead_id = l.id
                    LEFT JOIN
                        services ON l.service = services.service_id
                    LEFT JOIN
                        users as u ON la.assign_to = u.id
                    LEFT JOIN
                        users as us ON l.added_by = us.id
                    WHERE la.lead_status = '$lead_status'
                        AND
                        l.company_id = ?
                        AND l.is_assign = 1
                    ORDER BY
                        la.id DESC",
                [$company_id]
            );

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

                ->addColumn('checkmark', function ($data) {
                    return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
                })
                ->rawColumns(['checkmark', 'mark', 'mark2', 'mark3', 'mark4', 'lfd'])
                ->make(true);
        }
    }

    public function CustomerInquiry(Request $request)
    {
        $company_id = Session::get('company_id');
        // $data = DB::select("SELECT * FROM customer_inquiries as ci LEFT JOIN customers as c ON ci.cust_id = c.id LEFT JOIN services as s ON ci.service_id=s.service_id ORDER BY ci.inq_id DESC");
        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM customer_inquiries as ci LEFT JOIN customers as c ON ci.cust_id = c.id LEFT JOIN services as s ON ci.service_id=s.service_id ORDER BY ci.inq_id DESC");

            return Datatables::of($data)

                ->make(true);
        }

        return view('SM.customer_inqury');
    }


    public function addBulkLeads(Request $request)
    {
        try {
            $data = Excel::import(new LeadsImport, $request->file('file')->store('files'));
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

    // inquiry
    function AddInquiryLead(Request $request)
    {
        // dd($request);
        $service_id = $request->service;
        $user_id = 404;
        $company_id = 'ETax1';
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

        $business_consultancy = [131, 132, 133, 134, 140, 141, 142, 144, 145, 152, 153, 154, 155, 156, 157, 158, 159, 160, 216];
        $audit_compliance = [91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130];
        $fpc = [6];
        $marketing_package = [189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,217];
        $mentorship_program = [218];
        $banking_business = [7, 9, 17, 18, 19];
        // $other_business = [1, 2, 3];

        // Correct syntax for in_array
        if (in_array($service_id, $business_consultancy)) {

            // business consultancy link
            $whatsappLink = "https://chat.whatsapp.com/F1klhONvD3u1JgFU3z6jSj";
        } elseif (in_array($service_id, $audit_compliance)) {

            // audit & compliance link
            $whatsappLink = "https://chat.whatsapp.com/LixTtgpNLHf9Trjt68OXPI";
        } elseif (in_array($service_id, $fpc)) {

            // fpc link
            $whatsappLink = "https://chat.whatsapp.com/EQSmRg4X3F0EO4Gb5fZorQ";
        } elseif (in_array($service_id, $marketing_package)) {

            // marketing packages link
            $whatsappLink = "https://chat.whatsapp.com/ED4yTKJFdNiByFanGaoYUT";
        } elseif (in_array($service_id, $mentorship_program)) {

            // mentorship program link
            $whatsappLink = "https://chat.whatsapp.com/C7cLOxrCHAJAlxlwE8wSF2";
        } elseif (in_array($service_id, $banking_business)) {

            // banking business link
            $whatsappLink = "https://chat.whatsapp.com/HBFdvbYJhRX5K0ZTCgbmxG";
        } else {

            // other than above all
            $whatsappLink = "https://chat.whatsapp.com/FcPN25HQ00bHpe1KSC7OGI";
        }


        // Define a message with an HTML button for a WhatsApp group link
        $msg = "Thank You for Your Enquiry. <br> One of our Experts will call your shortly.";

        // Construct a WhatsApp group link (example group link, use your own)


        // Include a button in the message
        $msg .= '<br>For More Information Join Our WhatsApp Group.<br><a href="' . $whatsappLink . '" class="btn btn-success">Join WhatsApp Group</a>';

        return response()->json([
            'message' => $msg,
        ]);
    }

    function AddPartnerWebinarLead(Request $request)
    {
         // dd($request);
         $service_id = $request->service;
         $user_id = 405;
         $company_id = 'ETax1';
         $AddLead = DB::table('leads')->insertGetId([
             'name' => $request->input('name'),
             'email' => $request->input('email'),
             'contact' => $request->input('contact'),
             'service' => 218,
             'state' => 'NA',
             'city' => 'NA',
             'added_by' => $user_id,
             'lead_type' => 1,
             'company_id' => $company_id,

         ]);

        // webinar link
        $link = "https://zoom.us/j/92424270553?pwd=QjFPR3RDZ3FnZXU5Y280RTkwR0hSQT09";



        // return redirect()->route('thank-you', compact('msg'));
        // return view('thank_you', compact( 'link'));
         return response()->json([
            'success' => true,
            'message' => $link,
        ]);
    }


    function TodaysFollowupLeadFilter()
    {
        $tDate = Date('Y-m-d');
        $company_id = Session::get('company_id');
        $data = DB::select(
            "SELECT
                    l.*,
                    la.lead_status,
                    la.assign_to,
                    u.username as assign_to,
                    us.username as added_by,
                    services.service_name as SName,
                    (
                SELECT lf.followup_date FROM lead_followups as lf
                WHERE lf.lead_id = l.id ORDER BY lf.id DESC LIMIT 1
            ) as latest_followup_date
                FROM
                    leads as l
                LEFT JOIN
                    lead_assign as la ON la.lead_id = l.id
                LEFT JOIN
                    services ON l.service = services.service_id
                LEFT JOIN
                    users as u ON la.assign_to = u.id
                LEFT JOIN
                    users as us ON l.added_by = us.id
                LEFT JOIN lead_followups lf ON lf.lead_id = l.id
                WHERE lf.followup_date = '$tDate'
                    AND
                    l.company_id = ?
                    AND l.is_assign = 1
                ORDER BY
                    la.id DESC",
            [$company_id]
        );

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


        ->addColumn('checkmark', function ($data) {
                return '<input type="checkbox" class="checkbox" name="" value="' . $data->id . '"/>';
            })
            ->rawColumns(['checkmark','mark', 'mark2', 'mark3', 'mark4', 'lfd'])
            ->make(true);
    }


    public function AddOtherLeads(Request $request)
    {
        // dd($request);
        DB::table('other_leads')->insertGetId([
             'lead_id' => $request->input('lead_id4'),
             'service_id' => $request->input('service_id22'),

         ]);

         return response()->json([
            'success' => true,
        ]);

    }


    function UploadBulkLeads(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new LeadsImport, request()->file('file'));

        return redirect()->back()->with('success', 'Leads Imported Successfully!');
    }
}
