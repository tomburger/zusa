<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodcats = ProductCategory::whereNull('parent')->get();
        $products = Product::whereNull('product_category_id')-> get();
        return view('products.index', compact('prodcats', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $type)
    {
        if ($type == 'category') { 
            $prodcat = new ProductCategory();
            $prodcat->parent = $request->input("parent");
            return view('products.category.create', compact('prodcat'));
        }
        if ($type == 'product') { 
            $product = new Product();
            return view('products.product.create', compact('product'));
        }
        throw new \Exception('Invalid request type $type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->input("type") == "category") {
            $post = new ProductCategory();
            $post->name = $request->input("name");
            $post->parent = $request->input("parent");
            if ($post->save()) {
                $result = redirect();
                if ($post->parent) {
                    $result = $result->route('products.show', ['type' => 'category', 'id' => $post->parent]);
                } 
                else {
                    $result = $result->route('products.index');
                }
                return $result->with('success', 'Product category created successfully.');
            }
        }
        if ($request->input("type") == "product") {
            $post = new Product();
            $post->name = $request->input("name");
            $post->product_category_id = $request->input("product_category_id");
            $post->vendor_id = $request->input("vendor_id");
            $post->dimension_id = $request->input("dimension_id");
            if ($post->save()) {
                return redirect()->route('products.index')->with('success', 'Product created successfully.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, string $id)
    {
        if ($type == 'category') { 
            $prodcat = ProductCategory::findOrFail($id);
            return view('products.category.show', compact('prodcat'));
        }
        if ($type == 'product') { 
            $product = Product::findOrFail($id);
            return view('products.product.show', compact('product'));
        }
        throw new \Exception('Invalid request type $type');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $type, string $id)
    {
        if ($type == 'category') { 
            $prodcat = ProductCategory::findOrFail($id);
            return view('products.category.edit', compact('prodcat'));
        }
        if ($type == 'product') { 
            $product = Product::findOrFail($id);
            return view('products.product.edit', compact('product'));
        }
        throw new \Exception('Invalid request type $type');    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $type, string $id)
    {
        if ($type == "category") {
            $post = ProductCategory::findOrFail($id);
            $post->name = $request->input("name");
            $post->parent = $request->input("parent");
            if ($post->save()) {
                return redirect()->route('products.index')->with('success', "Product category $post->name updated successfully.");
            }
        }
        if ($type == "product") {
            $post = Product::findOrFail($id);
            $post->name = $request->input("name");
            $post->product_category_id = $request->input("product_category_id");
            $post->vendor_id = $request->input("vendor_id");
            $post->dimension_id = $request->input("dimension_id");
            if ($post->save()) {
                return redirect()->route('products.index')->with('success', "Product $post->name updated successfully.");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
