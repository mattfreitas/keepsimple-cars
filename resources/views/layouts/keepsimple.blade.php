<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>KeepSimple - Cars Tips</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        @isset($script)
            {{ $script }}
        @endif
    </head>
    <body class="antialiased">
        <nav class="border-b py-3">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ url('/') }}" class="font-bold text-xl">KPCars</a>
                <div class="flex space-x-2">
                    <a href="{{ route('tips.create') }}" class="hover:border-gray-300 transition duration-200 rounded px-3 py-1 hover:bg-slate-50 flex space-x-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Adicionar dica</span>
                    </a>

                    <a href="{{ route('accounts.index') }}" class="border border-gray-200 hover:border-gray-300 transition duration-200 rounded px-3 py-1 hover:bg-slate-50 flex space-x-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Minha conta</span>
                    </a>
                </div>
            </div>
        </nav>

        <section class="py-14">
            {{ $slot }}
        </section>
    </body>
</html>
