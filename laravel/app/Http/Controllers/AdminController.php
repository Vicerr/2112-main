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
        $orderCount = Orders::where('status', 'delivered')->count();;
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
    public function items() {
        return view('admin.items');
    }

    // Show users page
    public function users() {
        return view('admin.users');
    }
}
