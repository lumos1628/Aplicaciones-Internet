<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Consumidor
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

            <form action="{{ route('consumidores.update', $consumidor) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $consumidor->nombre) }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $consumidor->email) }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Actualizar
                    </button>
                    <a href="{{ route('consumidores.index') }}"
                       class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>