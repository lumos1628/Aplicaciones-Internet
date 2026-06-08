<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Gastos</h1>
            <a href="{{ route('gastos.create') }}"
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                + Nuevo Gasto
            </a>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-opacity="0"
                 class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Consumidor</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Monto</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($gastos as $gasto)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $gasto->consumidor->nombre }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-red-600">S/ {{ $gasto->monto }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $gasto->fecha }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-block bg-gray-100 text-gray-700 text-xs font-medium px-2.5 py-1 rounded">
                                    {{ $gasto->categoria }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $gasto->descripcion }}</td>
                            <td class="px-6 py-4 text-sm space-x-3">
                                <a href="{{ route('gastos.show', $gasto) }}"
                                   class="text-blue-600 hover:text-blue-800 font-medium">Ver</a>
                                <a href="{{ route('gastos.edit', $gasto) }}"
                                   class="text-amber-500 hover:text-amber-700 font-medium">Editar</a>
                                <form action="{{ route('gastos.destroy', $gasto) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este gasto?')"
                                            class="text-red-600 hover:text-red-800 font-medium">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">
                                No hay gastos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
