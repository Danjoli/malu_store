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

            <form>

                <div class="mb-4">
                    <label class="block mb-1">Nome completo</label>
                    <input type="text"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Email</label>
                    <input type="email"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Endereço</label>
                    <input type="text"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Cidade</label>
                    <input type="text"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1">CEP</label>
                    <input type="text"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

            </form>

        </div>

        <!-- RESUMO DO PEDIDO -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h2 class="text-xl font-semibold mb-4">
                Resumo do Pedido
            </h2>

            <div class="flex justify-between mb-2">
                <span>Produto exemplo</span>
                <span>R$ 99,90</span>
            </div>

            <div class="flex justify-between mb-2">
                <span>Frete</span>
                <span>R$ 15,00</span>
            </div>

            <hr class="my-4">

            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span>R$ 114,90</span>
            </div>

            <button onclick="finalizarCompra()"
                class="w-full mt-6 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
                <a href="{{ route('payment') }}">Finalizar Pedido</a>
            </button>

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
