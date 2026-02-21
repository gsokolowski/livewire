<x-app-layout>
    @if(session('toast'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toast = @json(session('toast'));
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({ icon: toast.type, title: toast.message });
        });
    </script>
    @endif
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        {{-- Title --}}
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
                        </div>

                        {{-- Image --}}
                        @if ($product->image_path)
                            <div>
                                <img 
                                    src="{{ asset('storage/' . $product->image_path) }}" 
                                    alt="{{ $product->title }}" 
                                    class="w-full h-auto max-w-2xl rounded-lg shadow-md object-cover"
                                />
                            </div>
                        @else
                            <div class="bg-gray-200 rounded-lg p-8 text-center text-gray-500">
                                <p>No image available</p>
                            </div>
                        @endif

                        {{-- Description --}}
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Description</h2>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $product->description }}</p>
                        </div>

                        {{-- Product Info --}}
                        <div class="border-t border-gray-200 pt-4">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="font-semibold text-gray-600">Status:</span>
                                    <span class="ml-2">
                                        @if ($product->published)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Published
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Draft
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <span class="font-semibold text-gray-600">Created:</span>
                                    <span class="ml-2 text-gray-700">{{ $product->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
