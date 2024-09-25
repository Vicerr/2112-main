<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            if (!$order) {
                $cart_count = '';
            } else {
                $cart_count = count(json_decode($order->array_of_order_items));
            }
        } else {
            $cart_count = '';
        }
        return view("index", ['cart' => $cart_count]);
    }
}
