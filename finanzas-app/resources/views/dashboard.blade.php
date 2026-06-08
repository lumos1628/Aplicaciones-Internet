<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Ingresos</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">S/ {{ number_format($totalIngresos, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Gastos</p>
                        <p class="text-2xl font-bold text-red-600 mt-1">S/ {{ number_format($totalGastos, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Balance</p>
                        <p class="text-2xl font-bold mt-1 {{ $balance < 0 ? 'text-red-600' : 'text-slate-800' }}">S/ {{ number_format($balance, 2) }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Consumidores</p>
                        <p class="text-2xl font-bold text-slate-800 mt-1">{{ $consumidoresCount }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-5 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-slate-800">Últimos Ingresos</h3>
                </div>
                <div class="p-5">
                    @if ($ultimosIngresos->count())
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 border-b border-gray-100">
                                    <th class="pb-2 font-medium">Consumidor</th>
                                    <th class="pb-2 font-medium">Monto</th>
                                    <th class="pb-2 font-medium">Fecha</th>
                                    <th class="pb-2 font-medium hidden sm:table-cell">Descripción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($ultimosIngresos as $ingreso)
                                    <tr>
                                        <td class="py-2 text-slate-700">{{ $ingreso->consumidor->nombre }}</td>
                                        <td class="py-2 text-emerald-600 font-medium">S/ {{ number_format($ingreso->monto, 2) }}</td>
                                        <td class="py-2 text-gray-500">{{ $ingreso->fecha }}</td>
                                        <td class="py-2 text-gray-500 hidden sm:table-cell">{{ $ingreso->descripcion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-sm text-gray-500">No hay ingresos registrados.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-5 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-slate-800">Últimos Gastos</h3>
                </div>
                <div class="p-5">
                    @if ($ultimosGastos->count())
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-500 border-b border-gray-100">
                                    <th class="pb-2 font-medium">Consumidor</th>
                                    <th class="pb-2 font-medium">Monto</th>
                                    <th class="pb-2 font-medium">Fecha</th>
                                    <th class="pb-2 font-medium hidden sm:table-cell">Categoría</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($ultimosGastos as $gasto)
                                    <tr>
                                        <td class="py-2 text-slate-700">{{ $gasto->consumidor->nombre }}</td>
                                        <td class="py-2 text-red-600 font-medium">S/ {{ number_format($gasto->monto, 2) }}</td>
                                        <td class="py-2 text-gray-500">{{ $gasto->fecha }}</td>
                                        <td class="py-2 hidden sm:table-cell">
                                            <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-700">{{ $gasto->categoria }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-sm text-gray-500">No hay gastos registrados.</p>
                    @endif
                </div>
            </div>
        </div>

        @if ($gastosPorCategoria->count())
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-5 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-slate-800">Gastos por Categoría</h3>
                </div>
                <div class="p-5 space-y-4">
                    @php $maxTotal = $gastosPorCategoria->max('total'); @endphp
                    @foreach ($gastosPorCategoria as $cat)
                        @php
                            $width = $totalPorCategoria > 0 ? ($cat->total / $totalPorCategoria) * 100 : 0;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="font-medium text-slate-700">{{ $cat->categoria }}</span>
                                <span class="text-gray-500">S/ {{ number_format($cat->total, 2) }}</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-slate-500 rounded-full transition-all" style="width: {{ $width }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row gap-3 pb-8">
            <a href="{{ route('ingresos.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-slate-700 text-white font-medium text-sm hover:bg-slate-800 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                + Nuevo Ingreso
            </a>
            <a href="{{ route('gastos.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-slate-700 text-white font-medium text-sm hover:bg-slate-800 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                + Nuevo Gasto
            </a>
        </div>
    </div>
</x-app-layout>
