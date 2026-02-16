<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="sm:flex sm:items-center mb-6">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">
                            Students
                        </h1>
                        <p class="mt-2 text-sm text-gray-700">
                            A list of all the Students.
                        </p>
                    </div>

                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <a wire:navigate href="{{ route('students.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Add Student
                        </a>
                    </div>
                </div>  
                <div class="flex flex-col justify-between sm:flex-row mt-4 mb-4">
                    <div class="relative text-sm text-gray-800 col-span-3">
                        <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
</svg>                            </div>
                        <div class="block rounded-lg border-0 py-2 pl-10 pr-4 h-10 bg-gray-200 animate-shimmer"></div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                <input type="checkbox" wire:click="toggleSelectAll" wire:key="select-all-0-10-page" class="form-checkbox h-4 w-4 text-indigo-600">
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                <div class="flex items-center gap-1 cursor-pointer">
                                                    <span>ID</span>
                                                    <button wire:click="sortByColumn('id', 'asc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"></path>
</svg>                                                        </button>
                                                    <button wire:click="sortByColumn('id', 'desc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
</svg>                                                        </button>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                <div class="flex items-center gap-1 cursor-pointer">
                                                    <span>Name</span>
                                                    <button wire:click="sortByColumn('name', 'asc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"></path>
</svg>                                                        </button>
                                                    <button wire:click="sortByColumn('name', 'desc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
</svg>                                                        </button>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                <div class="flex items-center gap-1 cursor-pointer">
                                                    <span>Email</span>
                                                    <button wire:click="sortByColumn('email', 'asc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"></path>
</svg>                                                        </button>
                                                    <button wire:click="sortByColumn('email', 'desc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
</svg>                                                        </button>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Directory
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Section
                                            </th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                <div class="flex items-center gap-1 cursor-pointer">
                                                    <span>Created At</span>
                                                    <button wire:click="sortByColumn('created_at', 'asc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"></path>
</svg>                                                        </button>
                                                    <button wire:click="sortByColumn('created_at', 'desc')" class="p-0.5 rounded text-gray-700">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
</svg>                                                        </button>
                                                </div>
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                Actiom
                                            </th>
                                        </th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @for($i = 0; $i < 10; $i++)
                                            <tr>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-4 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-12 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-32 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-40 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-20 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-24 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                    <div class="h-4 w-24 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                </td>
                                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                                    <div class="flex gap-4">
                                                        <div class="h-4 w-12 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                        <div class="h-4 w-16 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor                                        </tbody>
                                </table>
                            </div>
                            <!-- pagination skeleton -->
                            <div class="mt-3 mb-3">
                                <div class="flex items-center justify-between">
                                    <div class="h-4 w-48 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                    <div class="flex gap-2">
                                        @for($i = 0; $i < 5; $i++)
                                            <div class="h-8 w-8 bg-gray-200 rounded animate-shimmer blur-[2px]"></div>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>