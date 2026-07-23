<?php

namespace App\Services\Public\Checkout;

use App\Models\Address;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutViewService
{
    public function getData()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | USUÁRIO NÃO LOGADO
        |--------------------------------------------------------------------------
        */

        if (!$user) {
            return [
                'cart' => null,
                'items' => collect(),
                'subtotal' => 0,
                'total' => 0,
                'shipping' => 0,
                'addresses' => collect(),
                'address' => null,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | BUSCAR ENDEREÇOS DO USUÁRIO
        |--------------------------------------------------------------------------
        */

        $addresses = Address::where('user_id', $user->id)
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | SELECIONAR ENDEREÇO PADRÃO
        |--------------------------------------------------------------------------
        |
        | Primeiro tenta encontrar um endereço marcado como padrão.
        | Caso não exista, utiliza o último endereço cadastrado.
        |
        */

        $address = $addresses
            ->firstWhere('is_default', true)
            ?? $addresses->first();


        /*
        |--------------------------------------------------------------------------
        | BUSCAR CARRINHO ATIVO
        |--------------------------------------------------------------------------
        */

        $cart = Cart::with('items.variant.product')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | USUÁRIO SEM CARRINHO
        |--------------------------------------------------------------------------
        */

        if (!$cart) {
            return [
                'cart' => null,
                'items' => collect(),
                'subtotal' => 0,
                'total' => 0,
                'shipping' => 0,

                // Endereços do usuário
                'addresses' => $addresses,

                // Endereço selecionado inicialmente
                'address' => $address,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | ITENS DO CARRINHO
        |--------------------------------------------------------------------------
        */

        $items = $cart->items ?? collect();


        /*
        |--------------------------------------------------------------------------
        | CALCULAR SUBTOTAL
        |--------------------------------------------------------------------------
        */

        $subtotal = $items->sum(function ($item) {
            return (float) $item->price
                * (int) $item->quantity;
        });


        /*
        |--------------------------------------------------------------------------
        | FRETE
        |--------------------------------------------------------------------------
        |
        | Inicialmente o frete é zero.
        | Ele será calculado posteriormente pelo Melhor Envio.
        |
        */

        $shipping = 0;


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $total = $subtotal + $shipping;


        /*
        |--------------------------------------------------------------------------
        | RETORNAR DADOS PARA A VIEW
        |--------------------------------------------------------------------------
        */

        return [
            'cart' => $cart,
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,

            // Todos os endereços cadastrados
            'addresses' => $addresses,

            // Endereço selecionado inicialmente
            'address' => $address,
        ];
    }
}
