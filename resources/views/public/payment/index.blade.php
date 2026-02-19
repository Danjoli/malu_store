@extends('layouts.app')

@section('title', 'Pagamento')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-8 tracking-tight">
        Pagamento
    </h1>

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-4">
            Escolha a forma de pagamento
        </h2>

        <div class="space-y-4">

            <!-- Cartão -->
            <label class="flex items-center border p-4 rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="payment" class="mr-3">
                💳 Cartão de Crédito
            </label>

            <!-- Pix -->
            <label class="flex items-center border p-4 rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="payment" class="mr-3">
                ⚡ Pix
            </label>

            <!-- Boleto -->
            <label class="flex items-center border p-4 rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="payment" class="mr-3">
                📄 Boleto
            </label>

        </div>

        <a href="{{ route('order.success') }}"
           class="block text-center mt-6 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
           Confirmar Pagamento
        </a>

    </div>

</div>

@endsection
