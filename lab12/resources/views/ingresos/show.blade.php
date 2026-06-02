<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Ingreso
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">

            <div class="mb-4">
                <span class="font-medium text-gray-700">Consumidor:</span>
                <span class="ml-2">{{ $ingreso->consumidor->nombre }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Monto:</span>
                <span class="ml-2 text-green-600 font-semibold">S/ {{ $ingreso->monto }}</span>
            </div>

            <div class="mb-4">
                <span class="font-medium text-gray-700">Fecha:</span>
                <span class="ml-2">{{ $ingreso->fecha }}</span>
            </div>

            <div class="mb-6">
                <span class="font-medium text-gray-700">Descripción:</span>
                <span class="ml-2">{{ $ingreso->descripcion }}</span>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('ingresos.edit', $ingreso) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar
                </a>
                <a href="{{ route('ingresos.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>