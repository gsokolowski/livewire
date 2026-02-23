<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="sm:flex sm:items-center mb-6">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Posts
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all posts.
                            </p>
                        </div>
                    </div>

                    @if($posts->isEmpty())
                        <p class="text-sm text-gray-500">No posts found.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Description
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($posts as $post)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $post->id }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <a href="{{ route('posts.show', $post) }}" wire:navigate class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                    {{ $post->title }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ Str::words($post->body, 30) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Sentinel: when this div enters viewport, load more posts (Alpine x-intersect plugin) --}}
                        @if($hasMore)
                            <div
                                x-intersect.margin.200px="if (!$wire.loading && $wire.hasMore) $wire.loadMore()"
                                class="mt-6 py-8 flex items-center justify-center"
                            >
                                <span wire:loading wire:target="loadMore" class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Loading more...
                                </span>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
