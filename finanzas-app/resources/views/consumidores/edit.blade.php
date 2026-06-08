<x-app-layout>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Editar Consumidor</h1>

        <div class="bg-white shadow-sm rounded-lg p-6">
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('consumidores.update', $consumidor) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $consumidor->nombre) }}"
                           class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $consumidor->email) }}"
                           class="w-full border rounded-md px-3 py-2 focus:outline-none focus:border-slate-500 focus:ring-1 focus:ring-slate-500">
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600 text-sm font-medium">
                        Actualizar
                    </button>
                    <a href="{{ route('consumidores.index') }}"
                       class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 text-sm font-medium">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
