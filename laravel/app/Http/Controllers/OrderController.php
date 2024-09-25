<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Order_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class OrderController extends Controller
{   
    public function order(Request $request)
    {
        $encryptedOrderId = $request->route('order'); // Get the order ID from the route parameter
        try {
            $orderId = Crypt::decryptString($encryptedOrderId);
        } catch (DecryptException $e) {
            return abort(404, 'Invalid order ID');
        }

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
        // Iterate through the $order_items_id collection
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
    
    public function deliver(Request $request)
    {
        $encryptedOrderId = $request->route('order'); // Get the order ID from the route parameter
        try {
            $orderId = Crypt::decryptString($encryptedOrderId);
        } catch (DecryptException $e) {
            return abort(404, 'Invalid order ID');
        }
        $order = Orders::find($orderId);

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
    
    public function cancel(Request $request)
    {
        $encryptedOrderId = $request->route('order'); // Get the order ID from the route parameter
        try {
            $orderId = Crypt::decryptString($encryptedOrderId);
        } catch (DecryptException $e) {
            return abort(404, 'Invalid order ID');
        }

        $order = Orders::find($orderId);
        
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

    
    public function show_cart() {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'pending')->first();
            if (!$order) {
                $cart_count = '';
                return back()->with('message', "You don't have any item in your cart");
            } else {
                $cart_count = count(json_decode($order->array_of_order_items));
                $total_price = 0;
                $customArray = [];
                foreach (json_decode($order->array_of_order_items) as $order_items) {
                    // Retrieve order items based on the IDs
                    $order_item = Order_items::where('id', $order_items)->first();
                    // Access order item properties
                    $product_id = $order_item->product_id;
                    $product_item = Products::where('id', $product_id)->with('images')->first();
                    $total_price += $product_item->price * $order_item->quantity;
                    $customArray[] = [
                        'order_item_id' => $order_items,
                        'product_id' => $order_item->product_id,
                        'product_name' => $product_item->name,
                        'product_price' => $product_item->price,
                        'product_color' => $product_item->color,
                        'size' => $order_item->size,
                        'quantity' => $order_item->quantity,
                        'image' => $product_item->images->first()->path,
                    ];
                }
                return view('cart', ['cart' => $cart_count, 'cart', 'items' => $customArray, 'total_price' => $total_price,]);
            }
        } else {
            $cart_count = '';
            return back()->with('error', 'Sign in to access your cart');
        }

        // $product_id = $request->route('productId'); 
        // $product = Products::where('id', $product_id)->with('images')->first();

    }

    public function update_cart(Request $request)
    {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'pending')->where('status', 'pending')->first();
            if (!$order) {
                return back()->with('message', "You don't have any item in your cart");
            } else {
                $encryptedOrderId = $request->route('cart'); // Get the order ID from the route parameter
                try {
                    $order_items_id = Crypt::decryptString($encryptedOrderId);
                } catch (DecryptException $e) {
                    return abort(404, 'Invalid order ID');
                }
                $order = Order_items::find($order_items_id);

                if (!$order) {
                    // Order doesn't exist, redirect back with a flash message
                    return back()->with('error', 'Order not found.');
                }

                $formFields = $request->validate([
                    'quantity' => 'required|numeric|max:255',
                    'size' => 'required|string|max:10',
                ]);

                // Update the product
                $order->update($formFields);
                $array_of_order_items = json_decode($order->array_of_order_items);
                $total_price = 0;
                foreach ($array_of_order_items as $order_items) {
                    // Retrieve order items based on the IDs
                    $order_item = Order_items::where('id', $order_items)->first();
                    // Access order item properties
                    $product_id = $order_item->product_id;
                    $product_item = Products::where('id', $product_id)->with('images')->first();
                    $total_price += $product_item->price * $order_item->quantity;
                }

                $order->update([
                    'total_price' => $total_price
                ]);
                
                return back()->with('message', 'Cart updated successfully!');
            }
        } else {
            return back()->with('error', 'Sign in to access your cart');
        }
    }

    public function clear_cart(Request $request) {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'pending')->where('status', 'pending')->first();
            if (!$order) {
                return back()->with('message', "You don't have any item in your cart");
            } else {
                foreach (json_decode($order->array_of_order_items) as $order_items_id) {
                    $order_item = Order_items::find($order_items_id);
                    if (!$order_item) {
                        // Order item doesn't exist, redirect back with a flash message
                        return back()->with('error', 'Order not found.');
                    }
                    $order_item->delete();
                }
                $order->delete();
                return redirect()->route('products')->with('message', 'Cart cleared successfully');
            }
        } else {
            return back()->with('error', 'Sign in to access your cart');
        }
    }
    
    public function delete_cart(Request $request) {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'pending')->where('status', 'pending')->first();
            if (!$order) {
                return back()->with('message', "You don't have any item in your cart");
            } else {
                $encryptedOrderId = $request->route('cart'); // Get the order ID from the route parameter
                try {
                    $order_items_id = Crypt::decryptString($encryptedOrderId);
                } catch (DecryptException $e) {
                    return abort(404, 'Invalid order ID');
                }
                $order_item = Order_items::find($order_items_id);

                if (!$order_item) {
                    // Order item doesn't exist, redirect back with a flash message
                    return back()->with('error', 'Order not found.');
                }

                if (in_array($order_item->id, json_decode($order->array_of_order_items))) {
                    $new_array_of_order_items = json_decode($order->array_of_order_items);
                    unset($new_array_of_order_items[array_search($order_item->id, $new_array_of_order_items)]);
                    $order->update([
                        'array_of_order_items' => json_encode(array_values($new_array_of_order_items))
                    ]);
                    
                    $total_price = 0;
                    foreach ($new_array_of_order_items as $order_items) {
                        // Retrieve order items based on the IDs
                        $order_item = Order_items::where('id', $order_items)->first();
                        // Access order item properties
                        $product_id = $order_item->product_id;
                        $product_item = Products::where('id', $product_id)->with('images')->first();
                        $total_price += $product_item->price * $order_item->quantity;
                    }

                    $order->update([
                        'total_price' => $total_price
                    ]);
                    return redirect()->route('cart')->with('message', 'Item deleted successfully');
                    
                } else {
                    return back()->with('error', 'The order you are trying to access is not in your cart.');
                }
            }
        } else {
            return back()->with('error', 'Sign in to access your cart');
        }
    }

    public function add(Request $request) {
        $formFields = $request->validate([
            'product_id' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'size' => 'required|string|max:4',
        ]);

        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'pending')->first();
            if (!$order) {
                $product = Products::where('id', $formFields['product_id'])->first();
                $order_items_id = Order_items::create([
                    'product_id' => $formFields['product_id'],
                    'quantity' => $formFields['quantity'],
                    'size' => $formFields['size']                   
                ])->id;
                
                $total_price = $product->price * $formFields['quantity'];
                Orders::create([
                    'status' => 'pending',
                    'total_price' => $total_price,
                    'array_of_order_items' => json_encode(array($order_items_id))
                ]);
                // $cart_count = '';
                // return back()->with('message', "You don't have any item in your cart");
            } else {
            //     $cart_count = count(json_decode($order->array_of_order_items));
            //     $total_price = 0;
            //     $customArray = [];
            //     foreach (json_decode($order->array_of_order_items) as $order_items) {
            //         // Retrieve order items based on the IDs
            //         $order_item = Order_items::where('id', $order_items)->first();
            //         // Access order item properties
            //         $product_id = $order_item->product_id;
            //         $product_item = Products::where('id', $product_id)->with('images')->first();
            //         $total_price += $product_item->price * $order_item->quantity;
            //         $customArray[] = [
            //             'order_item_id' => $order_items,
            //             'product_id' => $order_item->product_id,
            //             'product_name' => $product_item->name,
            //             'product_price' => $product_item->price,
            //             'product_color' => $product_item->color,
            //             'size' => $order_item->size,
            //             'quantity' => $order_item->quantity,
            //             'image' => $product_item->images->first()->path,
            //         ];
            //     }
            //     return view('cart', ['cart' => $cart_count, 'cart', 'items' => $customArray, 'total_price' => $total_price,]);
            // }
        } else {
            return back()->with('error', 'Sign in to access your cart');
        }       
    }
}