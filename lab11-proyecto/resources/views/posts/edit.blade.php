<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow mt-6">
        <h1 class="text-2xl font-bold mb-4">Editar Publicación</h1>
        <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" value="{{ $post->title }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                <textarea name="content" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ $post->content }}</textarea>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">Actualizar</button>
                <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>