
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gastos
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('gastos.create') }}"
           class="mb-4 inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            + Nuevo Gasto
        </a>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Consumidor</th>
                    <th class="p-3 text-left">Monto</th>
                    <th class="p-3 text-left">Fecha</th>
                    <th class="p-3 text-left">Categoría</th>
                    <th class="p-3 text-left">Descripción</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gastos as $gasto)
                <tr class="border-t">
                    <td class="p-3">{{ $gasto->id }}</td>
                    <td class="p-3">{{ $gasto->consumidor->nombre }}</td>
                    <td class="p-3 text-red-600 font-medium">S/ {{ $gasto->monto }}</td>
                    <td class="p-3">{{ $gasto->fecha }}</td>
                    <td class="p-3">
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">
                            {{ $gasto->categoria }}
                        </span>
                    </td>
                    <td class="p-3">{{ $gasto->descripcion }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('gastos.show', $gasto) }}"
                           class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('gastos.edit', $gasto) }}"
                           class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('gastos.destroy', $gasto) }}"
                              method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar?')"
                                    class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>