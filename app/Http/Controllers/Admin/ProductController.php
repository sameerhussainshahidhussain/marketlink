<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['farmer.farmerProfile', 'category']);

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }
        if ($category = $request->input('category')) {
            $query->where('category_id', $category);
        }

        $products   = $query->latest()->paginate(20)->withQueryString();
        $categories = \App\Models\Category::where('status', 'active')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['farmer.farmerProfile', 'category', 'reviews.customer']);
        return view('admin.products.show', compact('product'));
    }

    public function toggle(Product $product)
    {
        $product->update(['status' => $product->status === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'Product status updated.');
    }
}
