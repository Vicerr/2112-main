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

    public function show(Request $request)
    {
        $product_id = $request->route('productId'); 
        $product = Products::where('id', $product_id)->with('images')->first();
        if (!$product) {
            // Product doesn't exist, redirect back with a flash message
            return redirect()->route('products')->with('error', 'Product not found.');
        }

        $query = Products::orderBy('created_at','desc')
            ->where('tag', $product->tag)
            ->whereNotIn('id', [$product->id])
            ->take(4)
            ->with('images');
        $related = $query->get();
        return view('product', ['product' => $product, 'related_product' => $related]);
    }

    public function all(Request $request)
    {   
        $latest_query = Products::orderBy('created_at','desc')
            ->take(4)
            ->with('images');
        $latest = $latest_query->get();
        // dd($latest_query->pluck('id'));
        $data = $request->input('sort');

        if (!empty($data) && $data === 'date-desc') {
            $all_query = Products::orderBy('created_at', 'desc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'date-asc') {
            $all_query = Products::orderBy('created_at', 'asc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'name-desc') {
            $all_query = Products::orderBy('name', 'desc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'name-asc') {
            $all_query = Products::orderBy('name', 'asc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'price-desc') {
            $all_query = Products::orderBy('price', 'desc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'price-asc') {
            $all_query = Products::orderBy('price', 'asc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } else {
            $all_query = Products::orderBy('id', 'desc')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);
        }

        $tags  = Products::distinct()->pluck('tag');
        return view('products', ['latest_product' => $latest, 'all_products' => $products, 'tags' => $tags]);
    }
}