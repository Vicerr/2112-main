<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show Dashboard
    public function dashboard() {
        $userCount = User::count();
        $productCount = Products::count();
        $orderCount = Orders::where('status', 'pending')->count();;
        $salesCount = Orders::where('status', 'delivered')->sum('total_price');

        $query = User::orderBy('created_at', 'desc')
        ->whereNotNull('email_verified_at')
        ->where('role', '!=', 'admin');
    
        $users = $query->paginate(6);

        return view("admin.dashboard", ['stat'=>compact('userCount', 'productCount', 'orderCount', 'salesCount'), 'users' => $users]);
    }

    // Show product create form
    public function create() {
        return view('admin.create');
    }

    // Show items page
    public function items(Request $request) {
        $data = $request->input('sort');

        if (!empty($data) && $data === 'date-desc') {
            $query = Products::orderBy('created_at', 'desc')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'date-asc') {
            $query = Products::orderBy('created_at', 'asc')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'name-desc') {
            $query = Products::orderBy('name', 'desc')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'name-asc') {
            $query = Products::orderBy('name', 'asc')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'price-desc') {
            $query = Products::orderBy('price', 'desc')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'price-asc') {
            $query = Products::orderBy('price', 'asc')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'available') {
            $query = Products::orderBy('name', 'desc')->where('stock','available')->filter(request(['search']));
            $products = $query->paginate(6);

        } elseif (!empty($data) && $data === 'unavailable') {
            $query = Products::orderBy('name', 'asc')->where('stock','unavailable')->filter(request(['search']));
            $products = $query->paginate(6);

        } else {
            $query = Products::orderBy('id', 'desc')->filter(request(['search']));
            $products = $query->paginate(6);
        }

        return view('admin.items', ['products' => $products]);
    }

    // Show orders page
    public function orders(Request $request) {        
        $data = $request->input('filter');

        if (!empty($data) && $data === 'delivered') {
            // Data exists in the URL and is delivered
            $query = Orders::orderBy('id', 'desc')
            ->where('status', 'delivered')
            ->with('user');
    
            $orders = $query->paginate(6);
        } elseif (!empty($data) && $data === 'pending') {
            // Data does not exist in the URL
            $query = Orders::orderBy('id', 'desc')
            ->where('status', 'pending')
            ->with('user');
    
            $orders = $query->paginate(6);
        }  elseif (!empty($data) && $data === 'cancelled') {
            // Data does not exist in the URL
            $query = Orders::orderBy('id', 'desc')
            ->where('status', 'cancelled')
            ->with('user');
    
            $orders = $query->paginate(6);
        } else {
            // Data does not exist in the URL
            $query = Orders::orderBy('id', 'desc')
            ->where('status', '!=', 'cancelled')
            ->with('user');
    
            $orders = $query->paginate(6);
        }
        return view('admin.orders', ['orders' => $orders,]);
    }
}
