<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;
use Yajra\DataTables\Facades\DataTables;

class CustomerWorkTimeline extends Controller
{

    public function index(Request $request)
    {
        $cust_id = $request->cust_id;
        $data = DB::select("SELECT * FROM  customer_work_timeline WHERE cust_id = '$cust_id' ORDER BY id DESC");
        return response()->json(['data' => $data]);
    }

    public function create()
    {
        // Display a form to create work progress
    }

    public function store(Request $request)
    {
        // Store new work progress in the database
    }

    public function edit($id)
    {
        // Display a form to edit work progress
    }

    public function update(Request $request, $id)
    {
        // Update work progress in the database
    }

    public function destroy($id)
    {
        // Delete work progress from the database
    }
}
