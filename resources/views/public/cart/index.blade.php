@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<div class="container mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold mb-8">Seu Carrinho</h1>


    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-100 text-sm text-gray-600">
                <tr>
                    <th class="p-4">Produto</th>
                    <th class="p-4">Preço</th>
                    <th class="p-4">Quantidade</th>
                    <th class="p-4">Subtotal</th>
                    <th class="p-4"></th>
                </tr>
            </thead>

            <tbody>
                <tr class="border-t">
                    <td class="p-4 flex items-center gap-4">
                        <img src="https://tse1.mm.bing.net/th/id/OIP.C1qfDyEHiU_tuo1zGHP_PgAAAA?cb=defcache2&defcache=1&rs=1&pid=ImgDetMain&o=7&rm=3"
                                class="w-16 h-16 object-cover rounded-lg">
                        <span>Teste</span>
                    </td>

                    <td class="p-4">
                        R$ {{ number_format(100.50, 2, ',', '.') }}
                    </td>

                    <td class="p-4">
                        <input type="number"
                                value=100
                                min="1"
                                class="quantity w-20 border rounded px-2 py-1">
                    </td>

                    <td class="p-4 subtotal">
                        R$ {{ number_format(50, 2, ',', '.') }}
                    </td>

                    <td class="p-4">
                        <button class="remove text-red-600 hover:underline">
                            Remover
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Total --}}
    <div class="mt-8 flex justify-end">
        <div class="bg-white p-6 rounded-xl shadow-sm w-80">
            <div class="flex justify-between mb-4">
                <span class="font-medium">Total:</span>
                <span id="cartTotal" class="font-bold text-lg">
                    R$ {{ number_format(100, 2, ',', '.') }}
                </span>
            </div>

            <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                <a href="{{ route('checkout') }}">
                    Finalizar Compra
                </a>
            </button>
        </div>
    </div>

</div>
@endsection



