<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Detalle del Ingreso</h1>

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-5">
            <div>
                <span class="text-sm font-medium text-gray-500">Consumidor</span>
                <p class="mt-1 text-sm text-gray-900">{{ $ingreso->consumidor->nombre }}</p>
            </div>

            <div>
                <span class="text-sm font-medium text-gray-500">Monto</span>
                <p class="mt-1 text-sm font-bold text-emerald-600">S/ {{ $ingreso->monto }}</p>
            </div>

            <div>
                <span class="text-sm font-medium text-gray-500">Fecha</span>
                <p class="mt-1 text-sm text-gray-900">{{ $ingreso->fecha }}</p>
            </div>

            <div>
                <span class="text-sm font-medium text-gray-500">Descripción</span>
                <p class="mt-1 text-sm text-gray-900">{{ $ingreso->descripcion }}</p>
            </div>

            <div class="flex items-center space-x-3 pt-4">
                <a href="{{ route('ingresos.edit', $ingreso) }}"
                   class="px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                    Editar
                </a>
                <a href="{{ route('ingresos.index') }}"
                   class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                    Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
