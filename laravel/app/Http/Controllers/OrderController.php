<?php

namespace App\Http\Controllers;

use App\Models\Order_items;
use App\Models\Orders;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;

class OrderController extends Controller
{   
    public function order(Request $request)
    {
        $orderId = $request->route('order'); // Get the order ID from the route parameter
    
        $order = Orders::find($orderId);
        if (!$order) {
            // Order doesn't exist, redirect back with a flash message
            return back()->with('error', 'Order not found.');
        }

        // Cast the JSON column to an array
        $order_items_ids = json_decode($order->array_of_order_items);
        // Create a custom array
        $customArray = [];
        $total_price = $order->total_price;
        $created_at = $order->created_at;
        // Now you can iterate through the $order_items_id collection
        foreach ($order_items_ids as $order_items) {
            // Retrieve order items based on the IDs
            $order_item = Order_items::where('id', $order_items)->first();
            // Access order item properties
            $product_id = $order_item->product_id;
            $product_item = Products::where('id', $product_id)->first();
            $customArray[] = [
                'product_id' => $order_item->product_id,
                'product_name' => $product_item->name,
                'product_price' => $product_item->price,
                'product_color' => $product_item->color,
                'size' => $order_item->size,
                'quantity' => $order_item->quantity,
            ];
        }
        return view('order', ['customArray' => $customArray, 'total_price' => $total_price, 'created_at' => $created_at]);
    }
    
    public function deliver(Request $request, Orders $order)
    {
        if (!$order) {
            // Order doesn't exist, redirect back with a flash message
            return redirect()->route('orders')->with('error', 'Order not found.');
        }

        if ($order->status === 'delivered') {
            // Order is already delivered, redirect back with a flash message
            return redirect()->route('orders')->with('error', 'Order has already been delivered.');
        }

        $order->update([
            'status' => 'delivered',            
        ]);
        return redirect()->route('orders')->with('message', 'Order updated successfully!');
    }
    
    public function cancel(Orders $order)
    {
        if (!$order) {
            // Order doesn't exist, redirect back with a flash message
            return redirect()->route('orders')->with('error', 'Order not found.');
        }

        if ($order->status === 'cancelled') {
            // Order is already delivered, redirect back with a flash message
            return redirect()->route('orders')->with('error', 'Order has already been cancelled.');
        }

        $order->update([
            'status' => 'cancelled',            
        ]);
        return redirect()->route('orders')->with('message', 'Order cancelled successfully!');
    }
}