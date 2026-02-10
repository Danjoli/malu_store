@extends('layouts.admin')

@section('title', 'Editar Admin')

@section('content')

<a href="{{ route('admin.admins.index') }}"
   class="inline-block mb-4 text-sm text-blue-600 hover:underline">
    ← Voltar para administradores
</a>

<h1 class="text-3xl font-bold mb-6">Editar Administrador</h1>

<div class="bg-white p-6 rounded shadow max-w-xl">
    <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="space-y-4">
        @method('PUT')
        @include('admin.admins.form')

        <div class="flex justify-between items-center pt-2">
            <a href="{{ route('admin.admins.index') }}"
               class="text-gray-600 hover:text-gray-900">
                Cancelar
            </a>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection
