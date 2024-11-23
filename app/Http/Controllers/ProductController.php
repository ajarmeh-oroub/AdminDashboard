<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Era;
use App\Models\Product_image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with(['store', 'images' => function ($query) {
            $query->where('view', 'front'); // Example condition: load only 'front' images
        }])->orderBy('created_at', 'desc')->get();

        return view('product.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $stores = Store::all();
        $eras = Era::all();

        return view('product.create', compact('categories', 'stores', 'eras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|integer',
            'store_id' => 'required|integer',
            'era_id' => 'required|integer',
            'visible' => 'required|boolean',
            'description' => 'required|string',
            'front_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'back_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'side_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
//        dd($validated);
        $product = Product::create($validated);


        $images = [
            'front_image' => 'front',
            'back_image' => 'back',
            'side_image' => 'side',
        ];

        foreach ($images as $inputName => $view) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $filePath = $file->store('assets/uploads/products', 'public'); // Save in public/uploads/products

                // Save image to product_images table
                Product_image::create([
                    'product_id' => $product->id,
                    'view' => $view,
                    'image' => $filePath,
                ]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'store', 'images'])->find($id);


        return view('product.view', [
            'product' => $product,
            'categories' => $product->category,
            'store' => $product->store,
            'images' => $product->images,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['category', 'store', 'images', 'era'])->find($id);

        // Get all categories and stores
        $categories = Category::all();
        $stores = Store::all();
        $eras = Era::all();

        return view('product.edit', [
            'product' => $product,
            'categories' => $categories,  // Pass the list of categories
            'stores' => $stores,
            'eras' => $eras,// Pass the list of stores
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|integer',
            'store_id' => 'required|integer',
            'era_id' => 'required|integer',
            'visible' => 'required|boolean',
            'description' => 'required|string',
            'front_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'back_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'side_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product= Product::findorfail($id);
        $product->update($validated);


        $images = [
            'front_image' => 'front',
            'back_image' => 'back',
            'side_image' => 'side',
        ];

        foreach ($images as $inputName => $view) {
            if ($request->hasFile($inputName)) {
                $file = $request->file($inputName);
                $filePath = $file->store('assets/uploads/products', 'public'); // Save in public/uploads/products

                // Save image to product_images table
                Product_image::update([
                    'product_id' => $product->id,
                    'view' => $view,
                    'image' => $filePath,
                ]);
            }

        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');

    }
    public function updateStatus(Request $request, string $id , string $status)
    {

        $prodct=Product::findorfail($id);
        $prodct->visible= $status ? 0 : 1;
        $prodct->save();
        return redirect()->route('product.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
