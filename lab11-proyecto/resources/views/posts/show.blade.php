<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow mt-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
        <p class="text-gray-700 text-lg leading-relaxed mb-4">{{ $post->content }}</p>
        <p class="text-sm text-gray-400 mb-6">Por: <span class="font-medium text-gray-700">{{ $post->user->name }}</span></p>
        <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded">Volver</a>
    </div>
</x-app-layout>