<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sales;
use App\Models\Supplier;
use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeadsModel;
use Session;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index()
    {
        $quotations = Quotation::all();
        return view('quotation.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $customers = DB::table('customers')->get();
        $customers = DB::table('leads')->get();
        $products = DB::table('services')->get();
        return view('quotation.create', compact('customers','products'));
    }

    public function CreateQuotation($id)
    {
        $customers = DB::table('leads')->where('id', $id)->get();
        $products = DB::table('services')->get();
        return view('quotation.create', compact('customers','products'));
    }

    public function ViewQuotation($id)
    {
        
        $invoice2 = DB::table('quotations')->select('id')->where('lead_id', $id)->get();
        // $invoice = Quotation::findOrFail($id);
        // $invoice = Quotation::select('id')->where('lead_id', $id)->get();
        // $sales = Sale::where('quotation_id', $id)->get();
        // dd($invoice2);
        
        if (count($invoice2) > 0) {
            $qID = [];
            // foreach ($invoice2 as $id) {
            //     array_push($qID,$id);
            // }

            for ($i=0; $i < count($invoice2); $i++) { 
                array_push($qID,$invoice2[$i]->id);
            }


            // dd($qID);
            $quotations = Quotation::whereIn('id', $qID)->get();
        } else {
            $quotations = [];
        }
        
        
        return view('quotation.index', compact('quotations'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'customer_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'dis' => 'required',
            'amount' => 'required',
        ]);

        $invoice = new Quotation();
        $invoice->lead_id = $request->customer_id;
        $invoice->created_by = Session::get('user_name');
        $invoice->save();

        foreach ( $request->product_id as $key => $product_id){
            $sale = new Sale();
            $sale->qty = $request->qty[$key];
            $sale->price = $request->price[$key];
            $sale->dis = $request->dis[$key];
            $sale->amount = $request->amount[$key];
            $sale->service_id = $request->product_id[$key];
            $sale->quotation_id = $invoice->id;
            $sale->save();


         }

         return redirect('quotation/'.$invoice->id)->with('message','Invoice created Successfully');




    }

    public function findPrice(Request $request){
        $data = DB::table('services')->select('service_price')->where('service_id', $request->id)->first();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Quotation::findOrFail($id);
        // $sales = Sale::where('quotation_id', $id)->get();

        $sales = DB::table('sales')->where('quotation_id', $id)
        ->leftJoin('services', 'services.service_id', '=', 'sales.service_id')->get();

        // dd($invoice);
        return view('quotation.show', compact('invoice','sales'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = LeadsModel::all();
        $products = Service::orderBy('service_id', 'DESC')->get();
        $invoice = Quotation::findOrFail($id);
        // $sales = Sale::where('quotation_id', $id)->get();
        $sales = DB::table('sales')->where('quotation_id', $id)
        ->leftJoin('services', 'services.service_id', '=', 'sales.service_id')->get();
        return view('quotation.edit', compact('customers','products','invoice','sales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

        'customer_id' => 'required',
        'product_id' => 'required',
        'qty' => 'required',
        'price' => 'required',
        'dis' => 'required',
        'amount' => 'required',
    ]);

        $invoice = Quotation::findOrFail($id);
        $invoice->lead_id = $request->customer_id;
        // $invoice->total = 1000;
        $invoice->save();

        Sale::where('quotation_id', $id)->delete();

        foreach ( $request->product_id as $key => $product_id){
            $sale = new Sale();
            $sale->qty = $request->qty[$key];
            $sale->price = $request->price[$key];
            $sale->dis = $request->dis[$key];
            $sale->amount = $request->amount[$key];
            $sale->service_id = $request->product_id[$key];
            $sale->quotation_id = $invoice->id;
            $sale->save();


        }

         return redirect('quotation/'.$invoice->id)->with('message','invoice created Successfully');


    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Sales::where('quotation_id', $id)->delete();
        $invoice = Quotation::findOrFail($id);
        $invoice->delete();
        return redirect()->back();

    }
}
