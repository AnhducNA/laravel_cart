<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    function index()
    {
        $list_products = DB::table('products')->get();
        // dd($list_products);
        return view('index', compact('list_products'));
    }
    function add($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (isset($product)) {
            dd($product);
        } else {
            return 0;
        }
    }
}
