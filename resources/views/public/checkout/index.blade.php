@extends('layouts.public.app')

@section('title', 'Checkout')

@section('content')

<div class="max-w-6xl mx-auto px-6 py-10">

<h1 class="text-3xl font-bold mb-8 tracking-tight">
    Finalizar Compra
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- FORMULÁRIO -->
    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-4">
            Informações de Entrega
        </h2>

        <form
            id="checkout-form"
            action="{{ route('checkout.process') }}"
            method="POST"
        >

            @csrf

            <!-- ====================================================== -->
            <!-- ENDEREÇO SALVO -->
            <!-- ====================================================== -->

            <div class="mb-6">

                <label
                    for="address_id"
                    class="block mb-2 font-semibold"
                >
                    Endereço de entrega
                </label>

                <select
                    name="address_id"
                    id="address_id"
                    class="w-full border rounded-lg px-4 py-2"
                >

                    <option value="">
                        Usar um novo endereço
                    </option>

                    @foreach ($addresses as $savedAddress)

                        <option
                            value="{{ $savedAddress->id }}"
                            {{ ($address?->id === $savedAddress->id) ? 'selected' : '' }}
                        >
                            {{ $savedAddress->label
                                ? $savedAddress->label . ' - '
                                : ''
                            }}

                            {{ $savedAddress->street }},
                            {{ $savedAddress->number }}
                            -
                            {{ $savedAddress->city }}/{{ $savedAddress->state }}
                            -
                            {{ $savedAddress->cep }}
                        </option>

                    @endforeach

                </select>

                @if ($addresses->isEmpty())

                    <p class="text-sm text-gray-500 mt-2">
                        Você ainda não possui endereços salvos.
                    </p>

                @endif

            </div>


            <!-- ====================================================== -->
            <!-- CEP -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    CEP
                </label>

                <input
                    type="text"
                    name="cep"
                    id="cep"
                    value="{{ old('cep', $address->cep ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- BOTÃO FRETE -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <button
                    type="button"
                    id="btn-calcular-frete"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg"
                >
                    Calcular Frete
                </button>

            </div>


            <!-- ====================================================== -->
            <!-- FRETES -->
            <!-- ====================================================== -->

            <div
                id="fretes-container"
                class="mb-4 hidden"
            >

                <label class="block mb-2 font-semibold">
                    Escolha o Frete
                </label>

                <div
                    id="lista-fretes"
                    class="space-y-2"
                ></div>

            </div>


            <!-- ====================================================== -->
            <!-- CAMPOS HIDDEN DO FRETE -->
            <!-- ====================================================== -->

            <input
                type="hidden"
                name="shipping_cost"
                id="shipping_cost"
            >

            <input
                type="hidden"
                name="carrier"
                id="carrier"
            >

            <input
                type="hidden"
                name="service"
                id="service"
            >


            <!-- ====================================================== -->
            <!-- NOME DO DESTINATÁRIO -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Nome do Destinatário
                </label>

                <input
                    type="text"
                    name="recipient_name"
                    id="recipient_name"
                    value="{{ old('recipient_name', $address->recipient_name ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- TELEFONE -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Telefone
                </label>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $address->phone ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- CPF -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    CPF
                </label>

                <input
                    type="text"
                    name="cpf"
                    id="cpf"
                    value="{{ old('cpf', $address->cpf ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- RUA -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Rua
                </label>

                <input
                    type="text"
                    name="street"
                    id="street"
                    value="{{ old('street', $address->street ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- NÚMERO -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Número
                </label>

                <input
                    type="text"
                    name="number"
                    id="number"
                    value="{{ old('number', $address->number ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- COMPLEMENTO -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Complemento
                </label>

                <input
                    type="text"
                    name="complement"
                    id="complement"
                    value="{{ old('complement', $address->complement ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- BAIRRO -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Bairro
                </label>

                <input
                    type="text"
                    name="neighborhood"
                    id="neighborhood"
                    value="{{ old('neighborhood', $address->neighborhood ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- CIDADE -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Cidade
                </label>

                <input
                    type="text"
                    name="city"
                    id="city"
                    value="{{ old('city', $address->city ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- ESTADO -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Estado
                </label>

                <input
                    type="text"
                    name="state"
                    id="state"
                    maxlength="2"
                    value="{{ old('state', $address->state ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2 uppercase"
                >

            </div>


            <!-- ====================================================== -->
            <!-- LABEL DO ENDEREÇO -->
            <!-- ====================================================== -->

            <div class="mb-4">

                <label class="block mb-1">
                    Nome do endereço
                </label>

                <input
                    type="text"
                    name="label"
                    id="label"
                    placeholder="Ex.: Casa, Trabalho..."
                    value="{{ old('label', $address->label ?? '') }}"
                    class="w-full border rounded-lg px-4 py-2"
                >

            </div>


            <!-- ====================================================== -->
            <!-- ENDEREÇO PADRÃO -->
            <!-- ====================================================== -->

            <div class="mb-4 flex items-center gap-2">

                <input
                    type="checkbox"
                    name="is_default"
                    id="is_default"
                    value="1"
                    {{ old('is_default', $address->is_default ?? false) ? 'checked' : '' }}
                >

                <label for="is_default">
                    Definir como endereço padrão
                </label>

            </div>

        </div>


        <!-- ========================================================== -->
        <!-- RESUMO DO PEDIDO -->
        <!-- ========================================================== -->

        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">
                Resumo do Pedido
            </h2>


            <!-- ITENS -->

            @foreach (($cart?->items ?? []) as $item)

                <div class="flex justify-between mb-4">

                    <span>
                        {{ $item->name_snapshot }}
                        (x{{ $item->quantity }})
                    </span>

                    <span>
                        R$
                        {{ number_format(
                            ($item->price * $item->quantity),
                            2,
                            ',',
                            '.'
                        ) }}
                    </span>

                </div>

            @endforeach


            <!-- FRETE -->

            <div class="flex justify-between mb-2 mt-4">

                <span>
                    Frete
                </span>

                <span id="valor-frete">
                    R$ 0,00
                </span>

            </div>


            <hr class="my-4">


            <!-- TOTAL -->

            <div class="flex justify-between font-bold text-lg mb-6">

                <span>
                    Total
                </span>

                <span id="valor-total">

                    R$
                    {{ number_format(
                        $total ?? 0,
                        2,
                        ',',
                        '.'
                    ) }}

                </span>

            </div>


            <!-- FINALIZAR PEDIDO -->

            <button
                type="submit"
                class="w-full bg-green-600 text-white py-3 rounded-lg"
            >
                Finalizar Pedido
            </button>

        </div>

    </form>

</div>

</div>

@endsection

@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | DADOS DO CHECKOUT
    |--------------------------------------------------------------------------
    */

    window.CHECKOUT_DATA = {
        subtotal: @json($subtotal),
        csrfToken: @json(csrf_token()),
        addresses: @json( $addresses->map(function ($address) { return [ 'id' => $address->id, 'label' => $address->label, 'recipient_name' => $address->recipient_name, 'phone' => $address->phone, 'cpf' => $address->cpf, 'cep' => $address->cep, 'street' => $address->street, 'number' => $address->number, 'complement' => $address->complement, 'neighborhood' => $address->neighborhood, 'city' => $address->city, 'state' => $address->state, 'is_default' => $address->is_default, ]; }) )
    };

</script>

@vite('resources/js/checkout.js')

@endpush
