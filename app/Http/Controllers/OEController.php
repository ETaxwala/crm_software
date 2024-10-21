<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;



class OEController extends Controller
{
    public function Dashboard(Request $request)
    {
        return view('OED.dashboard');
    }

    public function ManageTask(Request $request)
    {
        $user_id = Session::get('user_id');
        $data = DB::select("SELECT * FROM task_assign LEFT JOIN operation_tasks ON task_assign.task_id = operation_tasks.task_id
        LEFT JOIN customers ON customers.id = operation_tasks.cust_id
        LEFT JOIN services ON services.service_id = operation_tasks.service_id
        WHERE task_assign.assign_to = '$user_id' AND task_assign.task_status = 0
        ORDER BY task_assign.ta_id DESC");

        // $data = DB::select("SELECT * FROM task_assign LEFT JOIN operation_tasks ON task_assign.task_id = operation_tasks.task_id LEFT JOIN customers ON customers.id = operation_tasks.cust_id LEFT JOIN services ON services.service_id = operation_tasks.service_id WHERE task_assign.assign_to = '$user_id' AND task_assign.task_status = 0 ORDER BY task_assign.ta_id DESC");
        // dd($data);
        if ($request->ajax()) {
            $data = DB::select("SELECT * FROM task_assign LEFT JOIN operation_tasks ON task_assign.task_id = operation_tasks.task_id LEFT JOIN customers ON customers.id = operation_tasks.cust_id LEFT JOIN services ON services.service_id = operation_tasks.service_id WHERE task_assign.assign_to = '$user_id' AND task_assign.task_status = 0 ORDER BY task_assign.ta_id DESC");

            return Datatables::of($data)

                ->addColumn('mark2', function ($data) {

                    return '<span style="cursor:pointer" onclick="WorkTimeline(' . $data->task_id . ')">' . $data->task_name . '</span>';
                })
                ->addColumn('mark', function ($data) {

                    return '<span style="cursor:pointer" onclick="ClientInfo('  . $data->id . ',' . $data->task_id . ',' . $data->service_id .  ')">' . $data->name . '</span>';
                })


                ->rawColumns(['mark', 'mark2'])
                ->make(true);
        }

        return view('OED.manage_task');
    }

    public function ManageDocs(Request $request)
    {
        return view('OED.manage_docs');
    }

    public function MessageToClient(Request $request)
    {
        $customers = DB::select("SELECT * FROM customers");
        $chats = DB::select("SELECT * FROM customer_chatting WHERE chat_id =39");
        return view('OED.messages', compact('customers', 'chats'));
    }

    public function GetClientChatting(Request $request)
    {
        $user_id = Session::get('user_id');
        $cust_id = $request->cust_id;
        $service_id = $request->service_id;

        $data = DB::table('customer_chatting')
            ->where(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('chat_from', $user_id)
                    ->where('chat_to', $cust_id)
                    ->where('service_id', $service_id);
            })
            ->orWhere(function ($query) use ($user_id, $cust_id, $service_id) {
                $query->where('chat_from', $cust_id)
                    ->where('chat_to', 0)
                    ->where('service_id', $service_id);
            })
            ->get();

            // dd($data);


        return response()->json(['data' => $data]);
    }

