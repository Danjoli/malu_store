@extends('layouts.app')

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

            <form action="{{ isset($address)
                ? route('addresses.update', $address->id)
                : route('addresses.store') }}"
                method="POST">

                @csrf

                @if(isset($address))
                    @method('PUT')
                @endif

                <!-- Rótulo -->
                <div class="mb-4">
                    <label class="block mb-1">Identificação do Endereço</label>
                    <input type="text" name="label"
                        placeholder="Ex: Casa, Trabalho"
                        value="{{ old('label', $address->label ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Nome -->
                <div class="mb-4">
                    <label class="block mb-1">Nome do Destinatário</label>
                    <input type="text" name="recipient_name" required
                        value="{{ old('recipient_name', $address->recipient_name ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Telefone -->
                <div class="mb-4">
                    <label class="block mb-1">Telefone</label>
                    <input type="text" name="phone"
                        value="{{ old('phone', $address->phone ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Rua -->
                <div class="mb-4">
                    <label class="block mb-1">Rua</label>
                    <input type="text" name="street" required
                        value="{{ old('street', $address->street ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Número -->
                <div class="mb-4">
                    <label class="block mb-1">Número</label>
                    <input type="text" name="number" required
                        value="{{ old('number', $address->number ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Complemento -->
                <div class="mb-4">
                    <label class="block mb-1">Complemento</label>
                    <input type="text" name="complement"
                        value="{{ old('complement', $address->complement ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Bairro -->
                <div class="mb-4">
                    <label class="block mb-1">Bairro</label>
                    <input type="text" name="neighborhood"
                        value="{{ old('neighborhood', $address->neighborhood ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Cidade -->
                <div class="mb-4">
                    <label class="block mb-1">Cidade</label>
                    <input type="text" name="city" required
                        value="{{ old('city', $address->city ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label class="block mb-1">Estado</label>
                    <input type="text" name="state" maxlength="2" required
                        placeholder="SP"
                        value="{{ old('state', $address->state ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- CEP -->
                <div class="mb-4">
                    <label class="block mb-1">CEP</label>
                    <input type="text" name="cep" required
                        value="{{ old('cep', $address->cep ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <!-- Endereço padrão -->
                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox"
                        name="is_default"
                        value="1"
                        {{ old('is_default') !== null
                            ? (old('is_default') ? 'checked' : '')
                            : (($address->is_default ?? false) ? 'checked' : '') }}>

                    <label>Definir como endereço padrão</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                    Salvar Endereço
                </button>
            </form>

        </div>

        <!-- RESUMO DO PEDIDO -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">
                Resumo do Pedido
            </h2>

            {{-- LISTA DE PRODUTOS --}}
            @foreach ($cart->items as $item)
                <div class="flex justify-between items-start mb-4">

                    <div class="flex gap-3">

                        {{-- IMAGEM --}}
                        <img
                            src="{{ asset('storage/' . $item->image_snapshot) }}"
                            alt="{{ $item->name_snapshot }}"
                            class="w-16 h-16 object-cover rounded-lg border"
                        >

                        {{-- INFORMAÇÕES --}}
                        <div>
                            <p class="font-medium">
                                {{ $item->name_snapshot }}
                            </p>

                            <p class="text-sm text-gray-500">
                                Qtd: {{ $item->quantity }}
                                @if($item->color_snapshot)
                                    • Cor: {{ $item->color_snapshot }}
                                @endif
                                @if($item->size_snapshot)
                                    • Tam: {{ $item->size_snapshot }}
                                @endif
                            </p>
                        </div>

                    </div>

                    {{-- PREÇO --}}
                    <span class="font-medium">
                        R$ {{ number_format($item->total, 2, ',', '.') }}
                    </span>

                </div>
            @endforeach

            {{-- FRETE --}}
            <div class="flex justify-between mb-2 mt-4">
                <span>Frete</span>
                <span>R$ {{ number_format($shipping, 2, ',', '.') }}</span>
            </div>

            <hr class="my-4">

            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
            </div>

            @if($hasAddress)

                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <button
                        class="block w-full mt-6 text-center bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
                        Finalizar Pedido
                    </button>
                </form>

            @else

                <button disabled
                    class="w-full mt-6 bg-gray-400 text-white py-3 rounded-lg cursor-not-allowed">
                    Finalizar Pedido
                </button>

                <p class="text-red-500 mt-3 text-sm">
                    Você precisa cadastrar um endereço antes de finalizar a compra.
                </p>

            @endif

            <p id="mensagem" class="text-green-600 mt-4 hidden">
                Pedido realizado com sucesso!
            </p>

        </div>

    </div>

</div>

@endsection


@push('scripts')
<script>
function finalizarCompra() {

    const msg = document.getElementById('mensagem');

    msg.classList.remove('hidden');

}
</script>
@endpush
