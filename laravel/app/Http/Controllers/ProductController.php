<?php
namespace App\Http\Controllers;

use auth;
use App\Models\Images;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\ColorValidationRule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

const CSS_COLOR_KEYWORDS = [
    "aliceblue","antiquewhite","aqua","aquamarine","azure","beige","bisque","black","blanchedalmond","blue","blueviolet","brown","burlywood","cadetblue","chartreuse","chocolate","coral","cornflowerblue","cornsilk","crimson","cyan","darkblue","darkcyan","darkgoldenrod","darkgray","darkgreen","darkgrey","darkkhaki","darkmagenta","darkolivegreen","darkorange","darkorchid","darkred","darksalmon","darkseagreen","darkslateblue","darkslategray","darkslategrey","darkturquoise","darkviolet","deeppink","deepskyblue","dimgray","dimgrey","dodgerblue","firebrick","floralwhite","forestgreen","fuchsia","gainsboro","ghostwhite","gold","goldenrod","gray","grey","green","greenyellow","honeydew","hotpink","indianred","indigo","ivory","khaki","lavender","lavenderblush","lawngreen","lemonchiffon","lightblue","lightcoral","lightcyan","lightgoldenrodyellow","lightgray","lightgreen","lightgrey",
    "lightpink","lightsalmon","lightseagreen","lightskyblue","lightslategray","lightslategrey","lightsteelblue","lightyellow","lime","limegreen","linen","magenta","maroon","mediumaquamarine","mediumblue","mediumorchid","mediumpurple","mediumseagreen","mediumslateblue","mediumspringgreen","mediumturquoise","mediumvioletred","midnightblue","mintcream","mistyrose","moccasin","navajowhite","navy","oldlace","olive","olivedrab","orange","orangered","orchid","palegoldenrod","palegreen","paleturquoise","palevioletred","papayawhip","peachpuff","peru","pink","plum","powderblue","purple","red","rosybrown","royalblue","saddlebrown","salmon","sandybrown","seagreen","seashell","sienna","silver","skyblue","slateblue","slategray","slategrey","snow","springgreen","steelblue","tan","teal","thistle","tomato","turquoise","violet","wheat","white","whitesmoke","yellow","yellowgreen",
];
class ProductController extends Controller
{

