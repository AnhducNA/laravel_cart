<?php

namespace App\Http\Controllers;

use App\Cart;
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
            $oldCart = session('Cart') ? session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product, $id);
            $req->session()->put('Cart', $newCart);
            // dd(session('Cart'));
        }
        return view('cart', compact('newCart'));
    }
    function deleteItemCart(Request $req,  $id)
    {
        $oldCart = session('Cart') ? session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);
        if (count($newCart->products) > 0) {
            $req->session()->put('Cart', $newCart);
        } else if (count($newCart->products) == 0) {
            $req->session()->remove('Cart');
            $newCart->totalPrice == 0;
            $newCart->totalQuanty == 0;
        }
        // echo count($newCart->products);
        return view('cart', compact('newCart'));
    }
    function viewListCart()
    {
        return view('list');
    }

    function deleteItemListCart(Request $req, $id)
    {
        $oldCart = session('Cart') ? session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);
        if (count($newCart->products) > 0) {
            $req->session()->put('Cart', $newCart);
        } else if (count($newCart->products) == 0) {
            $req->session()->remove('Cart');
            $newCart->totalPrice == 0;
            $newCart->totalQuanty == 0;
        }
        // echo count($newCart->products);
        return view('list-cart');
    }
}
