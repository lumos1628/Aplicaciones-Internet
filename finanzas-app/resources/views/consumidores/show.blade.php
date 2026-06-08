<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Consumidor: {{ $consumidor->nombre }}</h1>

        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <div class="mb-4">
                <span class="font-medium text-gray-700">Nombre:</span>
                <span class="ml-2">{{ $consumidor->nombre }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Email:</span>
                <span class="ml-2">{{ $consumidor->email }}</span>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Ingresos</h2>
            @forelse($consumidor->ingresos as $ingreso)
                <div class="border rounded-lg p-3 mb-2 text-sm flex items-center gap-2">
                    <span class="text-emerald-600 font-medium">S/ {{ $ingreso->monto }}</span>
                    <span class="text-gray-500">—</span>
                    <span>{{ $ingreso->descripcion }}</span>
                    <span class="text-gray-400 ml-auto">{{ $ingreso->fecha }}</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Sin ingresos registrados.</p>
            @endforelse
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Gastos</h2>
            @forelse($consumidor->gastos as $gasto)
                <div class="border rounded-lg p-3 mb-2 text-sm flex items-center gap-2">
                    <span class="text-red-600 font-medium">S/ {{ $gasto->monto }}</span>
                    <span class="text-gray-500">—</span>
                    <span>{{ $gasto->descripcion }}</span>
                    <span class="text-gray-400">{{ $gasto->fecha }}</span>
                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full ml-auto">{{ $gasto->categoria }}</span>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Sin gastos registrados.</p>
            @endforelse
        </div>

        <div class="flex space-x-2">
            <a href="{{ route('consumidores.edit', $consumidor) }}"
               class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 text-sm font-medium">
                Editar
            </a>
            <a href="{{ route('consumidores.index') }}"
               class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm font-medium">
                Volver
            </a>
        </div>
    </div>
</x-app-layout>
