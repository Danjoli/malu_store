@extends('layouts.app')

@section('title', 'Loja')

@section('content')
    <div class="container mx-auto px-4 py-10">

        <h1 class="text-4xl font-bold mb-8 text-center">Nossos Produtos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- IMAGEM --}}
                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.C1qfDyEHiU_tuo1zGHP_PgAAAA?cb=defcache2&defcache=1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Roupa de exemplo" class="h-full w-full object-cover">
                </div>

                {{-- CONTEÚDO --}}
                <div class="p-4 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold mb-2">
                        Roupa teste
                    </h2>

                    {{-- ESTOQUE --}}
                    <span class="text-green-600 text-sm font-medium mb-2">✔ Em estoque</span>

                    {{-- PREÇO --}}
                    <p class="text-2xl font-bold text-blue-600 mt-auto">R$ {{ number_format(100.50, 2, ',', '.') }}</p>

                    <a href="{{ route('product.show', 1) }}" class="mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition">
                        Ver Produto
                    </a>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- IMAGEM --}}
                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.C1qfDyEHiU_tuo1zGHP_PgAAAA?cb=defcache2&defcache=1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Roupa de exemplo" class="h-full w-full object-cover">
                </div>

                {{-- CONTEÚDO --}}
                <div class="p-4 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold mb-2">
                        Roupa teste
                    </h2>

                    {{-- ESTOQUE --}}
                    <span class="text-green-600 text-sm font-medium mb-2">✔ Em estoque</span>

                    {{-- PREÇO --}}
                    <p class="text-2xl font-bold text-blue-600 mt-auto">R$ {{ number_format(100.50, 2, ',', '.') }}</p>

                    <a href="{{ route('product.show', 1) }}" class="mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition">
                        Ver Produto
                    </a>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- IMAGEM --}}
                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.C1qfDyEHiU_tuo1zGHP_PgAAAA?cb=defcache2&defcache=1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Roupa de exemplo" class="h-full w-full object-cover">
                </div>

                {{-- CONTEÚDO --}}
                <div class="p-4 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold mb-2">
                        Roupa teste
                    </h2>

                    {{-- ESTOQUE --}}
                    <span class="text-green-600 text-sm font-medium mb-2">✔ Em estoque</span>

                    {{-- PREÇO --}}
                    <p class="text-2xl font-bold text-blue-600 mt-auto">R$ {{ number_format(100.50, 2, ',', '.') }}</p>

                    <a href="{{ route('product.show', 1) }}" class="mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition">
                        Ver Produto
                    </a>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">

                {{-- IMAGEM --}}
                <div class="h-56 bg-gray-100 flex items-center justify-center">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.C1qfDyEHiU_tuo1zGHP_PgAAAA?cb=defcache2&defcache=1&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Roupa de exemplo" class="h-full w-full object-cover">
                </div>

                {{-- CONTEÚDO --}}
                <div class="p-4 flex flex-col flex-1">
                    <h2 class="text-lg font-semibold mb-2">
                        Roupa teste
                    </h2>

                    {{-- ESTOQUE --}}
                    <span class="text-green-600 text-sm font-medium mb-2">✔ Em estoque</span>

                    {{-- PREÇO --}}
                    <p class="text-2xl font-bold text-blue-600 mt-auto">R$ {{ number_format(100.50, 2, ',', '.') }}</p>

                    <a href="{{ route('product.show', 1) }}" class="mt-4 bg-blue-600 text-white text-center py-2 rounded hover:bg-blue-700 transition">
                        Ver Produto
                    </a>
                </div>

            </div>

        </div>

    </div>
@endsection
