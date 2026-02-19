@extends('layouts.app')

@section('title', 'Produto teste')

@section('content')

<div class="container mx-auto px-4 py-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- GALERIA --}}
        <div>
            <div class="bg-white rounded-xl shadow p-4">
                <img src="https://tse1.mm.bing.net/th/id/OIP.C1qfDyEHiU_tuo1zGHP_PgAAAA?cb=defcache2&defcache=1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Roupa teste">
            </div>
        </div>

        {{-- INFORMAÇÕES --}}
        <div class="bg-white rounded-xl shadow p-6 flex flex-col">

            <p>Id {{ $id }}</p> {{-- Só para testar --}}

            <h1 class="text-3xl font-bold mb-2">Roupa teste</h1>

            <p class="text-gray-500 mb-4">Descrição da roupa</p>

            <span class="text-green-600 font-semibold mb-3">✔ Em estoque</span>

            <div class="text-4xl font-bold text-blue-600 mb-6">
                R$ {{ number_format(100.50, 2, ',', '.') }}
            </div>

            {{-- VARIAÇÕES (TAMANHO / COR) --}}
            <label for="">Escolha a variação:</label>
            <select name="" id="">
                <option value="">disponíveis</option>
            </select>

            <button onclick="addToCart()" class="bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition mt-auto">
                🛒 Adicionar ao carrinho
            </button>
        </div>
    </div>
</div>

<script>
function addToCart() {
    alert("🛒 Produto adicionado ao carrinho!");
}
</script>

@endsection
