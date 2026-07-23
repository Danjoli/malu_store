<?php

namespace App\Services\Public\Checkout;

use App\Models\{Address, Cart, Order, OrderItem, Shipment};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CheckoutService
{
    /**
     * Processa o checkout e cria o pedido.
     */
    public function process(array $data): Order
    {
        $user = Auth::user();

        if (!$user) {
            throw new RuntimeException('Usuário não autenticado.');
        }

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
                throw new RuntimeException('Carrinho vazio.');
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
            | NORMALIZAÇÃO
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

            $complement = $data['complement'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | ENDEREÇO
            |--------------------------------------------------------------------------
            */

            $addressId = $data['address_id'] ?? null;

            if ($addressId) {

                /*
                |--------------------------------------------------------------------------
                | ENDEREÇO EXISTENTE
                |--------------------------------------------------------------------------
                |
                | Garante que o endereço selecionado pertence
                | ao usuário autenticado.
                |
                */

                $address = Address::where('user_id', $user->id)
                    ->findOrFail($addressId);

                /*
                | Usa o CPF informado no checkout.
                | Caso não seja informado, mantém o CPF salvo no endereço.
                */

                $cpf = $cpf ?: $address->cpf;

            } else {

                /*
                |--------------------------------------------------------------------------
                | PROCURA ENDEREÇO EXISTENTE
                |--------------------------------------------------------------------------
                */

                $address = Address::where('user_id', $user->id)
                    ->where('recipient_name', $data['recipient_name'])
                    ->where('phone', $data['phone'])
                    ->where('street', $data['street'])
                    ->where('number', $data['number'])
                    ->where('neighborhood', $data['neighborhood'])
                    ->where('city', $data['city'])
                    ->where('state', $state)
                    ->where('cep', $cep)
                    ->where(function ($query) use ($complement) {

                        if (empty($complement)) {
                            $query->whereNull('complement')
                                ->orWhere('complement', '');
                        } else {
                            $query->where('complement', $complement);
                        }

                    })
                    ->first();

                /*
                |--------------------------------------------------------------------------
                | CRIA NOVO ENDEREÇO
                |--------------------------------------------------------------------------
                */

                if (!$address) {

                    $address = Address::create([
                        'user_id' => $user->id,
                        'label' => $data['label'] ?? null,
                        'recipient_name' => $data['recipient_name'],
                        'phone' => $data['phone'],
                        'street' => $data['street'],
                        'number' => $data['number'],
                        'complement' => $complement,
                        'neighborhood' => $data['neighborhood'],
                        'city' => $data['city'],
                        'state' => $state,
                        'cep' => $cep,
                        'cpf' => $cpf,
                        'is_default' => !empty($data['is_default']),
                    ]);

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | ENDEREÇO ENCONTRADO
                    |--------------------------------------------------------------------------
                    |
                    | Caso o endereço já exista, utiliza o CPF informado
                    | no checkout ou o CPF salvo no endereço.
                    |
                    */

                    $cpf = $cpf ?: $address->cpf;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CANCELA PEDIDOS PENDENTES ANTERIORES
            |--------------------------------------------------------------------------
            */

            Order::where('user_id', $user->id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'cancelled',
                ]);

            /*
            |--------------------------------------------------------------------------
            | CRIA PEDIDO
            |--------------------------------------------------------------------------
            |
            | O pedido armazena um snapshot do endereço utilizado.
            | Não usamos address_id porque o seu Order não possui essa coluna.
            |
            */

            $order = Order::create([
                'user_id' => $user->id,

                'recipient_name' => $address->recipient_name,
                'phone' => $address->phone,
                'cpf' => $cpf,
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
            | CRIA ITENS DO PEDIDO
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
            | CRIA ENVIO
            |--------------------------------------------------------------------------
            */

            Shipment::create([
                'order_id' => $order->id,
                'carrier' => $data['carrier'],
                'shipping_cost' => $shipping,
                'service_id' => $data['service'],
                'status' => 'pending',
            ]);

            return $order;
        });
    }
}