    public function create(Request $request)
    {
        $cssColorKeywords = CSS_COLOR_KEYWORDS;
        // Validate the request data
        $formFields = $request->validate([
            'name' => ['required', 'string', 'max:255',],
            'price' => ['required', 'numeric', 'min:0',],
            'desc' => ['required', 'string', 'max:1024',],
            'tag' =>  ['required', 'string', 'max:255',],
            'color' => ['required', 'string', 'max:255', new ColorValidationRule($cssColorKeywords),],
            'file' => ['required', 'array', 'size:5',],
            'file.*' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:25600',], // Adjust max size as needed
        ]);

        // Create a new product
        $product_id = Products::create([
            'name' => $formFields['name'],
            'price' => strval($formFields['price']),
            'desc' => $formFields['desc'],
            'tag' => strtoupper($formFields['tag']),
            'color' => strtoupper($formFields['color'])
        ])->id;
        
        
        // Upload images and associate with the product
        foreach ($request->file('file') as $image) {
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/' . $product_id, $imageName);

            // Create a new image record in the images table
            Images::create([
                'product_id' => $product_id,
                'path' => 'storage/products/' . $product_id . '/' . $imageName,
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

        $query = Products::orderBy('created_at','desc')
            ->where('tag', $product->tag)
            ->whereNotIn('id', [$product->id])
            ->take(4)
            ->with('images');
        $related = $query->get();
        return view('product', ['product' => $product, 'related_product' => $related, 'cart' => $cart_count]);
    }

    public function all(Request $request)
    {   
        $latest_query = Products::orderBy('created_at','desc')
            ->where('stock','available')
            ->take(4)
            ->with('images');
        $latest = $latest_query->get();
        // dd($latest_query->pluck('id'));
        $data = $request->input('sort');

        if (!empty($data) && $data === 'date-desc') {
            $all_query = Products::orderBy('created_at', 'desc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'date-asc') {
            $all_query = Products::orderBy('created_at', 'asc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'name-desc') {
            $all_query = Products::orderBy('name', 'desc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'name-asc') {
            $all_query = Products::orderBy('name', 'asc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'price-desc') {
            $all_query = Products::orderBy('price', 'desc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } elseif (!empty($data) && $data === 'price-asc') {
            $all_query = Products::orderBy('price', 'asc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);

        } else {
            $all_query = Products::orderBy('id', 'desc')
            ->where('stock','available')
            ->whereNotIn('id', $latest_query->pluck('id'))
            ->with('images')
            ->filter(request(['search']))
            ->filter(request(['tag']));
            $products = $all_query->paginate(8);
        }
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
        
        $tags  = Products::distinct()->pluck('tag');
        return view('products', ['latest_product' => $latest, 'all_products' => $products, 'tags' => $tags, 'cart' => $cart_count]);
    }

    public function edit(Request $request) {
        $product_id = $request->route('productId'); 
        $product = Products::where('id', $product_id)->with('images')->first();
        return view('admin.edit', ['product' => $product]);
    }

    public function update(Request $request)  {
        // Find the product to be edited
        $cssColorKeywords = CSS_COLOR_KEYWORDS;
        $product_id = $request->input('product_id');
        $product = Products::where('id', $product_id)->first();
        $cssColorKeywords = array_map('strtolower', $cssColorKeywords);

        // Validate the request data
        $request->validate([
            'file' => 'required|array|size:5',
            'file.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:25600', // Adjust max size as needed
        ]);
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'desc' => 'required|string|max:1024',
            'tag' => 'required|string|max:255',
            'color' => ['required', 'string', 'max:255', new ColorValidationRule($cssColorKeywords)],
        ]);
        // Update the product
        $product->update($formFields);

        $images_to_delete = $product->images;
        // Delete all stored product images
        foreach ($images_to_delete as $image) {
            $path = 'app/'.str_replace('storage','public',$image->path);
            $path = storage_path($path);
            if (File::exists($path)) {
                File::delete($path);
            } else {
                return back()->with('error', 'Error uploading images.');           
            }
        }

        // Delete all product images from db
        $product->images()->delete();
        
        // Upload new images and associate with the product
        foreach ($request->file('file') as $image) {
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products/' . $product_id, $imageName);
            
            // Create a new image record in the images table
            Images::create([
                'product_id' => $product_id,
                'path' => 'storage/products/' . $product_id . '/' . $imageName,
            ]);
        }
        

        return redirect()->route('dashboard')->with('message', 'Product updated successfully!');
    }

    public function cancel(Request $request) {
        $product_id = $request->input('productId');
        $product = Products::where('id', $product_id)->first();
        if (!$product) {
            // Article doesn't exist, redirect back with a flash message
            return back()->with('error', 'Product not found.');
        }

        $images_to_delete = $product->images;
        // Delete all stored product images
        foreach ($images_to_delete as $image) {
            $path = 'app/'.$image->path;
            $path = storage_path($path);
            if (File::exists($path)) {
                File::delete($path);
            } else {
                return back()->with('error', 'Error uploading images.');           
            }
        }
        // Delete all product images from db
        $product->images()->delete();
        // Delete Product
        $product->delete();
        return back()->with('message', 'Product successfuly deleted.');
    }

    public function stock(Request $request) {
        $product_id = $request->route('productId');
        $product = Products::where('id', $product_id)->first();
        if (!$product) {
            // Article doesn't exist, redirect back with a flash message
            return back()->with('error', 'Product not found.');
        }
        if ($product->stock === 'available') {
            // Update the stock
            $product->update(['stock'=>'unavailable']);
            return redirect()->route('items')->with('message', 'Product now unavailable!');
        } elseif ($product->stock === 'unavailable') {
            // Update the stock
            $product->update(['stock'=>'available']);
            return redirect()->route('items')->with('message', 'Product now available!');
        } else {
            return redirect()->route('items')->with('error', 'Something went wrong, please try again');
        }
        
    }
}