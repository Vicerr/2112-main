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
            $pending_order = Orders::where('user_id', $user_id)->where('status', 'pending')->count();
            if (!$order && !$pending_order) {
                $cart_count = '';
            } elseif ($order && !$pending_order) {
                $cart_count = [count(json_decode($order->array_of_order_items)), ''];
            } elseif (!$order && $pending_order) {
                $cart_count = ['', $pending_order];
            } else {
                $cart_count = [count(json_decode($order->array_of_order_items)), $pending_order];
            }
        } else {
            $cart_count = '';
        }
        return view("index", ['cart' => $cart_count]);
    }

    public function contact() {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            $pending_order = Orders::where('user_id', $user_id)->where('status', 'pending')->count();
            if (!$order && !$pending_order) {
                $cart_count = '';
            } elseif ($order && !$pending_order) {
                $cart_count = [count(json_decode($order->array_of_order_items)), ''];
            } elseif (!$order && $pending_order) {
                $cart_count = ['', $pending_order];
            } else {
                $cart_count = [count(json_decode($order->array_of_order_items)), $pending_order];
            }
        } else {
            $cart_count = '';
        }
        return view("contact", ['cart' => $cart_count]);
    }
}
