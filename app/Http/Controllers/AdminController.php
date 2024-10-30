<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session, DB, DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;


class AdminController extends Controller
{
    public function AdminLogin(Request $request)
    {
        // dd($request['user_mail']);
        $email = $request['user_mail'];
        $pass = $request['user_password'];

        // dd($email);
        $user = DB::table('users')->where('email', $email)->first();
        // dd($user);
        if ($user) {
            if ($pass == $user->password) {

                if ($user->status == 1) {

                    // $user->update(['last_seen_at' => now()]);
                    date_default_timezone_set('Asia/Kolkata');
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update([
                            'last_login_at' => now(),
                            'is_online' => 1,
                        ]);



                    Session::put('token', $user->user_token);
                    Session::put('user_name', $user->username);
                    Session::put('user_id', $user->id);
                    Session::put('user_type', $user->user_type);
                    Session::put('company_id', $user->company_id);
                    Session::put('last_activity_time', Carbon::now());
                    Session::save();

                    DB::table('user_activity')->insertGetId([
                        'user_id' => $user->id,
                        'session_token' => Session::get('token'),
                        'last_login_time' => Session::get('last_activity_time'),
                    ]);
                    switch (Session::get('user_type')) {
                        case 1:
                            return redirect()->route('super-admin-dashboard');
                            break;
                        case 2:
                            return redirect()->route('admin-dashboard');
                            break;
                        case 3:
                            return redirect()->route('sales-manager-dashboard');
                            break;
                        case 4:
                            return redirect()->route('operation-manager-dashboard');
                            break;
                        case 5:
                            return redirect()->route('franchise-manager-dashboard');
                            break;
                        case 6:
                            return redirect()->route('sales-employee-dashboard');
                            break;
                        case 7:
                            return redirect()->route('operation-emp-dashboard');

                            break;
                        case 8:
                            return redirect()->route('franchise-employee-dashboard');
                            break;

                        // operation assistant
                        case 9:
                            return redirect()->route('assistant_manager');
                            break;
                    }
                } else {
                    return redirect('/user_login')->with('error', 'Your Account Is Deactive contact your Admin');
                }
            } else {
                return redirect('/user_login')->with('error', 'Wrong Password');
            }
        } else {
            return redirect('/user_login')->with('error', 'Email not exist');
        }
    }

    public function AdminLogout(Request $request)
    {
        $user_id = Session::get('user_id');

        DB::table('users')
            ->where('id', $user_id)
            ->update([
                'last_logout_at' => now(),
                'is_online' => 0,
            ]);


        Session::flush();
        Session::regenerate();
        return redirect('/user_login');
    }
}
