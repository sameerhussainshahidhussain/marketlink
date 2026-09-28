<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected function getOrCreateCart(): Cart
    {
        return Cart::firstOrCreate(['customer_id' => Auth::id()]);
    }

    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load(['items.product.farmer.farmerProfile', 'items.product.category']);

        $farmerGroups = $cart->items->groupBy('farmer_id');

        return view('customer.cart', compact('cart', 'farmerGroups'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:100',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->isOrderable()) {
            return back()->with('error', 'This product is currently unavailable.');
        }

        $cart = $this->getOrCreateCart();

        $cartItem = $cart->items()
                         ->where('product_id', $product->id)
                         ->first();

        $existingQty = $cartItem ? $cartItem->quantity : 0;
        $newQty      = $request->quantity + $existingQty;

        if ($newQty > $product->stock_quantity) {
            return back()->with('error', "Only {$product->stock_quantity} units available.");
        }

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $newQty,
                'price'    => $product->price,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'farmer_id'  => $product->farmer_id,
                'quantity'   => $request->quantity,
                'price'      => $product->price,
            ]);
        }

        return back()->with('success', "'{$product->name}' added to cart.");
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $product = $cartItem->product;

        if ($request->quantity > $product->stock_quantity) {
            return back()->with('error', "Only {$product->stock_quantity} units available.");
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $cartItem)
    {
        $this->authorizeCartItem($cartItem);
        $cartItem->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function clear()
    {
        $cart = $this->getOrCreateCart();
        $cart->items()->delete();

        return back()->with('success', 'Cart cleared.');
    }

    protected function authorizeCartItem(CartItem $cartItem): void
    {
        $cart = $this->getOrCreateCart();
        abort_unless($cartItem->cart_id === $cart->id, 403);
    }
}
