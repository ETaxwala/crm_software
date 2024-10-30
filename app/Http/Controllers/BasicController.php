<?php

namespace App\Http\Controllers;

use App\Models\CoreServices;
use Illuminate\Http\Request;

class BasicController extends Controller
{

    function index(Request $request)
    {
        // dd(1234);
        $coreservices  = CoreServices::all();
        // dd($coreservices);
        return view('welcome', compact('coreservices'));
    }


    function partnershipFirm(Request $request)
    {
        return view('services.partnership_firm');
    }

    function onePerson(Request $request)
    {
        return view('services.one_person_company');
    }

    function privateLimited(Request $request)
    {
        return view('services.private_limited');
    }

    function LLP(Request $request)
    {
        return view('services.llp');
    }

    function section8(Request $request)
    {
        return view('services.section8company');
    }

    function producerCompany(Request $request)
    {
        return view('services.producer_company');
    }

    function nidhiCompany(Request $request)
    {
        return view('');
    }

    function publicLimited(Request $request)
    {
        return view('services.public_limited');
    }

    function microfinanceSection8(Request $request)
    {
        return view('services.microfinance_section8');
    }

    function indianSubidiary(Request $request)
    {
        return view('services.indian_subsidiary');
    }

    function microfinanceNBFC(Request $request)
    {
        return view('');
    }
 

    // business consultancy
    function shopAct(Request $request)
    {
        return view('otherRegistration.shop_act');
    }
    function MSME(Request $request)
    {
        return view('otherRegistration.msme');
    }

    function GST(Request $request)
    {
        return view('otherRegistration.gst_registration');
    }
    function FSSAI(Request $request)
    {
        return view('otherRegistration.fssai_registration');
    }
    function importExportCode(Request $request)
    {
        return view('otherRegistration.import_export_code');
    }
    function EPFOESIC(Request $request)
    {
        return view('otherRegistration.epfo_esic_registration');
    }
    function G8012A(Request $request)
    {
        return view('otherRegistration.80G_12A_registration');
    }
    function professionalTax(Request $request)
    {
        return view('otherRegistration.professional_tax_registration');
    }

    function TAN(Request $request)
    {
        return view('otherRegistration.tan_registration');
    }
    function DSC(Request $request)
    {
        return view('otherRegistration.dsc');
    }
    function PASARA(Request $request)
    {
        return view('otherRegistration.pasara_license');
    }
    function NitiAyogDarpan(Request $request)
    {
        return view('otherRegistration.niti_ayog_darpan');
    }
    function TradeLicense(Request $request)
    {
        return view('otherRegistration.trade_license');
    }
}
