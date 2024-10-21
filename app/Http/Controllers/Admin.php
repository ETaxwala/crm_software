<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class Admin extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('Admin.dashboard');
    }

    public function ManageManager(Request $request)
    {
        $user_id = Session::get('user_id');
        // $data = DB::select("SELECT * FROM users WHERE user_type = 3 OR user_type = 4 OR user_type = 5 AND added_by = $user_id ORDER BY id DESC");

        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM users WHERE (user_type = 3 OR user_type = 4 OR user_type = 5) AND added_by = $user_id ORDER BY id DESC");

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="ManagerDetails(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteManager(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Admin.manage_manager');
    }


    public function AddAdminManager(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $AddManager = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'user_type' => $request->input('user_type'),
            'added_by' => $user_id,
            'password' => $request->input('password'),
            'user_token' => $request->input('_token'),
            'company_id' => $company_id,
        ]);


        if ($AddManager != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function ManageEmployee(Request $request)
    {
        return view('Admin.manage_employee');
    }

    public function ManagerDetail(Request $request)
    {
        $user_id = $request->user_id;
        $data = DB::table('users')->where('id', $user_id)->get();
        return response()->json(['data' => $data]);
    }

    public function UpdateManager(Request $request)
    {
        DB::table('users')
            ->where('id', $request->input('user_id'))
            ->update([
                'username' => $request->input('username'),
                'contact' => $request->input('contact'),
                'email' => $request->input('email'),
                'user_type' => $request->input('user_type'),
                'password' => $request->input('password'),
            ]);
    }

    public function DeleteManager(Request $request)
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

    // services
    public function ManageService(Request $request)
    {
        $company_id = Session::get('company_id');
        // dd($company_id);
        // $data = DB::select("SELECT * FROM services LEFT JOIN users ON services.added_by = users.id WHERE services.company_id = '$company_id'");
        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM services LEFT JOIN users ON services.added_by = users.id LEFT JOIN categories as ct ON ct.category_id = services.category_id WHERE services.company_id = '$company_id'");

            return Datatables::of($data)

                ->addColumn('price', function ($data) {
                    return 'Rs ' . $data->service_price . '';
                })

                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="EditService(' . $data->service_id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteService(' . $data->service_id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })
                ->addColumn('mark', function ($data) {
                    return '<span style="cursor:pointer" class="text-success" onclick="GetDocs(' . $data->service_id . ')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                  </svg></span>';
                })

                ->rawColumns(['action', 'mark', 'price'])
                ->make(true);
        }

        $categories = DB::table('categories')->where('company_id', $company_id)->get();
        return view('Admin.services', compact('categories'));
    }

    public function AddService(Request $request)
    {
        try {
            $user_id = Session::get('user_id');
            $company_id = Session::get('company_id');

            $service_id = DB::table('services')->insertGetId([
                'service_name' => $request->input('service_name'),
                'service_price' => $request->input('service_price'),
                'category_id' => $request->input('category_id'),
                'added_by' => $user_id,
                'company_id' => $company_id,
                'description' => $request->input('description'),
            ]);
        } catch (QueryException $e) {
            // Handle the database query exception
            Log::error('Database Error: ' . $e->getMessage());

            // Optionally, you can redirect the user back with an error message
            // return redirect()->back()->with('error', 'Database error occurred. Please try again.');

        } catch (\Exception $e) {
            // Handle other types of exceptions
            Log::error('Unexpected Error: ' . $e->getMessage());

            // Optionally, you can redirect the user back with a generic error message
            // return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');

            // You can also rethrow the exception if you want it to propagate
            // throw $e;
        }
    }

    public function ServiceDetail(Request $request)
    {
        $service_id = $request->service_id;

        $data = DB::table('services')->where('service_id', $service_id)->get();

        return response()->json(['data' => $data]);
    }

    public function UpdateService(Request $request)
    {
        $data = DB::table('services')
            ->where('service_id', $request->input('service_id'))
            ->update([
                'service_name' => $request->input('service_name'),
                'service_price' => $request->input('service_price'),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
            ]);

        // dd($data);
    }

    public function DeleteService(Request $request)
    {
        $service_id = $request->service_id;
        // dd($service_id);
        $deleted = DB::table('services')->where('service_id', $service_id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Service Deleted successfull']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }

    // categories
    public function ManageCategory(Request $request)
    {
        $company_id = Session::get('company_id');
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM categories LEFT JOIN users ON categories.added_by = users.id WHERE categories.company_id = '$company_id'");

            return Datatables::of($data)



                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="EditService(' . $data->category_id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteService(' . $data->category_id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })


                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.categories');
    }

    public function AddCategory(Request $request)
    {
        // dd($request);
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');

        DB::table('categories')->insertGetId([
            'category_name' => $request->input('category_name'),
            'added_by' => $user_id,
            'company_id' => $company_id,
        ]);
    }

    public function CategoryDetail(Request $request)
    {
        $category_id = $request->category_id;

        $data = DB::table('categories')->where('category_id', $category_id)->get();

        return response()->json(['data' => $data]);
    }

    public function UpdateCategory(Request $request)
    {
        $data = DB::table('categories')
            ->where('category_id', $request->input('category_id'))
            ->update([
                'category_name' => $request->input('category_name'),
            ]);

        // dd($data);
    }

    public function DeleteCategory(Request $request)
    {
        $category_id = $request->category_id;
        // dd($category_id);
        $deleted = DB::table('categories')->where('category_id', $category_id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Category Deleted successfull']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }

    public function ServiceDocsDetails(Request $request)
    {
        $service_id = $request->service_id;

        $data = DB::table('service_docs')->where('s_id', $service_id)->get();

        return response()->json(['data' => $data]);
    }

    public function AddServiceDocs(Request $request)
    {
        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');

        DB::table('service_docs')->insertGetId([
            'sd_name' => $request->input('sd_name'),
            's_id' => $request->input('s_id'),
            'added_by' => $user_id,
            'company_id' => $company_id,
        ]);

        return redirect()->back();
    }

    // manage packages
    public function ManagePackages(Request $request)
    {
        $company_id = Session::get('company_id');
        //         $data = DB::select("SELECT cp.*, services.service_name,services.service_price FROM combo_packages as cp LEFT JOIN services ON services.service_id = cp.service_id WHERE cp.company_id = '$company_id'");
        // dd($data);
        if ($request->ajax()) {
            // $data = DB::select("SELECT cp.*, services.service_name,services.service_price FROM combo_packages as cp LEFT JOIN services ON services.service_id = cp.service_id WHERE cp.company_id = '$company_id'");
            $data = DB::select("SELECT
                        cp.*,
                        services1.service_name AS service_name_1,
                        services1.service_price AS service_price_1,
                        services2.service_name AS service_name_2
                        FROM
                        combo_packages AS cp
                        LEFT JOIN
                        services AS services1 ON services1.service_id = cp.service_id
                        LEFT JOIN
                        services AS services2 ON services2.service_id = cp.cp_title;
                        ");
            return Datatables::of($data)



                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="EditService(' . $data->cp_id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteService(' . $data->cp_id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })


                ->rawColumns(['action'])
                ->make(true);
        }

        $services = DB::table('services')->get();
        return view('Admin.packages', compact('services'));
    }

    public function AddPackage(Request $request)
    {

        $user_id = Session::get('user_id');
        $company_id = Session::get('company_id');
        $serviceIDs = $request->input('package_services');
        $string = implode(", ", $serviceIDs);
        // dd($string);

        DB::table('combo_packages')->insertGetId([
            'cp_title' => $request->input('package_title'),
            'cp_type' => $request->input('package_type'),
            'cp_discount' => $request->input('package_discount'),
            'service_id' => $string,
            'added_by' => $user_id,
            'company_id' => $company_id,
        ]);
        return redirect()->back();
        // $i = 0;
        // foreach ($serviceIDs as $serviceid) {

        //     DB::table('combo_packages')->insertGetId([
        //         'cp_title' => $request->input('package_title'),
        //         'cp_type' => $request->input('package_type'),
        //         'cp_discount' => $request->input('package_discount'),
        //         'service_id' => $serviceid,
        //         'added_by' => $user_id,
        //         'company_id' => $company_id,
        //     ]);
        //     $i++;
        // }
    }
    public function PackageDetail(Request $request)
    {

    }
    
    //  public function UserActivity(Request $request)
    // {
    //     $curDate = date("Y-m-d");

            

    //         $data = DB::select("WITH ranked_logins AS (
    //             SELECT
    //                 user_id,
    //                 last_login_time,
    //                 ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY last_login_time) AS rn
    //             FROM
    //                 user_activity
    //                 WHERE
    //                 date = '$curDate'
    //         ),
    //         first_logins AS (
    //             SELECT
    //                 user_id,
    //                 last_login_time
    //             FROM
    //                 ranked_logins
    //             WHERE
    //                 rn = 1

                    
    //         ),
    //         total_hours AS (
    //             SELECT
    //                 user_id,
    //                 SUM(TIMESTAMPDIFF(HOUR, last_login_time, last_activity)) AS total_hours_difference
    //             FROM
    //                 user_activity
    //                 WHERE
    //                 date = '$curDate'
    //             GROUP BY
    //                 user_id
    //         ),
    //         user_average_timestamp AS (
    //             SELECT
    //                 user_id,
    //                 TIME(FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(last_login_time)))) AS average_time
    //             FROM
    //                 user_activity
    //                 WHERE
    //                 date = '$curDate'
    //             GROUP BY
    //                 user_id
    //         )
    //         SELECT
    //             fl.user_id,
    //             u.username AS user_name,
    //             u.user_type,
    //             fl.last_login_time AS first_login_time,
    //             th.total_hours_difference,
    //             uat.average_time AS user_average_time
    //         FROM
    //             first_logins fl
    //         JOIN
    //             total_hours th ON fl.user_id = th.user_id
    //         JOIN
    //             user_average_timestamp uat ON fl.user_id = uat.user_id
    //         JOIN
    //             users u ON fl.user_id = u.id;");
        
    //     return view('Admin.user_activity', compact('data'));
    // }
    
    
    
    public function UserActivity(Request $request)
    {
        $curDate = date("Y-m-d");
        // $curDate = "2024-09-03";
$currentTime = date("Y-m-d H:i:s");
// $currentTime = "2024-09-03 10:00:00";

$data = DB::select("
    WITH ranked_logins AS (
        SELECT
            user_id,
            last_login_time,
            ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY last_login_time) AS rn
        FROM
            user_activity
        WHERE
            date = '$curDate'
    ),
    first_logins AS (
        SELECT
            user_id,
            last_login_time
        FROM
            ranked_logins
        WHERE
            rn = 1
    ),
    total_hours AS (
        SELECT
            user_id,
            SUM(TIMESTAMPDIFF(HOUR, last_login_time, last_activity)) AS total_hours_difference
        FROM
            user_activity
        WHERE
            date = '$curDate'
        GROUP BY
            user_id
    ),
    user_average_timestamp AS (
        SELECT
            user_id,
            TIME(FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(last_login_time)))) AS average_time
        FROM
            user_activity
        WHERE
            date = '$curDate'
        GROUP BY
            user_id
    ),
    last_activity AS (
        SELECT
            user_id,
            MAX(last_activity) AS last_activity_time
        FROM
            user_activity
        WHERE
            date = '$curDate'
        GROUP BY
            user_id
    ),
    online_status AS (
        SELECT
            la.user_id,
            la.last_activity_time,
            IF(TIMESTAMPDIFF(MINUTE, la.last_activity_time, '$currentTime') <= 5, 'online', 'offline') AS is_online
        FROM
            last_activity la
    )
    SELECT
        fl.user_id,
        u.username AS user_name,
        u.user_type,
        fl.last_login_time AS first_login_time,
        th.total_hours_difference,
        uat.average_time AS user_average_time,
        os.last_activity_time,
        os.is_online
    FROM
        first_logins fl
    JOIN
        total_hours th ON fl.user_id = th.user_id
    JOIN
        user_average_timestamp uat ON fl.user_id = uat.user_id
    JOIN
        users u ON fl.user_id = u.id
    JOIN
        online_status os ON fl.user_id = os.user_id;
");


        // dd($data);
        
        return view('Admin.user_activity', compact('data'));
    }

    public function UserActivityOverall(Request $request)
    {
        if ($request->ajax()) {

            

            $data = DB::select("WITH ranked_logins AS (
                SELECT
                    user_id,
                    last_login_time,
                    ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY last_login_time) AS rn
                FROM
                    user_activity
            ),
            first_logins AS (
                SELECT
                    user_id,
                    last_login_time
                FROM
                    ranked_logins
                WHERE
                    rn = 1

                    
            ),
            total_hours AS (
                SELECT
                    user_id,
                    SUM(TIMESTAMPDIFF(HOUR, last_login_time, last_activity)) AS total_hours_difference
                FROM
                    user_activity
                GROUP BY
                    user_id
            ),
            user_average_timestamp AS (
                SELECT
                    user_id,
                    TIME(FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(last_login_time)))) AS average_time
                FROM
                    user_activity
                GROUP BY
                    user_id
            )
            SELECT
                fl.user_id,
                u.username AS user_name,
                u.user_type,
                fl.last_login_time AS first_login_time,
                th.total_hours_difference,
                uat.average_time AS user_average_time
            FROM
                first_logins fl
            JOIN
                total_hours th ON fl.user_id = th.user_id
            JOIN
                user_average_timestamp uat ON fl.user_id = uat.user_id
            JOIN
                users u ON fl.user_id = u.id;");




            return Datatables::of($data)


                ->addColumn('percentages', function ($data) {

                    switch ($data->user_type) {



                        case 3:
                            return ($data->total_hours_difference / 4) * 100;
                            break;
                        case 4:
                            return ($data->total_hours_difference / 6) * 100;
                            break;
                        case 5:
                            return ($data->total_hours_difference / 4) * 100;
                            break;
                        case 6:
                            return ($data->total_hours_difference / 7) * 100;
                            break;
                        case 7:
                            return ($data->total_hours_difference / 6) * 100;
                            break;
                        case 8:
                            return ($data->total_hours_difference / 7) * 100;
                            break;
                        case 9:
                            return ($data->total_hours_difference / 6) * 100;
                            break;
                        case 10:
                            return ($data->total_hours_difference / 4) * 100;
                            break;

                        default:
                            return ($data->total_hours_difference / 8) * 100;
                            break;
                    }
                })

                ->addColumn('remark', function ($data) {



                    switch ($data->user_type) {

                        case 3:
                            $remark = ($data->total_hours_difference / 4) * 100;
                            break;
                        case 4:
                            $remark = ($data->total_hours_difference / 6) * 100;
                            break;
                        case 5:
                            $remark = ($data->total_hours_difference / 4) * 100;
                            break;
                        case 6:
                            $remark = ($data->total_hours_difference / 7) * 100;
                            break;
                        case 7:
                            $remark = ($data->total_hours_difference / 6) * 100;
                            break;
                        case 8:
                            $remark = ($data->total_hours_difference / 7) * 100;
                            break;
                        case 9:
                            $remark = ($data->total_hours_difference / 6) * 100;
                            break;
                        case 10:
                            $remark = ($data->total_hours_difference / 4) * 100;
                            break;

                        default:
                            $remark = ($data->total_hours_difference / 8) * 100;
                            break;
                    }

                    if ($remark >= 90) {
                        return 'Excellent';
                    } elseif ($remark >= 75 && $remark <= 90) {
                        return 'Good';
                    } elseif ($remark >= 50 && $remark <= 75) {
                        return 'Weak';
                    }elseif ($remark >= 35 && $remark <= 50) {
                        return 'Bad';
                    }elseif ($remark <= 35) {
                        return 'Very Bad';
                    }
                    
                })


                ->rawColumns(['percentages', 'remark'])

                ->make(true);
        }
        return view('Admin.user_activity');
    }
    
    
    public function GetOverallActivity(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $data = DB::select("WITH ranked_logins AS (
            SELECT
                user_id,
                last_login_time,
                ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY last_login_time) AS rn
            FROM
                user_activity
            WHERE
                date BETWEEN '$from_date' AND '$to_date'
        ),
        first_logins AS (
            SELECT
                user_id,
                last_login_time
            FROM
                ranked_logins
            WHERE
                rn = 1
        ),
        total_hours AS (
            SELECT
                user_id,
                SUM(TIMESTAMPDIFF(HOUR, last_login_time, last_activity)) AS total_hours_difference
            FROM
                user_activity
            WHERE
                date BETWEEN '$from_date' AND '$to_date'
            GROUP BY
                user_id
        ),
        user_average_timestamp AS (
            SELECT
                user_id,
                TIME(FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(last_login_time)))) AS average_time
            FROM
                user_activity
            WHERE
                date BETWEEN '$from_date' AND '$to_date'
            GROUP BY
                user_id
        )
        SELECT
            fl.user_id,
            u.username AS user_name,
            u.user_type,
            fl.last_login_time AS first_login_time,
            th.total_hours_difference,
            uat.average_time AS user_average_time
        FROM
            first_logins fl
        JOIN
            total_hours th ON fl.user_id = th.user_id
        JOIN
            user_average_timestamp uat ON fl.user_id = uat.user_id
        JOIN
            users u ON fl.user_id = u.id
    ");

        return Datatables::of($data)
            ->addColumn('percentages', function ($data) {
                switch ($data->user_type) {
                    case 3:
                    case 5:
                    case 10:
                        return ($data->total_hours_difference / 4) * 100;
                    case 4:
                    case 7:
                    case 9:
                        return ($data->total_hours_difference / 6) * 100;
                    case 6:
                    case 8:
                        return ($data->total_hours_difference / 7) * 100;
                    default:
                        return ($data->total_hours_difference / 8) * 100;
                }
            })
            ->addColumn('remark', function ($data) {
                switch ($data->user_type) {
                    case 3:
                    case 5:
                    case 10:
                        $remark = ($data->total_hours_difference / 4) * 100;
                        break;
                    case 4:
                    case 7:
                    case 9:
                        $remark = ($data->total_hours_difference / 6) * 100;
                        break;
                    case 6:
                    case 8:
                        $remark = ($data->total_hours_difference / 7) * 100;
                        break;
                    default:
                        $remark = ($data->total_hours_difference / 8) * 100;
                        break;
                }

                if ($remark >= 90) {
                    return 'Excellent';
                } elseif ($remark >= 75 && $remark < 90) {
                    return 'Good';
                } elseif ($remark >= 50 && $remark < 75) {
                    return 'Weak';
                } elseif ($remark >= 35 && $remark < 50) {
                    return 'Bad';
                } else {
                    return 'Very Bad';
                }
            })
            ->rawColumns(['percentages', 'remark'])
            ->make(true);
    }
    
    
    // public function GetAllAppointment(Request $request)
    // {
    //     if ($request->ajax()) {
    //         // $data = DB::select("SELECT cp.*, services.service_name,services.service_price FROM combo_packages as cp LEFT JOIN services ON services.service_id = cp.service_id WHERE cp.company_id = '$company_id'");
    //         $data = DB::table('appointments')->orderBy('date', 'desc') ->get();
    //         return Datatables::of($data)



    //             ->addColumn('status', function ($data) {
    //                 $status = ($data->payment_status) ? 'Paid' : 'Un-Paid';
    //                 return $status;
    //             })


    //             ->rawColumns(['status'])
    //             ->make(true);
    //     }
    //     $appointments = DB::table('appointments')->get();
    //     return view('Admin.all_appointments', compact('appointments'));
    // }
    
    
    
   public function AddAppointment(Request $request)
    {

        
        $orderId = 'order_' . uniqid();
        $paymentId = 'payment_' . uniqid();
        $amount = 99;

        $time = $request->time;
        $f_time = date("h:i A", strtotime($time));

        $user_name = Session::get('user_name');
        // dd($f_time);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'ap_date' => $request->date,
            'ap_time' => $f_time,
            'message' => $request->message,
            'conduct_by' => $request->conduct_by,
            'added_by' => $user_name,
            'order_id' => $orderId,
            'payment_id' => $paymentId,
            'amount' => $amount,
            'payment_status' => 1,
        ];
        // dd($data);

        DB::table('appointments')->insertGetId($data);

        return redirect()->back();
    }

    public function UpdateAppointment(Request $request)
    {
        

        $time = $request->time;
        $f_time = date("h:i A", strtotime($time));
        $appo_id = $request->appo_id;
        // dd($f_time);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'city' => $request->city,
            'ap_date' => $request->date,
            'ap_time' => $f_time,
            'message' => $request->message,
            'conduct_by' => $request->conduct_by,
        ];
        // dd($data);

        DB::table('appointments')->where('id',$appo_id)->update($data);

        return redirect()->back();
    }


    public function DeleteAppointment(Request $request)
    {
        $appo_id = $request->appo_id;

        $data = [
            'is_delete' => 1
        ];
        $deleted =  DB::table('appointments')->where('id',$appo_id)->update($data);


        
        if ($deleted) {
            return response()->json(['success' => 'Appointment Deleted successfull']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }

    public function GetAllAppointment(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::select("SELECT cp.*, services.service_name,services.service_price FROM combo_packages as cp LEFT JOIN services ON services.service_id = cp.service_id WHERE cp.company_id = '$company_id'");
            $data = DB::table('appointments')->where('is_delete', 0)->orderBy('date', 'desc')->get();
            return Datatables::of($data)

                ->addColumn('status', function ($data) {
                    $unpaid = "<span class='badge bg-danger me-1 text-white'>Un-Paid</span>";
                    $paid = "<span class='badge bg-success me-1 text-white'>Paid</span>";
                    $status = ($data->payment_status) ? $paid : $unpaid;
                    return $status;
                })
                
                ->addColumn('office', function ($data) {

                    if ($data->added_by == 'Online Form') {
                        $office = $data->amount;
                        return $office;
                    } else {
                        $office = 'Office Visit';
                        return $office;
                    }
                    
                })


                ->addColumn('action', function ($data) {
                    return '<span>
                    <svg onclick="EditAppo(' . $data->id . ')" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#editAdmin" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg>
                  <svg onclick="DeleteAppo(' . $data->id . ')" style="cursor: pointer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
                </span>';
                })

                ->rawColumns(['action','status', 'office'])
                ->make(true);
        }
        return view('Admin.all_appointments');
    }

    public function GetAppointmentDetails(Request $request)
    {
        $id = $request->id;
        $data = DB::table('appointments')->where('id', $id)->get();
        return response()->json(['data' => $data]);
    }
    
    
     function CustomerList(Request $request) 
    {
        $data = DB::table('customers')
            ->select('customers.name','customers.email','customers.contact','customers.state','customers.city','customers.password','customers.service_price','customers.added_by','customers.date','services.service_name','users.username')
            ->leftJoin('users', 'users.id', '=', 'customers.added_by')
            ->leftJoin('combo_packages as cp', 'cp.cp_id', '=', 'customers.service')
            ->leftJoin('services', 'services.service_id', '=', 'cp.cp_title')
            ->where('customers.is_active', 1)->orderBy('customers.id', 'desc')->get();
            // dd($data);
        if ($request->ajax()) {
            
            $data = DB::table('customers')
            ->select('customers.name','customers.email','customers.contact','customers.state','customers.city','customers.password','customers.service_price','customers.added_by','customers.date','services.service_name','users.username')
            ->leftJoin('users', 'users.id', '=', 'customers.added_by')
            ->leftJoin('combo_packages as cp', 'cp.cp_id', '=', 'customers.service')
            ->leftJoin('services', 'services.service_id', '=', 'cp.cp_title')
            ->where('customers.is_active', 1)->orderBy('customers.id', 'desc')->get();
            
            
            return Datatables::of($data)
            ->make(true);
        }
        return view('OM.customer_list');
    }

    function OACustomerList(Request $request) 
    {
        $data = DB::table('customers')
            ->select('customers.name','customers.email','customers.contact','customers.state','customers.city','customers.password','customers.service_price','customers.added_by','customers.date','services.service_name','users.username', 'customer_emi.emi_comment')
            ->leftJoin('users', 'users.id', '=', 'customers.added_by')
            ->leftJoin('combo_packages as cp', 'cp.cp_id', '=', 'customers.service')
            ->leftJoin('services', 'services.service_id', '=', 'cp.cp_title')
            ->leftJoin('customer_emi', 'customer_emi.customer_id', '=', 'customers.id')
            ->where('customers.is_active', 1)->orderBy('customers.id', 'desc')->get();
            // dd($data);
        if ($request->ajax()) {
            
            $data = DB::table('customers')
            ->select('customers.name','customers.email','customers.contact','customers.state','customers.city','customers.password','customers.service_price','customers.added_by','customers.date','services.service_name','users.username', 'customer_emi.emi_comment')
            ->leftJoin('users', 'users.id', '=', 'customers.added_by')
            ->leftJoin('combo_packages as cp', 'cp.cp_id', '=', 'customers.service')
            ->leftJoin('services', 'services.service_id', '=', 'cp.cp_title')
            ->leftJoin('customer_emi', 'customer_emi.customer_id', '=', 'customers.id')
            ->where('customers.is_active', 1)->orderBy('customers.id', 'desc')->get();
            
            
            return Datatables::of($data)
            ->make(true);
        }
        return view('Assistant.Operation.customer_list');
    }
    
    
}
