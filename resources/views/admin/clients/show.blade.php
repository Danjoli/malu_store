@extends('admin.layouts.app')

@section('title', 'Detalhes do Administrador')

@section('content')
<h1 class="text-3xl font-bold mb-6">Detalhes do Cliente</h1>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl space-y-6">

    {{-- ID --}}
    <div>
        <p class="text-sm text-gray-500">ID</p>
        <p class="text-lg font-semibold">{{ $user->id }}</p>
    </div>

    {{-- Nome --}}
    <div>
        <p class="text-sm text-gray-500">Nome</p>
        <p class="text-lg font-semibold">{{ $user->name }}</p>
    </div>

    {{-- Email --}}
    <div>
        <p class="text-sm text-gray-500">Email</p>
        <p class="text-lg font-semibold">{{ $user->email }}</p>
    </div>

    {{-- Senha --}}
    <div>
        <p class="text-sm text-gray-500">Senha</p>
        <p class="text-lg font-semibold">{{ $user->password }}</p>
    </div>

    {{-- Telêfone --}}
    <div>
        <p class="text-sm text-gray-500">Telêfone</p>
        <p class="text-lg font-semibold">{{ $user->phone }}</p>
    </div>


    {{-- Datas --}}
    <div class="grid grid-cols-2 gap-4 pt-4 border-t">
        <div>
            <p class="text-sm text-gray-500">Criado em</p>
            <p class="font-medium">
                {{ optional($user->created_at)->format('d/m/Y H:i') ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Última atualização</p>
            <p class="font-medium">
                {{ optional($user->updated_at)->format('d/m/Y H:i') ?? '—' }}
            </p>
        </div>
    </div>

    {{-- ENDEREÇOS --}}
    @if($user->addresses->count())
        <div class="pt-6 border-t">
            <h2 class="text-xl font-bold mb-4">Endereço(s)</h2>

            @foreach($user->addresses as $address)
                <div class="bg-gray-50 p-4 rounded mb-3 border">
                    <p><strong>Rua:</strong> {{ $address->street }}, {{ $address->number }}</p>
                    <p><strong>Bairro:</strong> {{ $address->neighborhood }}</p>
                    <p><strong>Cidade:</strong> {{ $address->city }} - {{ $address->state }}</p>
                    <p><strong>CEP:</strong> {{ $address->zip_code }}</p>
                </div>
            @endforeach
        </div>
    @endif

    {{-- BOTÕES --}}
    <div class="flex justify-between items-center pt-6 border-t">
        <a href="{{ route('admin.clients.index') }}"
           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            Voltar
        </a>
    </div>

</div>
@endsection
