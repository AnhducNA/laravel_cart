<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Contracts\Session\Session;
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
    function addCart(Request $req,  $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (isset($product)) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product, $id);
            $req->session()->put('Cart', $newCart);
            dd($newCart);
        }
    }
}
