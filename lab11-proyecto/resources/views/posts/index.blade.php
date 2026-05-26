<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow mt-6">
        <h1 class="text-2xl font-bold mb-4">Publicaciones</h1>
        <a href="{{ route('posts.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded mb-4">Crear Publicación</a>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($posts as $post)
            <div class="border border-gray-200 rounded-lg p-4 mb-4 shadow-sm bg-gray-50">
                <div class="flex justify-between items-start">
                    <div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h5>
                        <p class="text-gray-600 mb-2">{{ Str::limit($post->content, 100) }}</p>
                        <p class="text-sm text-gray-400 mb-2">Por: <span class="font-medium text-gray-700">{{ $post->user->name }}</span></p>
                        
                        <div class="flex items-center space-x-1 mb-4 bg-white p-2 rounded border w-fit">
                            <span class="text-yellow-500 font-bold text-lg">★</span>
                            <span class="text-sm font-semibold text-gray-700">
                                Promedio: {{ number_format($post->estrellas->avg('num_estrellas'), 1) ?? '0.0' }} 
                                ({{ $post->estrellas->count() }} votos)
                            </span>
                        </div>
                    </div>

                    <div class="bg-white p-3 rounded-lg border shadow-sm">
                        <form action="{{ route('estrellas.store') }}" method="POST" class="flex flex-col items-center space-y-1">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <label class="text-xs font-bold text-gray-500 uppercase">Valorar</label>
                            <select name="num_estrellas" class="text-sm rounded border-gray-300 py-1 px-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="5">5 ★★★★★</option>
                                <option value="4">4 ★★★★</option>
                                <option value="3">3 ★★★</option>
                                <option value="2">2 ★★</option>
                                <option value="1">1 ★</option>
                            </select>
                            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white text-xs py-1 px-3 rounded font-medium mt-1 transition-colors w-full">
                                Calificar
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="flex space-x-2 mt-2">
                    <a href="{{ route('posts.show', $post) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm py-1.5 px-3 rounded">Ver</a>
                    @if ($post->user_id === Auth::id())
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1.5 px-3 rounded">Editar</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm py-1.5 px-3 rounded" onclick="return confirm('¿Seguro?')">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>