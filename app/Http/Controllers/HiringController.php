<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HiringController extends Controller
{
    public function AddHiring(Request $request)
    {
        // dd($request);
        $name = $request->input('name');
        $cust_doc = $request->file('resume');





        if ($cust_doc == null) {
            $AddLead = DB::table('hiring')->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'education' => $request->input('education'),
                'experience' => $request->input('experience'),
                'salary' => $request->input('salary'),

                'position' => $request->input('position'),
                'onssite' => $request->input('onssite'),
                'address' => $request->input('address'),
            ]);
        } else {
            $hotelLogo = null;
            $HLogo = $cust_doc;
            $hotelLogo = $name . "." . $HLogo->getClientOriginalExtension();
            $destinationPath = public_path('/Resume');
            $HLogo->move($destinationPath, $hotelLogo);
            
            $AddLead = DB::table('hiring')->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'contact' => $request->input('contact'),
                'education' => $request->input('education'),
                'experience' => $request->input('experience'),
                'salary' => $request->input('salary'),

                'position' => $request->input('position'),
                'onssite' => $request->input('onssite'),
                'address' => $request->input('address'),
                'resume' => $hotelLogo,
            ]);
        }

        $msg = "Thank You for Your Enquiry. <br> One of our Experts will call your shortly.";
        return response()->json([
            'message' => $msg,
        ]);
    }
    
    
    public function ManageResume()
    {
        $resumes = DB::table('hiring')->orderBy('id','desc')->get();

        return view('Admin.resumes', compact('resumes'));
    }
}
