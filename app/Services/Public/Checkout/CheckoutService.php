<?php

namespace App\Services\Public\Checkout;

use App\Models\{Cart, Order, OrderItem, Shipment};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
    public function process(array $data)
    {
        $user = Auth::user();

        return DB::transaction(function () use ($user, $data) {

            /*
            |--------------------------------------------------------------------------
            | CARRINHO
            |--------------------------------------------------------------------------
            */

            $cart = Cart::with('items.variant')
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->firstOrFail();

            if ($cart->items->isEmpty()) {
                throw new \Exception('Carrinho vazio.');
            }

            /*
            |--------------------------------------------------------------------------
            | VALORES
            |--------------------------------------------------------------------------
            */

            $subtotal = $cart->items->sum(
                fn ($item) => $item->price * $item->quantity
            );

            $shipping = (float) ($data['shipping_cost'] ?? 0);

            $total = $subtotal + $shipping;

            /*
            |--------------------------------------------------------------------------
            | NORMALIZAR DADOS DO ENDEREÇO
            |--------------------------------------------------------------------------
            */

            $cpf = preg_replace(
                '/\D/',
                '',
                $data['cpf'] ?? ''
            );

            $cep = preg_replace(
                '/\D/',
                '',
                $data['cep'] ?? ''
            );

            $state = strtoupper(
                trim($data['state'] ?? '')
            );

            $recipientName = trim(
                $data['recipient_name'] ?? ''
            );

            $phone = trim(
                $data['phone'] ?? ''
            );

            $street = trim(
                $data['street'] ?? ''
            );

            $number = trim(
                $data['number'] ?? ''
            );

            $complement = isset($data['complement'])
                ? trim($data['complement'])
                : null;

            $neighborhood = trim(
                $data['neighborhood'] ?? ''
            );

            $city = trim(
                $data['city'] ?? ''
            );

            /*
            |--------------------------------------------------------------------------
            | CANCELAR PEDIDOS PENDENTES ANTERIORES
            |--------------------------------------------------------------------------
            */

            Order::where('user_id', $user->id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'cancelled'
                ]);

            /*
            |--------------------------------------------------------------------------
            | CRIAR PEDIDO
            |--------------------------------------------------------------------------
            |
            | IMPORTANTE:
            |
            | Aqui NÃO usamos mais $address.
            |
            | O endereço enviado pelo checkout é salvo diretamente no pedido.
            |
            | Isso cria um snapshot do endereço usado na compra.
            |
            | Se o usuário alterar o endereço futuramente no perfil,
            | o pedido continuará com o endereço original.
            |
            */

            $order = Order::create([

                /*
                |--------------------------------------------------------------------------
                | USUÁRIO
                |--------------------------------------------------------------------------
                */

                'user_id' => $user->id,

                /*
                |--------------------------------------------------------------------------
                | SNAPSHOT DO ENDEREÇO
                |--------------------------------------------------------------------------
                */

                'recipient_name' => $recipientName,

                'phone' => $phone,

                'cpf' => $cpf,

                'street' => $street,

                'number' => $number,

                'complement' => $complement,

                'neighborhood' => $neighborhood,

                'city' => $city,

                'state' => $state,

                'cep' => $cep,

                /*
                |--------------------------------------------------------------------------
                | VALORES
                |--------------------------------------------------------------------------
                */

                'subtotal' => $subtotal,

                'shipping' => $shipping,

                'total' => $total,

                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                'status' => 'pending',

            ]);

            /*
            |--------------------------------------------------------------------------
            | CRIAR ITENS DO PEDIDO
            |--------------------------------------------------------------------------
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

                    'quantity' => $item->quantity,

                ]);

            }

            /*
            |--------------------------------------------------------------------------
            | CRIAR ENVIO
            |--------------------------------------------------------------------------
            */

            Shipment::create([

                'order_id' => $order->id,

                'carrier' => $data['carrier'] ?? null,

                'shipping_cost' => $shipping,

                'service_id' => $data['service'] ?? null,

                'status' => 'pending',

            ]);

            /*
            |--------------------------------------------------------------------------
            | RETORNAR PEDIDO
            |--------------------------------------------------------------------------
            */

            return $order;

        });
    }
}
