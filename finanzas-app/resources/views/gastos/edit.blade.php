<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Gasto
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-sm p-6">

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gastos.update', $gasto) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium text-sm mb-1">Consumidor</label>
                    <select name="consumidorId"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-slate-500 focus:ring-slate-500">
                        <option value="">-- Seleccionar --</option>
                        @foreach($consumidores as $consumidor)
                            <option value="{{ $consumidor->id }}"
                                {{ old('consumidorId', $gasto->consumidorId) == $consumidor->id ? 'selected' : '' }}>
                                {{ $consumidor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium text-sm mb-1">Monto (S/)</label>
                    <input type="number" name="monto" value="{{ old('monto', $gasto->monto) }}" step="0.01" min="0"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium text-sm mb-1">Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha', $gasto->fecha) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium text-sm mb-1">Categoría</label>
                    <select name="categoria"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-slate-500 focus:ring-slate-500">
                        <option value="">-- Seleccionar --</option>
                        @foreach(['Alimentación', 'Transporte', 'Salud', 'Educación', 'Entretenimiento', 'Otros'] as $cat)
                            <option value="{{ $cat }}"
                                {{ old('categoria', $gasto->categoria) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium text-sm mb-1">Descripción</label>
                    <input type="text" name="descripcion" value="{{ old('descripcion', $gasto->descripcion) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:border-slate-500 focus:ring-slate-500">
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                        Actualizar
                    </button>
                    <a href="{{ route('gastos.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
