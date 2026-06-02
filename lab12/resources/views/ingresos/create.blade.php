<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Ingreso
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ingresos.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Consumidor</label>
                    <select name="consumidor_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        <option value="">-- Seleccionar --</option>
                        @foreach($consumidores as $consumidor)
                            <option value="{{ $consumidor->id }}"
                                {{ old('consumidor_id') == $consumidor->id ? 'selected' : '' }}>
                                {{ $consumidor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Monto (S/)</label>
                    <input type="number" name="monto" value="{{ old('monto') }}" step="0.01" min="0"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Descripción</label>
                    <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Guardar
                    </button>
                    <a href="{{ route('ingresos.index') }}"
                       class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>