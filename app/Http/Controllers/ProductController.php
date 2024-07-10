<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Product";
        $title_category = "Category Product";
        $products = Product::all();
        $productCategories = ProductCategory::all();
        return view('pages.product.index', ['title' => $title, 'products' => $products, 'productCategories' => $productCategories, 'title_category' => $title_category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Product";
        $categories = ProductCategory::all();
        return view('pages.product.create', ['title' => $title, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'price' => 'required',
            'name' => 'required',
            'qty' => 'nullable',
            'type' => 'required',
            'id_product_category' => 'required',
        ]);
        $data['qty'] = $request->qty ?? 0;
        if ($request->file('image') != null) {
            $data['image'] = $request->file('image')->store('images/product', 'public');
        }
        Product::create($data);
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $title = "Edit Product";
        $categories = ProductCategory::all();
        return view('pages.product.edit', ['title' => $title, 'product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($product->id);
        // dd($request->file('image'), $roomType);
        $data = $request->validate([
            'price' => 'required',
            'name' => 'required',
            'qty' => 'required',
            'type' => 'required',
            'id_product_category' => 'required',
        ]);
        if ($request->file('image')) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $data['image'] = $request->file('image')->store('images/product', 'public');
        } else {
            $data['image'] = $product->image;
        }
        $product->update($data);
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product->id);
        Product::destroy($product->id);
        return redirect(route('product.index'));
    }
}
