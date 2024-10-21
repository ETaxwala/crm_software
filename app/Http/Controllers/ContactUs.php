<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactUs extends Controller
{
    public function AddContact(Request $request)
    {
        $name = $request->contact_name;
        $email = $request->contact_email;
        $mobile = $request->contact_mobile;
        $state = $request->contact_state;
        $city = $request->contact_city;
        $service = $request->contact_service;
        $message = $request->contact_message;

        DB::table('bs_contact')->insertGetId([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'state' => $state,
            'city' => $city,
            'service' => $service,
            'message' => $message,
          ]);
          return redirect()->back();
    }

    // appointmemt booking
    public function BookAppointment(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $state = $request->state;
        $city = $request->city;

        DB::table('appointments')->insertGetId([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'state' => $state,
            'city' => $city,
          ]);
          return redirect()->back();
    }
}
