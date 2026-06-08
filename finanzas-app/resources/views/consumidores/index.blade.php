<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Consumidores</h1>
            <a href="{{ route('consumidores.create') }}"
               class="bg-slate-700 text-white px-4 py-2 rounded-lg hover:bg-slate-800 text-sm font-medium">
                + Nuevo Consumidor
            </a>
        </div>

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                 class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow-sm rounded-lg">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Ingresos</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Gastos</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consumidores as $consumidor)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $consumidor->nombre }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $consumidor->email }}</td>
                        <td class="px-4 py-3">{{ $consumidor->ingresos->count() }}</td>
                        <td class="px-4 py-3">{{ $consumidor->gastos->count() }}</td>
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('consumidores.show', $consumidor) }}"
                               class="text-blue-600 hover:underline text-sm">Ver</a>
                            <a href="{{ route('consumidores.edit', $consumidor) }}"
                               class="text-amber-600 hover:underline text-sm">Editar</a>
                            <form action="{{ route('consumidores.destroy', $consumidor) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar?')"
                                        class="text-red-600 hover:underline text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
