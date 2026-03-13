<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Página de Checkout
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Cart::with('items.variant')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Seu carrinho está vazio.');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $shipping = 15;

        $total = $subtotal + $shipping;

        $hasAddress = Address::where('user_id', $user->id)->exists();

        $address = Address::where('user_id', $user->id)
            ->where('is_default', true)
            ->first();

        if (!$address) {
            $address = Address::where('user_id', $user->id)->first();
        }

        return view('public.checkout.index', compact(
            'cart',
            'subtotal',
            'shipping',
            'total',
            'hasAddress',
            'address'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Criar Pedido
    |--------------------------------------------------------------------------
    */

    public function processOrder()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Cart::with('items')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $address = Address::where('user_id', $user->id)
            ->where('is_default', true)
            ->first();

        if (!$address) {
            $address = Address::where('user_id', $user->id)->first();
        }

        if (!$address) {
            return redirect()->route('checkout.index')
                ->with('error', 'Você precisa cadastrar um endereço.');
        }

        $order = DB::transaction(function () use ($cart, $user, $address) {

            $subtotal = $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $shipping = 15;

            $total = $subtotal + $shipping;

            /*
            | Criar pedido
            */

            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $address->id,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'status' => 'pending'
            ]);

            /*
            | Criar itens do pedido
            */

            foreach ($cart->items as $item) {

                OrderItem::create([

                    'order_id' => $order->id,
                    'product_variant_id' => $item->product_variant_id,

                    'name_snapshot' => $item->name_snapshot,
                    'image_snapshot' => $item->image_snapshot,

                    'color_snapshot' => $item->color_snapshot,
                    'size_snapshot' => $item->size_snapshot,

                    'price' => $item->price,
                    'quantity' => $item->quantity

                ]);
            }

            /*
            | Converter carrinho
            */

            $cart->update([
                'status' => 'converted'
            ]);

            return $order;
        });

        return redirect()->route('payment', $order->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Página de Pagamento
    |--------------------------------------------------------------------------
    */

    public function payment($orderId)
    {
        $user = Auth::user();

        $order = Order::with('items')
            ->where('user_id', $user->id)
            ->where('id', $orderId)
            ->firstOrFail();

        return view('public.payment.index', compact('order'));
    }

    /*
    |--------------------------------------------------------------------------
    | Escolher Método de Pagamento
    |--------------------------------------------------------------------------
    */

    // public function confirmPayment(Request $request, $orderId)
    // {

    //     $request->validate([
    //         'payment_method' => 'required'
    //     ]);

    //     $user = Auth::user();

    //     $order = Order::where('user_id', $user->id)
    //         ->where('id', $orderId)
    //         ->firstOrFail();

    //     /*
    //     | Salvar método escolhido
    //     */

    //     $order->update([
    //         'payment_method' => $request->payment_method
    //     ]);

    //     /*
    //     | Redirecionar para gateway
    //     */

    //     if ($request->payment_method == 'pix') {
    //         return redirect()->route('payment.pix', $order->id);
    //     }

    //     if ($request->payment_method == 'card') {
    //         return redirect()->route('payment.card', $order->id);
    //     }

    //     if ($request->payment_method == 'boleto') {
    //         return redirect()->route('payment.boleto', $order->id);
    //     }

    //     return redirect()->back()->with('error', 'Método de pagamento inválido.');
    // }


    /*
    |--------------------------------------------------------------------------
    | Confirmar Pagamento
    |--------------------------------------------------------------------------
    */

    public function confirmPayment(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);

        $user = Auth::user();

        $order = Order::with('items.variant')
            ->where('user_id', $user->id)
            ->where('id', $orderId)
            ->firstOrFail();

        DB::transaction(function () use ($order, $request) {

            /*
            | Atualizar pedido
            */

            $order->update([
                'payment_method' => $request->payment_method,
                'status' => 'paid',
                'paid_at' => now()
            ]);

            /*
            | Baixar estoque
            */

            foreach ($order->items as $item) {

                $variant = $item->variant;

                if ($variant) {

                    if ($variant->stock < $item->quantity) {
                        throw new \Exception('Estoque insuficiente.');
                    }

                    $variant->decrement('stock', $item->quantity);
                }
            }

        });

        return redirect()->route('order.success');
    }

}
