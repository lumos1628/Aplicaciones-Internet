<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ingresos
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('ingresos.create') }}"
           class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Nuevo Ingreso
        </a>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Consumidor</th>
                    <th class="p-3 text-left">Monto</th>
                    <th class="p-3 text-left">Fecha</th>
                    <th class="p-3 text-left">Descripción</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingresos as $ingreso)
                <tr class="border-t">
                    <td class="p-3">{{ $ingreso->id }}</td>
                    <td class="p-3">{{ $ingreso->consumidor->nombre }}</td>
                    <td class="p-3 text-green-600 font-medium">S/ {{ $ingreso->monto }}</td>
                    <td class="p-3">{{ $ingreso->fecha }}</td>
                    <td class="p-3">{{ $ingreso->descripcion }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('ingresos.show', $ingreso) }}"
                           class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('ingresos.edit', $ingreso) }}"
                           class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('ingresos.destroy', $ingreso) }}"
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