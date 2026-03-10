<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title') - Malu Store</title>
</head>
<body class="bg-gray-50">
    {{-- HEADER --}}
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold text-blue-600 tracking-tight">
                Malu Store
            </a>
            <nav class="space-x-6 text-sm font-medium">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition">
                    Loja
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                    Carrinho
                </a>

                @auth

                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-blue-600">
                        Editar conta
                    </a>

                    <a href="{{ route('profile.orders') }}" class="text-gray-700 hover:text-blue-600">
                        Ver pedidos
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="text-gray-700 hover:text-red-600">
                            Sair
                        </button>
                    </form>

                @else

                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">
                        Login
                    </a>

                @endauth

            </nav>
        </div>
    </header>

    {{-- CONTEÚDO --}}
    <main class="min-h-screen">

        {{-- MENSAGENS --}}
        <div class="container mx-auto px-4 pt-6">
            @include('includes.messages')
        </div>

        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t mt-16">
        <div class="container mx-auto px-6 py-8 grid md:grid-cols-3 gap-8 text-sm text-gray-600">

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Malu Store</h3>
                <p>Sua loja online de confiança, com qualidade e estilo.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Links Úteis</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="hover:text-blue-600">Loja</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600">Política de Troca</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-blue-600">Termos de Uso</a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Contato</h3>
                <p>Email: contato@malustore.com</p>
                <p>WhatsApp: (11) 99999-9999</p>
            </div>
        </div>

        <div class="text-center text-xs text-gray-400 py-4 border-t">
            © {{ date('Y') }} Malu Store — Todos os direitos reservados
        </div>
    </footer>

@stack('scripts')

<script>

    setTimeout(() => {

        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(alert => {

            alert.style.transition = "opacity 0.5s ease";

            alert.style.opacity = "0";

            setTimeout(() => alert.remove(), 500);

        });

    }, 3000);

</script>

</body>
</html>
