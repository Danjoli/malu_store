<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate([
                'user_id' => Auth::id()
            ]);
        }

        return Cart::firstOrCreate([
            'session_id' => session()->getId()
        ]);
    }

    public function index()
    {
        $cart = $this->getCart()->load('items.product');

        return Inertia::render('Cart/Index', [
            'cart' => $cart
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = $this->getCart();
        $product = Product::findOrFail($request->product_id);

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        $cart->items()->where('id', $id)->delete();

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();
        $cart->items()->where('id', $id)->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back();
    }
}
