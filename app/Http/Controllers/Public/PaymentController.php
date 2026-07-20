<?php

namespace App\Http\Controllers;

use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService
    ) {}

    /**
     * Exibe a página de pagamento do pedido.
     */
    public function method(int $orderId)
    {
        return $this->paymentService->method($orderId);
    }

    /**
     * Cria um pagamento via Pix.
     */
    public function pix(int $orderId)
    {
        return $this->paymentService->pix($orderId);
    }

    /**
     * Cria um pagamento via boleto.
     */
    public function boleto(int $orderId)
    {
        return $this->paymentService->boleto($orderId);
    }

    /**
     * Processa um pagamento via cartão.
     */
    public function card(Request $request, int $orderId)
    {
        return $this->paymentService->card($request, $orderId);
    }

    /**
     * Exibe a página de sucesso.
     */
    public function success(int $orderId)
    {
        return $this->paymentService->success($orderId);
    }

    /**
     * Exibe a página de erro.
     */
    public function error(int $orderId)
    {
        return $this->paymentService->error($orderId);
    }
}
