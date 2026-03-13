<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

use App\Models\Order;

class WebhookController extends Controller
{

    public function mercadopago(Request $request)
    {

        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

        if ($request->type !== 'payment') {
            return response()->json(['status' => 'ignored']);
        }

        $paymentId = $request->input('data.id');

        if (!$paymentId) {
            return response()->json(['status' => 'ignored']);
        }

        $client = new PaymentClient();
        $payment = $client->get($paymentId);

        $order = Order::with('items.variant')
            ->where('gateway_payment_id', $payment->id)
            ->first();

        if (!$order) {
            return response()->json(['status' => 'order_not_found']);
        }

        if ($order->status === 'paid') {
            return response()->json(['status' => 'already_processed']);
        }

        if ($payment->status === 'approved') {

            DB::transaction(function () use ($order) {

                $order->update([
                    'status' => 'paid',
                    'paid_at' => now()
                ]);

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
        }

        return response()->json(['status' => 'ok']);
    }
}
