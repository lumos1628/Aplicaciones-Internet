<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Gasto
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">

            <div class="mb-4">
                <span class="font-medium text-gray-700">Consumidor:</span>
                <span class="ml-2">{{ $gasto->consumidor->nombre }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Monto:</span>
                <span class="ml-2 text-red-600 font-semibold">S/ {{ $gasto->monto }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Fecha:</span>
                <span class="ml-2">{{ $gasto->fecha }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Categoría:</span>
                <span class="ml-2 bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">
                    {{ $gasto->categoria }}
                </span>
            </div>

            <div class="mb-6">
                <span class="font-medium text-gray-700">Descripción:</span>
                <span class="ml-2">{{ $gasto->descripcion }}</span>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('gastos.edit', $gasto) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar
                </a>
                <a href="{{ route('gastos.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>