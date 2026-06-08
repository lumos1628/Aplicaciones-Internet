<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Finanzas') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body { font-family: 'Inter', sans-serif; }
            </style>
        @endif
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex flex-col">
            @if (Route::has('login'))
                <header class="px-6 py-4">
                    <div class="max-w-6xl mx-auto flex items-center justify-between">
                        <a href="/" class="text-xl font-bold text-slate-800 tracking-tight">Finanzas</a>
                        <nav class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-slate-800 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-800 transition">Iniciar sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 rounded-lg bg-slate-700 text-white hover:bg-slate-800 transition">Registrarse</a>
                                @endif
                            @endauth
                        </nav>
                    </div>
                </header>
            @endif

            <main class="flex-1">
                <section class="max-w-6xl mx-auto px-6 pt-20 pb-16 text-center">
                    <h1 class="text-4xl sm:text-5xl font-bold text-slate-800 leading-tight tracking-tight">
                        Controla tus finanzas personales
                    </h1>
                    <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                        Registra y organiza tus ingresos y gastos de forma sencilla. Mantén un control claro de tu dinero y toma mejores decisiones financieras.
                    </p>
                    @guest
                        @if (Route::has('register'))
                            <div class="mt-8">
                                <a href="{{ route('register') }}" class="inline-block px-8 py-3 rounded-lg bg-slate-700 text-white font-medium hover:bg-slate-800 transition shadow-sm">
                                    Comienza ahora
                                </a>
                            </div>
                        @endif
                    @endguest
                </section>

                <section class="max-w-6xl mx-auto px-6 pb-24">
                    <div class="grid sm:grid-cols-3 gap-6">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
                            <div class="w-12 h-12 mx-auto rounded-lg bg-slate-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-slate-800">Consumidores</h3>
                            <p class="mt-2 text-sm text-gray-500">Administra las personas asociadas a tus finanzas y organiza mejor tus registros.</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
                            <div class="w-12 h-12 mx-auto rounded-lg bg-emerald-50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-slate-800">Ingresos</h3>
                            <p class="mt-2 text-sm text-gray-500">Registra y categoriza todos tus ingresos para tener claridad sobre tu flujo de dinero.</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
                            <div class="w-12 h-12 mx-auto rounded-lg bg-red-50 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-slate-800">Gastos</h3>
                            <p class="mt-2 text-sm text-gray-500">Lleva un control detallado de tus gastos y descubre en qué se va tu dinero.</p>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-gray-200 py-6">
                <div class="max-w-6xl mx-auto px-6 text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Finanzas') }}. Todos los derechos reservados.
                </div>
            </footer>
        </div>
    </body>
</html>
