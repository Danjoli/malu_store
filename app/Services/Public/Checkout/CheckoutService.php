<?php

namespace App\Services\Public\Checkout;

use App\Models\{Cart, Address, Order, OrderItem, Shipment};
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
            | NORMALIZAR DADOS
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

            $complement = !empty($data['complement'])
                ? trim($data['complement'])
                : null;

            /*
            |--------------------------------------------------------------------------
            | ENDEREÇO
            |--------------------------------------------------------------------------
            |
            | Se foi informado um address_id, verificamos se pertence ao usuário.
            | Caso contrário, criamos um novo endereço.
            |
            */

            $address = null;

            if (!empty($data['address_id'])) {

                $address = Address::where('user_id', $user->id)
                    ->where('id', $data['address_id'])
                    ->firstOrFail();

                /*
                |----------------------------------------------------------------------
                | Atualiza o endereço com os dados atuais do checkout
                |----------------------------------------------------------------------
                |
                | Isso garante que o complemento digitado no checkout seja salvo.
                |
                */

                $address->update([
                    'label' => $data['label'] ?? $address->label,
                    'recipient_name' => $data['recipient_name'],
                    'phone' => $data['phone'],
                    'cpf' => $cpf,
                    'street' => $data['street'],
                    'number' => $data['number'],
                    'complement' => $complement,
                    'neighborhood' => $data['neighborhood'],
                    'city' => $data['city'],
                    'state' => $state,
                    'cep' => $cep,
                ]);

                /*
                |----------------------------------------------------------------------
                | Recarrega o endereço atualizado
                |----------------------------------------------------------------------
                */

                $address->refresh();

            } else {

                /*
                |----------------------------------------------------------------------
                | Procura um endereço exatamente igual
                |----------------------------------------------------------------------
                */

                $address = Address::where('user_id', $user->id)
                    ->where('recipient_name', $data['recipient_name'])
                    ->where('phone', $data['phone'])
                    ->where('cpf', $cpf)
                    ->where('street', $data['street'])
                    ->where('number', $data['number'])
                    ->where('neighborhood', $data['neighborhood'])
                    ->where('city', $data['city'])
                    ->where('state', $state)
                    ->where('cep', $cep)
                    ->where(function ($query) use ($complement) {

                        if ($complement === null) {

                            $query->whereNull('complement')
                                ->orWhere('complement', '');

                        } else {

                            $query->where('complement', $complement);

                        }

                    })
                    ->first();

                /*
                |----------------------------------------------------------------------
                | Cria novo endereço
                |----------------------------------------------------------------------
                */

                if (!$address) {

                    $address = Address::create([
                        'user_id' => $user->id,
                        'label' => $data['label'] ?? null,
                        'recipient_name' => $data['recipient_name'],
                        'phone' => $data['phone'],
                        'cpf' => $cpf,
                        'street' => $data['street'],
                        'number' => $data['number'],
                        'complement' => $complement,
                        'neighborhood' => $data['neighborhood'],
                        'city' => $data['city'],
                        'state' => $state,
                        'cep' => $cep,
                        'is_default' => !empty($data['is_default']),
                    ]);

                }

            }

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
            | O pedido recebe um snapshot dos dados atuais do endereço.
            |
            */

            $order = Order::create([

                'user_id' => $user->id,

                'recipient_name' => $address->recipient_name,
                'phone' => $address->phone,
                'cpf' => $address->cpf,
                'street' => $address->street,
                'number' => $address->number,
                'complement' => $address->complement,
                'neighborhood' => $address->neighborhood,
                'city' => $address->city,
                'state' => $address->state,
                'cep' => $address->cep,

                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,

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

                'carrier' => $data['carrier'],

                'shipping_cost' => $shipping,

                'service_id' => $data['service'],

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
