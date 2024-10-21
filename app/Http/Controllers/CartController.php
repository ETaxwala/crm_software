<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Session;

class CartController extends Controller
{
    public function GetItemCount()
    {
        $user_id = Session::get('user_id');
        // $data = DB::table('cart')->where('cust_id', $user_id)->get();
        $data = DB::select("SELECT * FROM cart LEFT JOIN services ON cart.service_id = services.service_id WHERE cart.cust_id = '$user_id' ORDER BY cart.service_id DESC");
        return response()->json(['data' => $data]);
    }

    public function AddToCart(Request $request)
    {
        // dd($request);
        $user_id = Session::get('user_id');

        $serviceID = $request->service_id;

        $isItem = DB::table('cart')->where('cust_id', $user_id)->where('service_id', $serviceID)->get();

        if (count($isItem) > 0) {
            return response()->json(['success' => 'Item Already In Cart']);
        } else {
            DB::table('cart')->insertGetId([
                'cust_id' => $user_id,
                'cat_id' => $request->input('cat_id'),
                'service_id' => $request->input('service_id'),
                'service_price' => $request->input('service_price'),
            ]);
            return response()->json(['success' => 'Item Added successful']);
        }
    }

    public function DeleteCartItem(Request $request)
    {
        // dd($request);
        $cart_id = $request->cart_id;
        $deleted = DB::table('cart')->where('cart_id', $cart_id)->delete();

        if ($deleted) {
            return response()->json(['success' => 'Item Deleted successful']);
        } else {
            return response()->json(['danger' => 'Getting Error!!!']);
        }
    }

    public function GetTotal()
    {
        $user_id = Session::get('user_id');
        // $data = DB::table('cart')->where('cust_id', $user_id)->get();
        $data = DB::select("SELECT SUM(service_price) as TotalPrice FROM cart WHERE cust_id = '$user_id'");
        return response()->json($data);
    }
}
