<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-5 flex flex-col justify-between">

            <div>
                <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>

                <nav>
                    <ul>
                        <li class="mb-3"><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a></li>
                        <li class="mb-3"><a href="{{ route('admin.clients.index') }}" class="hover:text-gray-300">Clientes</a></li>
                        <li class="mb-3"><a href="{{ route('admin.admins.index') }}" class="hover:text-gray-300">Admins</a></li>
                        <li class="mb-3"><a href="{{ route('admin.categories.index') }}" class="hover:text-gray-300">Categorias</a></li>
                        {{-- <li class="mb-3"><a href="#" class="hover:text-gray-300">Produtos</a></li>
                        <li class="mb-3"><a href="#" class="hover:text-gray-300">Pedidos</a></li>
                        <li class="mb-3"><a href="#" class="hover:text-gray-300">Envios</a></li>  --}}
                    </ul>
                </nav>
            </div>

            <!-- Área inferior da sidebar -->
            <div class="mt-10 border-t border-gray-700 pt-4">

                <p class="text-sm text-gray-400 mb-2">
                    Logado como:
                    <span class="font-semibold text-white">
                        {{ auth('admin')->user()->name ?? 'Admin' }}
                    </span>
                </p>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded transition">
                        Sair
                    </button>
                </form>

            </div>
        </aside>

        <!-- Conteúdo principal -->
        <main class="flex-1 p-10">
            @yield('content')
        </main>
    </div>
</body>
</html>
