<?php
namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request data
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'desc' => 'required|string|max:1024',
            'tag' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'file' => 'required|array|size:5',
            'file.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust max size as needed
        ]);

        // Create a new product
        $product_id = Products::create([
            'name' => $formFields['name'],
            'price' => strval($formFields['price']),
            'desc' => $formFields['desc'],
            'tag' => strtoupper($formFields['tag']),
            'color' => strtoupper($formFields['color'])
        ])->product_id;
        
        // Upload images and associate with the product
        foreach ($request->file('file') as $image) {
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/' . $product_id, $imageName);

            // Create a new image record in the images table
            Images::create([
                'product_id' => $product_id,
                'path' => 'public/products/' . $product_id . '/' . $imageName,
            ]);
        }

        // Redirect to a success page or view
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('message', 'Product created successfully!');
    }
}