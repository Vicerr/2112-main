<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::Where('user_id', $user_id)->first();
            $cart_count = count(json_decode($order->array_of_order_items));
            return view("index", ['cart' => $cart_count]);
        } else {
            $cart_count = '';
            return view("index", ['cart' => $cart_count]);
        }
        
    }
}
