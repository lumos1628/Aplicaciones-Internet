<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Gasto
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm p-6">

            <div class="mb-4">
                <span class="font-medium text-gray-700 text-sm">Consumidor:</span>
                <span class="ml-2 text-gray-900">{{ $gasto->consumidor->nombre }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700 text-sm">Monto:</span>
                <span class="ml-2 font-bold text-red-600">S/ {{ $gasto->monto }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700 text-sm">Fecha:</span>
                <span class="ml-2 text-gray-900">{{ $gasto->fecha }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700 text-sm">Categoría:</span>
                <span class="ml-2 inline-block bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-1 rounded">
                    {{ $gasto->categoria }}
                </span>
            </div>

            <div class="mb-6">
                <span class="font-medium text-gray-700 text-sm">Descripción:</span>
                <span class="ml-2 text-gray-900">{{ $gasto->descripcion }}</span>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('gastos.edit', $gasto) }}"
                   class="inline-flex items-center px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                    Editar
                </a>
                <a href="{{ route('gastos.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
