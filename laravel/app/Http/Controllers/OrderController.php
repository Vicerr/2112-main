<?php

namespace App\Http\Controllers;

use App\Models\Billing;
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
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            $pending_order = Orders::where('user_id', $user_id)->where('status', 'pending')->count();
            if (!$order) {
                $cart_count = '';
                return redirect()->route('home')->with('message', "You don't have any item in your cart");
            } else {
                if (!$order && !$pending_order) {
                    $cart_count = '';
                } elseif ($order && !$pending_order) {
                    $cart_count = [count(json_decode($order->array_of_order_items)), ''];
                } elseif (!$order && $pending_order) {
                    $cart_count = ['', $pending_order];
                } else {
                    $cart_count = [count(json_decode($order->array_of_order_items)), $pending_order];
                }
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
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
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
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
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
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
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
                    if (count($new_array_of_order_items) > 1) {
                        unset($new_array_of_order_items[array_search($order_item->id, $new_array_of_order_items)]);
                        $order->update([
                            'array_of_order_items' => json_encode(array_values($new_array_of_order_items))
                        ]);
                        $order_item->delete();

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
                    }
                    $order_item->delete();
                    $order->delete();
                    return redirect()->route('home')->with('message', 'Item deleted successfully');
                    
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
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            $total_price = 0;
            if (!$order) {
                $product = Products::where('id', $formFields['product_id'])->first();
                $order_items_id = Order_items::create([
                    'product_id' => $formFields['product_id'],
                    'quantity' => $formFields['quantity'],
                    'size' => $formFields['size']                   
                ])->id;
                
                $total_price = $product->price * $formFields['quantity'];
                Orders::create([
                    'status' => 'queued',
                    'total_price' => $total_price,
                    'user_id' => $user_id,
                    'array_of_order_items' => json_encode(array($order_items_id))
                ]);
                // $cart_count = '';
                return back()->with('message', "Item successfully added to cart");
            } else {
                // check if product is already order cart
                foreach (json_decode($order->array_of_order_items) as $order_items_id) {
                    $order_item = Order_items::where('id', $order_items_id)->first();
                    // Access order item properties
                    $product_id = $order_item->product_id;
                    if ($product_id == $formFields['product_id']) {
                        return back()->with('error', "Item already added to cart");
                    }
                    $product_item = Products::where('id', $product_id)->first();
                    $total_price += $product_item->price * $order_item->quantity;
                }
                // Add new order item id to array
                $new_array_of_order_items = json_decode($order->array_of_order_items);
                $order_items_id = Order_items::create([
                    'product_id' => $formFields['product_id'],
                    'quantity' => $formFields['quantity'],
                    'size' => $formFields['size']                   
                ])->id;
                    
                array_push($new_array_of_order_items, $order_items_id);
                $product_item = Products::where('id', $formFields['product_id'])->first();
                $total_price += $product_item->price * $formFields['quantity'];

                $order->update([
                    'array_of_order_items' => json_encode(array_values($new_array_of_order_items)),
                    'total_price' => $total_price
                ]);

                return back()->with('message', 'Item successfully added to cart');
            }
        } else {
            return back()->with('error', 'Sign in to access your cart');
        }       
    }

    public function billing(Request $request) {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            $pending_order = Orders::where('user_id', $user_id)->where('status', 'pending')->count();
            if (!$order) {
                $cart_count = '';
                return redirect()->route('home')->with('message', "You don't have any item in your cart");
            } else {
                if (!$order && !$pending_order) {
                    $cart_count = '';
                } elseif ($order && !$pending_order) {
                    $cart_count = [count(json_decode($order->array_of_order_items)), ''];
                } elseif (!$order && $pending_order) {
                    $cart_count = ['', $pending_order];
                } else {
                    $cart_count = [count(json_decode($order->array_of_order_items)), $pending_order];
                }
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
                
                return view('checkout', ['cart' => $cart_count, 'items' => $customArray, 'total_price' => $total_price,]);
            }
        } else {
            $cart_count = '';
            return back()->with('error', 'Sign in to access your cart');
        }
    }
    
    public function checkout(Request $request) {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            if ($request->has(['address', 'city', 'landmark'])) {
                $formFields = $request->validate([
                    'phone' => ['required', 'string', 'max:255',],
                    'address' => ['string', 'max:225',],
                    'city' => ['string', 'max:225',],
                    'landmark' =>  ['string', 'max:255',],    
                    'deliveryType' => ['required', 'string', 'max:255', 'in:door_delivery,pickup',],
                ]); 
                // Create a new product
                Billing::create([
                    'user_id' => $user_id,
                    'phone_number' => $formFields['phone'],
                    'address' => $formFields['address'],
                    'city' => $formFields['city'],
                    'closest_landmark' => $formFields['landmark'],
                    'delivery_type' => $formFields['deliveryType'],
                ]);
            } else {
                $formFields = $request->validate([
                    'phone' => ['required', 'string', 'max:255',],
                    'deliveryType' => ['required', 'string', 'max:255', 'in:door_delivery,pickup',],
                ]);
                Billing::create([
                    'user_id' => $user_id,
                    'phone_number' => $formFields['phone'],
                    'delivery_type' => $formFields['deliveryType'],
                ]);
            }

            $order->update([
                'status' => 'pending'
            ]);
            return redirect()->route('home')->with('message', 'Order placed successfully');
        } else {
            return back()->with('error', 'Sign in to access your cart');
        }           
    }

    public function status(Request $request) {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $order_details = Orders::orderBy('created_at','desc')->where('user_id', $user_id)->where('status', '!=', 'queued')->get();
            $cart_count_order = Orders::where('user_id', $user_id)->where('status', 'queued')->first();
            $pending_order = Orders::where('user_id', $user_id)->where('status', 'pending')->count();
            if (!$cart_count_order && !$order_details) {
                if (!$pending_order) {
                    $cart_count = '';
                }
                return redirect()->route('home')->with('message', "You don't have any item in your cart");
            }
            
            if (!$order_details && $cart_count_order) {
                return redirect()->route('home')->with('message', "You have not made an order.");
            }
            
            if ($order_details) {
                if (!$cart_count_order && $pending_order) {
                    $cart_count = ['', $pending_order];
                } elseif ($cart_count_order && !$pending_order) {
                    $cart_count = [count(json_decode($order->array_of_order_items)), ''];
                } else {
                    $cart_count = [count(json_decode($order->array_of_order_items)), $pending_order];
                }
                $order_details_array = [];
                $order_item_details = [];
                $count = 1;
                foreach ($order_details as $order) {
                    foreach (json_decode($order->array_of_order_items) as $order_items) {
                        // Retrieve order items based on the IDs
                        $order_item = Order_items::where('id', $order_items)->first();
                        // Access order item properties
                        $product_id = $order_item->product_id;
                        $product_item = Products::where('id', $product_id)->first();
                        $order_item_details[] = [
                            'product_count' => $count,
                            'product_name' => $product_item->name,
                            'quantity' => $order_item->quantity,
                            'size' => $order_item->size,
                            'product_color' => $product_item->color,
                            'product_price' => $product_item->price,
                        ];
                        $count += 1;
                    }
                    $order_details_array[] = [
                        'order_id' => $order->id,
                        'total_price' => $order->total_price,
                        'status' => $order->status,
                        'order_item_details' => $order_item_details,
                    ];
                }
                
                return view('orders', ['cart' => $cart_count, 'order_details' => $order_details_array]);
            }
        } else {
            $cart_count = '';
            return back()->with('error', 'Sign in to access your cart');
        }

    }   
}