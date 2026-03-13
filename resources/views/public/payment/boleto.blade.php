@extends('layouts.payment')

@section('title', 'Pagamento via boleto')

@section('content')

<div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-8 text-center">

    <h2 class="text-2xl font-semibold mb-2">
        Pagamento via Boleto
    </h2>

    <p class="text-gray-500 mb-6">
        Pedido #{{ $order->id }}
    </p>

    <div class="bg-gray-50 p-6 rounded-lg mb-6">

        <p class="text-gray-700 mb-4">
            Seu boleto foi gerado com sucesso
        </p>

        <a
            href="{{ $boleto_url }}"
            target="_blank"
            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-lg transition"
        >
            Visualizar Boleto
        </a>

    </div>

    <div class="text-left text-sm text-gray-600 space-y-2">

        <p>
            • Você pode pagar o boleto em qualquer banco, aplicativo bancário ou lotérica.
        </p>

        <p>
            • A confirmação do pagamento pode levar até <strong>2 dias úteis</strong>.
        </p>

        <p>
            • Após a confirmação, seu pedido será processado automaticamente.
        </p>

    </div>

    <p class="text-gray-500 text-sm mt-6">
        Caso tenha dúvidas, entre em contato com nosso suporte.
    </p>

</div>

@endsection