    public function CCFTOP(Request $request)
    {
        // dd($request);
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

    public function CCFTOP2(Request $request)
    {
        // dd($request);
        $user_id = Session::get('user_id');
        $cust_id = $request->cust_id2;
        $chat_file = $request->file('chat_file');
        // $fileContent = file_get_contents($request->file('chat_file')->path());
        $fileData = file_get_contents($chat_file->path());
        // $fileContent = mb_convert_encoding($fileData, 'UTF-8', 'auto');

        // dd($fileContent);

        $AddChat = DB::table('customer_chatting')->insertGetId([
            'chat_from' => $user_id,
            'chat_to' => $cust_id,
            'chat_file_name' => $chat_file->getClientOriginalName(),
            'chat_file' => $fileData,
        ]);

        if ($AddChat != 0) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function fileDownload($chat_id)
    {
        $file = DB::selectOne("SELECT * FROM customer_chatting WHERE chat_id = '$chat_id'");
        if ($file) {
            return response()->streamDownload(function () use ($file) {
                echo $file->chat_file;
            }, $file->chat_file_name);
        }
    }


    public function sendWhatsAppMessage()
    {
        $phoneNumber = '919022050461'; // Replace with the recipient's phone number
        $message = urlencode('Hello, this is a message from Developer!!');

        $whatsappLink = "https://wa.me/{$phoneNumber}?text={$message}";

        return redirect($whatsappLink);
    }

    public function GetClientInfo(Request $request)
    {
        $cust_id = $request->cust_id;
        $service_id = $request->service_id;

        $data = DB::select("SELECT * FROM customers as c JOIN services as s WHERE s.service_id = '$service_id' AND c.id = '$cust_id'");
        return $data;
    }

    public function UpdateClientInfo(Request $request)
    {
        // dd($request);
        $cust_id = $request->client_id;

        DB::table('customers')
            ->where('id', $cust_id)
            ->update([
                'name' => $request->input('client_name'),
                'email' => $request->input('client_email'),
                'contact' => $request->input('client_contact'),
                'service' => $request->input('client_service'),
                'state' => $request->input('client_state'),
                'city' => $request->input('client_city'),
            ]);
        // return ["success" => true];

    }

    public function GetDocuments(Request $request)
    {
        $cust_id = $request->customer_id;
        $service_id = $request->service_id;
        $user_id = Session::get('user_id');
        // OR cd_to=0 added extra
        // $data = DB::select("SELECT * FROM customer_documents WHERE (cd_from='$user_id' OR cd_to='$cust_id' OR cd_to=0) AND service_id = '$service_id'");
        // $data = DB::select("SELECT * FROM customer_documents WHERE (cd_from='$user_id' OR cd_to='$user_id' OR cd_to=0) AND  (cd_from='$cust_id' OR cd_to='$cust_id' OR cd_to=0)");
        
        $data = DB::select("SELECT * FROM customer_documents WHERE (cd_from='$user_id' AND cd_to='$cust_id') OR (cd_from='$cust_id' AND cd_to=0) AND service_id = '$service_id'");
        return $data;
    }

    public function UploadEmployeeDocs(Request $request)
    {

        $user_id = Session::get('user_id');
        $cust_doc = $request->file('customer_docs');
        $cust_id = $request->doc_cust_id;
        $docs_name = $request->docs_name;
        $service_id = $request->cd_service_id;

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




    public function GetTotalTaskCount(Request $request)
    {
        $user_id = Session::get('user_id');

        $data = [
            'totalTasks' => DB::table('task_assign')->where('assign_to', $user_id)->count(),
            'notstarted' => DB::table('task_assign')->where('actual_task_status', 1)->where('assign_to', $user_id)->count(),
            'wip' => DB::table('task_assign')->where('actual_task_status', 2)->where('assign_to', $user_id)->count(),
            'pendingfromclient' => DB::table('task_assign')->where('actual_task_status', 3)->where('assign_to', $user_id)->count(),
            'invoiced' => DB::table('task_assign')->where('actual_task_status', 4)->where('assign_to', $user_id)->count(),
            'completed' => DB::table('task_assign')->where('actual_task_status', 5)->where('assign_to', $user_id)->count(),
            'returnback' => DB::table('task_assign')->where('actual_task_status', 6)->where('assign_to', $user_id)->count(),
            'cancel' => DB::table('task_assign')->where('actual_task_status', 7)->where('assign_to', $user_id)->count(),
            'paymentpending' => DB::table('task_assign')->where('actual_task_status', 8)->where('assign_to', $user_id)->count(),
        ];

        return response()->json(['data' => $data]);
    }

    public function AddWorkEffort(Request $request)
    {
        // dd($request);
        date_default_timezone_set('Asia/Kolkata');
        $currentDateTime = date('Y-m-d H:i:s');
        list($date, $time) = explode(' ', $currentDateTime);
        $cust_id = $request->cust_id;
        $work = $request->work;
        $status = $request->status;
        $task_id = $request->task_id;
        $service_id = $request->work_service_id;
        $work_hour = $request->work_hour;
        $work_minute = $request->work_minute;

        $user_id = Session::get('user_id');

        if ($status == 6) {


            DB::table('operation_tasks')->where('task_id', $task_id)
                ->update(['is_assign' => 0, 'is_return' => 1, 'original_task_status' => $status]);

            DB::table('task_assign')->where('task_id', $task_id)
                ->update(['task_status' => 1, 'actual_task_status' => $status]);

            DB::table('customer_work_timeline')->insertGetId([
                'cust_id' => $cust_id,
                'task_id' => $task_id,
                'work' => $work,
                'status' => $status,
                'added_by' => $user_id,
                'service_id' => $service_id,
                'work_hour' => $work_hour,
                'work_minute' => $work_minute,
                'date' => $date,
                'time' => $time,
            ]);
        } else {

            DB::table('operation_tasks')->where('task_id', $task_id)
                ->update(['original_task_status' => $status]);

            DB::table('task_assign')->where('task_id', $task_id)
                ->update(['actual_task_status' => $status]);

            DB::table('customer_work_timeline')->insertGetId([
                'cust_id' => $cust_id,
                'task_id' => $task_id,
                'work' => $work,
                'status' => $status,
                'added_by' => $user_id,
                'service_id' => $service_id,
                'work_hour' => $work_hour,
                'work_minute' => $work_minute,
                'date' => $date,
                'time' => $time,
            ]);
        }
    }

    function GetTaskCounts()
    {
        $user_id = Session::get('user_id');
        $data = [
            'totalTasks' => DB::table('task_assign')->where('assign_to', '=', $user_id)
                ->count(),

            'notstarted' => DB::table('task_assign')->where('assign_to', '=', $user_id)->where('actual_task_status', 1)->count(),

            'wip' => DB::table('task_assign')->where('assign_to', '=', $user_id)->where('actual_task_status', 2)->count(),

            'pendingfromclient' => DB::table('task_assign')->where('assign_to', '=', $user_id)->where('actual_task_status', 3)->count(),

            'invoiced' => DB::table('task_assign')->where('assign_to', '=', $user_id)->where('actual_task_status', 4)->count(),

            'paymentpending' => DB::table('task_assign')->where('assign_to', '=', $user_id)->where('actual_task_status', 8)->count(),

            'completed' => DB::table('task_assign')->where('assign_to', '=', $user_id)->where('actual_task_status', 5)->count(),
        ];
        return response()->json(['data' => $data]);
    }


function TaskFilter(Request $request)
    {
        $task_status = $request->task_status;
        $user_id = Session::get('user_id');

        if ($task_status == 0) {
            $data2 = DB::select("SELECT * FROM task_assign LEFT JOIN operation_tasks ON task_assign.task_id = operation_tasks.task_id 
        LEFT JOIN customers ON customers.id = operation_tasks.cust_id 
        LEFT JOIN services ON services.service_id = operation_tasks.service_id 
        WHERE task_assign.assign_to = '$user_id' 
        AND task_assign.task_status = 0 
        ORDER BY task_assign.ta_id DESC");
        } else {
            $data2 = DB::select("SELECT * FROM task_assign LEFT JOIN operation_tasks ON task_assign.task_id = operation_tasks.task_id 
        LEFT JOIN customers ON customers.id = operation_tasks.cust_id 
        LEFT JOIN services ON services.service_id = operation_tasks.service_id 
        WHERE task_assign.assign_to = '$user_id' 
        AND task_assign.task_status = 0 
        AND task_assign.actual_task_status = '$task_status' 
        ORDER BY task_assign.ta_id DESC");
        }


        $data = $data2;

        return Datatables::of($data)

            ->addColumn('mark2', function ($data) {

                return '<span style="cursor:pointer" onclick="WorkTimeline(' . $data->task_id . ')">' . $data->task_name . '</span>';
            })
            ->addColumn('mark', function ($data) {

                return '<span style="cursor:pointer" onclick="ClientInfo('  . $data->id . ',' . $data->task_id . ',' . $data->service_id .  ')">' . $data->name . '</span>';
            })


            ->rawColumns(['mark', 'mark2'])
            ->make(true);
    }

}
