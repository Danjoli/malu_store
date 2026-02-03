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
        <aside class="w-64 bg-gray-800 text-white p-5">
            <h1 class="text-2xl font-bold mb-6">Admin Panel</h1>
            <nav>
                <ul>
                    <li class="mb-3"><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300">Dashboard</a></li>
                    <li class="mb-3"><a href="#" class="hover:text-gray-300">Clientes</a></li>
                    <li class="mb-3"><a href="#" class="hover:text-gray-300">Admins</a></li>
                    <li class="mb-3"><a href="#" class="hover:text-gray-300">Produtos</a></li>
                    <li class="mb-3"><a href="#" class="hover:text-gray-300">Categorias</a></li>
                    <li class="mb-3"><a href="#" class="hover:text-gray-300">Pedidos</a></li>
                    <li class="mb-3"><a href="#" class="hover:text-gray-300">Envios</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Conteúdo principal -->
        <main class="flex-1 p-10">
            @yield('content')
        </main>
    </div>
</body>
</html>
