<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Nuevo Ingreso</h1>

        <div class="bg-white rounded-lg shadow-sm p-6">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ingresos.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="consumidorId" class="block text-sm font-medium text-gray-700 mb-1">Consumidor</label>
                    <select name="consumidorId" id="consumidorId"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-slate-700 focus:ring focus:ring-slate-200 focus:ring-opacity-50">
                        <option value="">-- Seleccionar --</option>
                        @foreach($consumidores as $consumidor)
                            <option value="{{ $consumidor->id }}" {{ old('consumidorId') == $consumidor->id ? 'selected' : '' }}>
                                {{ $consumidor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="monto" class="block text-sm font-medium text-gray-700 mb-1">Monto (S/)</label>
                    <input type="number" name="monto" id="monto" value="{{ old('monto') }}" step="0.01" min="0"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-slate-700 focus:ring focus:ring-slate-200 focus:ring-opacity-50">
                </div>

                <div class="mb-5">
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-slate-700 focus:ring focus:ring-slate-200 focus:ring-opacity-50">
                </div>

                <div class="mb-6">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <input type="text" name="descripcion" id="descripcion" value="{{ old('descripcion') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-slate-700 focus:ring focus:ring-slate-200 focus:ring-opacity-50">
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit"
                            class="px-4 py-2 bg-emerald-600 text-white text-sm font-medium rounded-lg hover:bg-emerald-700 transition-colors">
                        Guardar
                    </button>
                    <a href="{{ route('ingresos.index') }}"
                       class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
