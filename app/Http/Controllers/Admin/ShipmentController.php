<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Services\MelhorEnvioService;

class ShipmentController extends Controller
{
    // 📦 LISTAR
    public function index()
    {
        $shipments = Shipment::with('order.user')
            ->latest()
            ->get();

        return view('admin.shipments.index', compact('shipments'));
    }

    // ✏️ EDITAR
    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    // 🔄 ATUALIZAR
    public function update(Request $request, Shipment $shipment)
    {
        if (in_array($shipment->status, ['delivered', 'cancelled'])) {
            return back()->with('error', 'Envio bloqueado.');
        }

        $request->validate([
            'tracking_code' => 'nullable|string|max:255',
            'status' => 'required|string'
        ]);

        $shipment->update([
            'tracking_code' => $request->tracking_code,
            'status' => $request->status
        ]);

        return redirect()->route('admin.shipments.index')
            ->with('success', 'Envio atualizado!');
    }

    // 🚀 GERAR ETIQUETA
    public function gerarEtiqueta($id, MelhorEnvioService $service)
    {
        $shipment = Shipment::with('order.items', 'order.address', 'order.user')
            ->findOrFail($id);

        $order = $shipment->order;

        if ($shipment->tracking_code) {
            return back()->with('error', 'Etiqueta já gerada.');
        }

        if ($order->status !== 'paid') {
            return back()->with('error', 'Pedido não pago.');
        }

        if (!$order->address->cpf) {
            return back()->with('error', 'CPF do cliente obrigatório.');
        }

        try {

            // 📦 PAYLOAD
            $data = [
                "service" => $shipment->shipment_id,

                "from" => [
                    "name" => "Sua Loja",
                    "phone" => "11999999999",
                    "email" => "contato@sualoja.com",
                    "document" => "02899542400",
                    "address" => "Rua Origem",
                    "number" => "100",
                    "city" => "São Paulo",
                    "state_abbr" => "SP",
                    "postal_code" => "01010000"
                ],

                "to" => [
                    "name" => $order->address->recipient_name,
                    "phone" => $order->address->phone,
                    "email" => $order->user->email,
                    "document" => preg_replace('/\D/', '', $order->address->cpf),
                    "address" => $order->address->street,
                    "number" => $order->address->number,
                    "district" => $order->address->neighborhood,
                    "city" => $order->address->city,
                    "state_abbr" => $order->address->state,
                    "postal_code" => preg_replace('/\D/', '', $order->address->cep)
                ],

                "products" => $order->items->map(function ($item) {
                    return [
                        "name" => $item->name_snapshot,
                        "quantity" => $item->quantity,
                        "unitary_value" => (float) $item->price
                    ];
                })->toArray(),

                "volumes" => [
                    [
                        "weight" => 0.3,
                        "width" => 20,
                        "height" => 5,
                        "length" => 25
                    ]
                ]
            ];

            // 🛒 adicionar ao carrinho
            $cart = $service->adicionarAoCarrinho($data);

            if (!isset($cart['id'])) {
                \Log::error('Erro carrinho Melhor Envio', $cart);
                return back()->with('error', 'Erro ao adicionar ao carrinho.');
            }

            $cartId = $cart['id'];

            // 💳 comprar etiqueta
            $checkout = $service->comprarEtiqueta([
                "orders" => [$cartId]
            ]);

            if (!isset($checkout[0])) {
                \Log::error('Erro checkout Melhor Envio', $checkout);
                return back()->with('error', 'Erro ao comprar etiqueta.');
            }

            $etiqueta = $checkout[0];

            // 📌 salvar no banco
            $shipment->update([
                'tracking_code' => $etiqueta['tracking'] ?? null,
                'label_url' => $etiqueta['labels'][0]['url'] ?? null,
                'status' => 'shipped',
                'shipped_at' => now()
            ]);

            return back()->with('success', 'Etiqueta gerada com sucesso!');

        } catch (\Exception $e) {

            \Log::error('Erro geral envio', [
                'message' => $e->getMessage()
            ]);

            return back()->with('error', 'Erro: ' . $e->getMessage());
        }
    }
}
