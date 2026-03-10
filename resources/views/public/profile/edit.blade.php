@extends('layouts.app')

@section('title', 'Meu Perfil')

@section('content')

<div class="container mx-auto max-w-6xl py-10">

```
<h1 class="text-3xl font-bold text-pink-600 mb-10">
    Meu Perfil
</h1>


<div class="grid md:grid-cols-2 gap-10">


    <!-- ================================= -->
    <!-- EDITAR CONTA -->
    <!-- ================================= -->

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-6">
            Editar Conta
        </h2>

        <form method="POST" action="{{ route('profile.update') }}">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="text-sm text-gray-600">Nome</label>

                <input
                    type="text"
                    name="name"
                    value="{{ $user->name }}"
                    class="w-full border rounded p-2 mt-1"
                >
            </div>

            <div class="mb-4">
                <label class="text-sm text-gray-600">Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ $user->email }}"
                    class="w-full border rounded p-2 mt-1"
                >
            </div>

            <div class="mb-4">
                <label class="text-sm text-gray-600">Telefone</label>

                <input
                    type="text"
                    name="phone"
                    value="{{ $user->phone }}"
                    class="w-full border rounded p-2 mt-1"
                >
            </div>

            <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded">
                Salvar Alterações
            </button>

        </form>



        <!-- ================================= -->
        <!-- ALTERAR SENHA -->
        <!-- ================================= -->

        <div class="mt-10">

            <h2 class="text-xl font-semibold mb-6">
                Alterar Senha
            </h2>

            <form method="POST" action="{{ route('profile.password.update') }}">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="text-sm text-gray-600">Senha Atual</label>

                    <input
                        type="password"
                        name="current_password"
                        class="w-full border rounded p-2 mt-1"
                    >
                </div>

                <div class="mb-4">
                    <label class="text-sm text-gray-600">Nova Senha</label>

                    <input
                        type="password"
                        name="password"
                        class="w-full border rounded p-2 mt-1"
                    >
                </div>

                <div class="mb-4">
                    <label class="text-sm text-gray-600">
                        Confirmar Nova Senha
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full border rounded p-2 mt-1"
                    >
                </div>

                <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded">
                    Atualizar Senha
                </button>

            </form>

        </div>

    </div>



    <!-- ================================= -->
    <!-- ENDEREÇOS -->
    <!-- ================================= -->

    <div class="bg-white p-6 rounded-xl shadow">

        <h2 class="text-xl font-semibold mb-6">
            Meus Endereços
        </h2>


        @forelse($addresses as $address)

        <div class="border rounded-lg p-4 mb-4">

            <div class="font-semibold text-gray-800">
                {{ $address->label }}
            </div>

            <p class="text-sm text-gray-600">
                {{ $address->street }}, {{ $address->number }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $address->neighborhood }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $address->city }} - {{ $address->state }}
            </p>

            <p class="text-sm text-gray-600">
                CEP: {{ $address->cep }}
            </p>


            <form
                method="POST"
                action="{{ route('profile.address.delete', $address->id) }}"
                class="mt-3"
            >

                @csrf
                @method('DELETE')

                <button class="text-red-500 text-sm hover:underline">
                    Excluir endereço
                </button>

            </form>

        </div>

        @empty

        <p class="text-gray-500 mb-4">
            Nenhum endereço cadastrado.
        </p>

        @endforelse



        <!-- ================================= -->
        <!-- NOVO ENDEREÇO -->
        <!-- ================================= -->

        <h3 class="font-semibold mt-6 mb-4">
            Adicionar novo endereço
        </h3>


        <form method="POST" action="{{ route('profile.address.store') }}">

            @csrf

            <div class="grid grid-cols-2 gap-3">

                <input
                    name="label"
                    placeholder="Casa / Trabalho"
                    class="border p-2 rounded"
                >

                <input
                    name="recipient_name"
                    placeholder="Nome do destinatário"
                    class="border p-2 rounded"
                >

                <input
                    name="phone"
                    placeholder="Telefone"
                    class="border p-2 rounded"
                >

                <input
                    name="cep"
                    placeholder="CEP"
                    class="border p-2 rounded"
                >

                <input
                    name="street"
                    placeholder="Rua"
                    class="border p-2 rounded"
                >

                <input
                    name="number"
                    placeholder="Número"
                    class="border p-2 rounded"
                >

                <input
                    name="neighborhood"
                    placeholder="Bairro"
                    class="border p-2 rounded"
                >

                <input
                    name="city"
                    placeholder="Cidade"
                    class="border p-2 rounded"
                >

                <input
                    name="state"
                    placeholder="Estado"
                    class="border p-2 rounded"
                >

                <input
                    name="complement"
                    placeholder="Complemento"
                    class="border p-2 rounded"
                >

            </div>

            <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded mt-4">
                Salvar Endereço
            </button>

        </form>

    </div>

</div>
```

</div>

@endsection
