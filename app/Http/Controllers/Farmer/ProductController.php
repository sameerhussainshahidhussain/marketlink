<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $farmer = Auth::user();

        $query = $farmer->products()->with('category');

        $search = $request->input('search');
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $category = $request->input('category');
        if ($category) {
            $query->where('category_id', $category);
        }

        $status = $request->input('status');
        if ($status) {
            $query->where('status', $status);
        }

        $products   = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::where('status', 'active')->get();

        return view('farmer.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        return view('farmer.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:191',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0.01',
            'unit'           => 'required|string|max:50',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'status'         => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['farmer_id'] = Auth::id();

        Product::create($data);

        return redirect()->route('farmer.products.index')
                         ->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        if ($product->farmer_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::where('status', 'active')->get();
        return view('farmer.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->farmer_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'category_id'    => 'required|exists:categories,id',
            'name'           => 'required|string|max:191',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0.01',
            'unit'           => 'required|string|max:50',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'status'         => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('farmer.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->farmer_id !== Auth::id()) {
            abort(403);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('farmer.products.index')
                         ->with('success', 'Product deleted.');
    }

    public function toggleStatus(Product $product)
    {
        if ($product->farmer_id !== Auth::id()) {
            abort(403);
        }

        $newStatus = $product->status === 'active' ? 'inactive' : 'active';
        $product->update(['status' => $newStatus]);

        return back()->with('success', 'Product status updated.');
    }

    public function show(Product $product)
    {
        if ($product->farmer_id !== Auth::id()) {
            abort(403);
        }

        $product->load(['category', 'reviews.customer', 'orderItems']);

        return view('farmer.products.show', compact('product'));
    }
}
