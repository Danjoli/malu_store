@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-6">Bem-vindo ao Painel Administrativo</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow text-center">
        <h2 class="text-xl font-bold">Produtos</h2>
        <p class="text-gray-600 mt-2">Total de produtos cadastrados</p>
    </div>
    <div class="bg-white p-6 rounded shadow text-center">
        <h2 class="text-xl font-bold">Pedidos</h2>
        <p class="text-gray-600 mt-2">Total de pedidos recebidos</p>
    </div>
    <div class="bg-white p-6 rounded shadow text-center">
        <h2 class="text-xl font-bold">Clientes</h2>
        <p class="text-gray-600 mt-2">Total de clientes cadastrados</p>
    </div>
</div>
@endsection
