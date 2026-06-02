<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Consumidor
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">

            <div class="mb-4">
                <span class="font-medium text-gray-700">Nombre:</span>
                <span class="ml-2">{{ $consumidor->nombre }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Email:</span>
                <span class="ml-2">{{ $consumidor->email }}</span>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Ingresos</h3>
                @forelse($consumidor->ingresos as $ingreso)
                    <div class="border rounded p-2 mb-2 text-sm">
                        <span class="text-green-600 font-medium">S/ {{ $ingreso->monto }}</span>
                        — {{ $ingreso->descripcion }}
                        <span class="text-gray-400">({{ $ingreso->fecha }})</span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Sin ingresos registrados.</p>
                @endforelse
            </div>

            <div class="mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Gastos</h3>
                @forelse($consumidor->gastos as $gasto)
                    <div class="border rounded p-2 mb-2 text-sm">
                        <span class="text-red-600 font-medium">S/ {{ $gasto->monto }}</span>
                        — {{ $gasto->descripcion }}
                        <span class="text-gray-400">({{ $gasto->fecha }})</span>
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded ml-1">{{ $gasto->categoria }}</span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Sin gastos registrados.</p>
                @endforelse
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('consumidores.edit', $consumidor) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar
                </a>
                <a href="{{ route('consumidores.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>