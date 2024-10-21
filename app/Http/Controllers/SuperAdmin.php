<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;



class SuperAdmin extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('SuperAdmin.dashboard');
    }
    public function ManageAdmin(Request $request)
    {
        // $data = DB::select("SELECT * FROM users WHERE user_type = 2 ORDER BY id DESC");
        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM users WHERE user_type = 2 ORDER BY id DESC");

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="AdminDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteAdmin(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('SuperAdmin.manage_admin');
    }

    public function AdminDetail(Request $request)
    {
        $user_id = $request->user_id;
        $data = DB::table('users')->where('id', $user_id)->get();
        return response()->json(['data' => $data]);
    }


    public function ManageManager(Request $request)
    {
        return view('SuperAdmin.manage_manager');
    }
    public function ManageEmployee(Request $request)
    {
        return view('SuperAdmin.manage_employee');
    }

    public function AddNewAdmin(Request $request)
    {
        $user_id = Session::get('user_id');

        $company_id = DB::table('users')->orderBy('id', 'desc')->first();

        $fourDigitString = substr($request->input('username'), 0, 4);
        $c_id = $fourDigitString. $company_id->id;
        // dd($c_id);
        // $uniqueString = md5(uniqid());

        $AddAdmin = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'user_type' => 2,
            'added_by' => $user_id,
            'password' => $request->input('password'),
            'user_token' => $request->input('_token'),
            'company_id' => $c_id,
        ]);


        if ($AddAdmin != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function UpdateAdmin(Request $request)
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

    public function DeleteAdmin(Request $request)
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
}
