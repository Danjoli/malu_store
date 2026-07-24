<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Admins\Shipment\MelhorEnvioWebhookService;
use App\Services\Public\Payment\AsaasWebhookService;


class WebhookController extends Controller
{
    public function __construct(
        protected MelhorEnvioWebhookService $melhorEnvioWebhookService,
        protected AsaasWebhookService $asaasWebhookService
    ) {}

    public function melhorEnvio(Request $request)
    {
        $this->melhorEnvioWebhookService->handleMelhorEnvio(
            $request->all()
        );

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function asaas(Request $request)
    {
        // $token = $request->header('asaas-access-token');

        // if ($token !== config('services.asaas.webhook_token')) {
        //     return response()->json([
        //         'message' => 'Unauthorized'
        //     ], 401);
        // }

        $this->asaasWebhookService->handleAsaas(
            $request->all()
        );

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function debugAsaas(Request $request)
    {
        return response()->json([
            'token_recebido' => $request->header('asaas-access-token'),
            'token_configurado' => config('services.asaas.webhook_token'),
            'sao_iguais' => $request->header('asaas-access-token') === config('services.asaas.webhook_token'),
        ]);
    }
}
