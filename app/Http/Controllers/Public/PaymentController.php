<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

use App\Models\Order;

class PaymentController extends Controller
{

    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.token'));
    }

    /*
    |--------------------------------------------------------------------------
    | PIX
    |--------------------------------------------------------------------------
    */

    public function createPix($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);

        $client = new PaymentClient();

        $payment = $client->create([
            "transaction_amount" => (float) $order->total,
            "description" => "Pedido #" . $order->id,
            "payment_method_id" => "pix",

            "payer" => [
                "email" => $order->user->email
            ]
        ]);

        $order->update([
            'gateway_payment_id' => $payment->id
        ]);

        return view('public.payment.pix', [
            'order' => $order,
            'qr_code' => $payment->point_of_interaction->transaction_data->qr_code,
            'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BOLETO
    |--------------------------------------------------------------------------
    */

    public function createBoleto($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);

        $client = new PaymentClient();

        try {

            $payment = $client->create([

                "transaction_amount" => (float) $order->total,
                "description" => "Pedido #" . $order->id,
                "payment_method_id" => "bolbradesco",

                "payer" => [

                    "email" => $order->user->email,
                    "first_name" => $order->user->name,
                    "last_name" => "Cliente",

                    "identification" => [
                        "type" => "CPF",
                        "number" => "19119119100"
                    ],

                    "address" => [
                        "zip_code" => "01311000",
                        "street_name" => "Av Paulista",
                        "street_number" => "1000",
                        "neighborhood" => "Bela Vista",
                        "city" => "Sao Paulo",
                        "federal_unit" => "SP"
                    ]
                ]

            ]);

        } catch (\Exception $e) {

            return back()->with('error', 'Erro ao gerar boleto.');

        }

        $order->update([
            'gateway_payment_id' => $payment->id
        ]);

        return view('public.payment.boleto', [
            'order' => $order,
            'boleto_url' => $payment->transaction_details->external_resource_url
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | FORM CARTÃO
    |--------------------------------------------------------------------------
    */

    public function createCard($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);

        return view('public.payment.card', [
            'order' => $order
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESSAR CARTÃO
    |--------------------------------------------------------------------------
    */

    public function processCard(Request $request, $orderId)
    {

        $order = Order::with('user')->findOrFail($orderId);

        $client = new PaymentClient();

        $payment = $client->create([

            "transaction_amount" => (float) $order->total,

            "token" => $request->token,

            "description" => "Pedido #" . $order->id,

            "installments" => 1,

            "payment_method_id" => $request->payment_method_id,

            "payer" => [
                "email" => $order->user->email
            ]

        ]);

        $order->update([
            'gateway_payment_id' => $payment->id
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
