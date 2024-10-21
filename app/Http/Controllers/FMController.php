<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;


class FMController extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('FM.dashboard');
    }

    public function ManageEmployee(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        // $data = DB::select("SELECT * FROM users WHERE user_type = 3 OR user_type = 4 OR user_type = 5 AND added_by = $user_id ORDER BY id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM users WHERE user_type = 8 ORDER BY id DESC");

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="FranchiseEmployeeDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteFranchiseEmployee(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('FM.manage_employee');
    }


    public function AddFranchiseEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:10',
        ]);

        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $AddEmployee = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'user_type' => 8,
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



    public function FranchiseEmployeeDetail(Request $request)
    {
        $user_id = $request->user_id;
        $data = DB::table('users')->where('id', $user_id)->get();
        return response()->json(['data' => $data]);
    }

    public function UpdateFranchiseEmployee(Request $request)
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

    public function DeleteFranchiseEmployee(Request $request)
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

    public function FranchiseClientList(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name FROM leads as l 
LEFT JOIN users as u ON l.added_by = u.id 
LEFT JOIN lead_assign as la ON la.lead_id = l.id 
LEFT JOIN services ON services.service_id = l.service 
WHERE l.lead_type = 2 AND l.company_id = '$company_id' ORDER BY l.id DESC");
        
        

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by, services.service_name FROM leads as l 
LEFT JOIN users as u ON l.added_by = u.id 
LEFT JOIN lead_assign as la ON la.lead_id = l.id 
LEFT JOIN services ON services.service_id = l.service 
WHERE l.lead_type = 2 AND l.company_id = '$company_id' ORDER BY l.id DESC");

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


                ->rawColumns(['mark', 'mark2'])
                ->make(true);
        }
        $partners = DB::table('users')->where('user_type', 8)->where('company_id', $company_id)->get();
        return view('FM.client_list', compact('partners'));
    }

    public function TraningVideos(Request $request)
    {
        return view('FM.traning_videos');
    }

    public function GetLeadRemarks(Request $request)
    {
        $lead_id = $request->lead_id;
        // dd($lead_id);
        $data = DB::table('lead_remarks')->where('lead_id', $lead_id)->get();
        // $data = json_encode($data);
        return response()->json(['data' => $data]);
    }

    public function GetFollowupCallsCount()
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $date = Date('Y-m-d');
        $followupcalls = DB::select("SELECT * FROM lead_followups LEFT JOIN leads ON lead_followups.lead_id = leads.id WHERE lead_followups.followup_date = '$date' AND leads.lead_type = 2 AND leads.company_id = '$company_id' ORDER BY lead_followups.id DESC");
        return response()->json(['data' => $followupcalls]);
    }

    public function EmpLeadFilter(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $lead_status = $request->lead_status;
        // $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.assign_to = '$user_id' AND la.lead_status = '$lead_status' ORDER BY l.id DESC");

        // return response()->json(['data' => $data]);
        if ($lead_status == 'all') {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE l.lead_type = 2 AND l.company_id = '$company_id' ORDER BY l.id DESC");

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


                ->rawColumns(['mark', 'mark2'])
                ->make(true);
        } else {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE la.lead_status = '$lead_status' AND l.lead_type = 2 AND l.company_id = '$company_id' ORDER BY l.id DESC");

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


                ->rawColumns(['mark', 'mark2'])
                ->make(true);
        }
    }
    public function GetFollowupCallsDetails()
    {
        $user_id = Session::get('user_id');
        $date = Date('Y-m-d');
        $followupcalls = DB::select("SELECT * FROM lead_followups LEFT JOIN leads ON lead_followups.lead_id = leads.id WHERE leads.lead_type = 2 AND lead_followups.followup_date = '$date' ORDER BY lead_followups.id DESC");
        return response()->json(['data' => $followupcalls]);
    }
    public function GetEmpLeadCount(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');

        $data = [
            'totalLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->count(),
            'newLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->where('lead_status', 0)->count(),
            'notintrestedLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->where('lead_status', 1)->count(),
            'intrestedLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->where('lead_status', 2)->count(),
            'quotationLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->where('lead_status', 3)->count(),
            'hotLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->where('lead_status', 4)->count(),
            'customerLeads' => DB::table('lead_assign')->where('company_id', $company_id)->where('lead_type', 2)->where('lead_status', 5)->count(),
        ];

        return response()->json(['data' => $data]);
    }

    public function PartnerWiseFilter(Request $request)
    {
        $company_id = Session::get('company_id');
        $p_id = $request->p_id;
        if ($p_id == 'all') {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE l.lead_type = 2 AND l.company_id = '$company_id' ORDER BY l.id DESC");

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


                ->rawColumns(['mark', 'mark2'])
                ->make(true);
        } else {
            $data = DB::select("SELECT l.*, la.lead_status, u.username as added_by FROM leads as l LEFT JOIN users as u ON l.added_by = u.id LEFT JOIN lead_assign as la ON la.lead_id = l.id WHERE l.added_by = '$p_id' AND l.lead_type = 2 AND l.company_id = '$company_id' ORDER BY l.id DESC");

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


                ->rawColumns(['mark', 'mark2'])
                ->make(true);
        }
    }
}
