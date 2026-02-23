<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Post') }}
            </h2>
            <a href="{{ route('posts.index') }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                Back to Posts
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                            <p class="mt-1 text-sm text-gray-500">ID: {{ $post->id }}</p>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Body</h2>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $post->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
