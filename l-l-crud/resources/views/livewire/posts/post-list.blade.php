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
                                class="mt-6 py-8 flex items-center"
                            >
                                <span wire:loading wire:target="loadMore" class="inline-flex items-center gap-2 text-sm text-gray-500 mx-auto">
                                    <x-heroicon-o-arrow-path class="w-5 h-5 shrink-0 text-indigo-600 animate-spin" />
                                    Loading more posts...
                                </span>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
