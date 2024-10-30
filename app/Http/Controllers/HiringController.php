<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

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
        $resumes = DB::table('hiring')->orderBy('id', 'desc')->get();

        return view('Admin.resumes', compact('resumes'));
    }


    function addBlog(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
        ]);

        // Handle the thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Save the blog post to the database
        BlogModel::create([
            'title' => $request->input('title'),
            'thumbnail' => $thumbnailPath,
            'content' => $request->input('content'),
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Blog post created successfully.');
    }
}
