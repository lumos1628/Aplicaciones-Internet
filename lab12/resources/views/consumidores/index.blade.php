<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Consumidores
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('consumidores.create') }}"
           class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Nuevo Consumidor
        </a>

        <table class="w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nombre</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consumidores as $consumidor)
                <tr class="border-t">
                    <td class="p-3">{{ $consumidor->id }}</td>
                    <td class="p-3">{{ $consumidor->nombre }}</td>
                    <td class="p-3">{{ $consumidor->email }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('consumidores.show', $consumidor) }}"
                           class="text-blue-600 hover:underline">Ver</a>
                        <a