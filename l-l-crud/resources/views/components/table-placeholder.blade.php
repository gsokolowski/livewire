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
                        <a wire:navigate="" href="http://127.0.0.1:8000/students/create" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
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
                        <input type="text" placeholder="Search students data..." id="search" wire:model.live.debounce.500ms="search" class="block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                <!-- ✅ ADDED: Loading indicator for pagination in table area -->
                                <div id="table-loading" wire:loading="" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-8 h-8 text-indigo-600 animate-spin mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
<path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"></path>
</svg>                                            <p class="text-sm text-gray-700">Loading...</p>
                                    </div>
                                </div>
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
                                        <!--[if BLOCK]><![endif]-->                                                <!--[if BLOCK]><![endif]-->                                                    <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="940" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        940
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Jaqueline Murphy
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        dina.daugherty@example.org
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 4
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="938" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        938
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Chanel Schumm
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        ctrantow@example.org
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 10
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="937" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        937
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Aaliyah Bogisich
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        eriberto.klein@example.com
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 6
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section A
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="936" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        936
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Grant Gutmann
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        chandler57@example.org
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 2
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="935" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        935
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Mr. Emerald Ziemann
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        sherman.gleichner@example.com
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 6
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="934" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        934
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Dr. Francisca Hackett V
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        kiana.prohaska@example.org
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 5
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section A
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="933" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        933
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Nayeli Jaskolski
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        bryon.turcotte@example.com
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 1
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="932" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        932
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Mr. Crawford Gusikowski DVM
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        iwisoky@example.com
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 5
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    

                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="931" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        931
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Jamar Runolfsdottir
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        idella97@example.org
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 8
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section A
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                                                                                <tr>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        <input type="checkbox" wire:model="selectedStudentIds" value="930" class="form-checkbox h-4 w-4 text-indigo-600">
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        930
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Raymond Jacobi
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        millie.smith@example.org
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Class 8
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        Section B
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                        1 day ago
                                                    </td>
                                    
                                                </tr>
                                            <!--[if ENDBLOCK]><![endif]-->                                            <!--[if ENDBLOCK]><![endif]-->                                        </tbody>
                                </table>
                            </div>
                            <!-- pagination links -->
                            <div class="mt-3 mb-3">Links <div>
<!--[if BLOCK]><![endif]-->        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            <span>
                <!--[if BLOCK]><![endif]-->                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                        « Previous
                    </span>
                <!--[if ENDBLOCK]><![endif]-->                </span>

            <span>
                <!--[if BLOCK]><![endif]-->                        <button type="button" wire:click="nextPage('page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" wire:loading.attr="disabled" dusk="nextPage.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                        Next »
                    </button>
                <!--[if ENDBLOCK]><![endif]-->                </span>
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    <span>Showing</span>
                    <span class="font-medium">1</span>
                    <span>to</span>
                    <span class="font-medium">10</span>
                    <span>of</span>
                    <span class="font-medium">856</span>
                    <span>results</span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse rounded-md shadow-sm">
                    <span>
                        
                        <!--[if BLOCK]><![endif]-->                                <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </span>
                        <!--[if ENDBLOCK]><![endif]-->                        </span>

                    
                    <!--[if BLOCK]><![endif]-->                            
                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                        
                        <!--[if BLOCK]><![endif]-->                                <!--[if BLOCK]><![endif]-->                                    <span wire:key="paginator-page-page1">
                                    <!--[if BLOCK]><![endif]-->                                            <span aria-current="page">
                                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">1</span>
                                        </span>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page2">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(2, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 2">
                                            2
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page3">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(3, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 3">
                                            3
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page4">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(4, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 4">
                                            4
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page5">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(5, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 5">
                                            5
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page6">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(6, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 6">
                                            6
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page7">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(7, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 7">
                                            7
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page8">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(8, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 8">
                                            8
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page9">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(9, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 9">
                                            9
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page10">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(10, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 10">
                                            10
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                            <!--[if ENDBLOCK]><![endif]-->                            <!--[if ENDBLOCK]><![endif]-->                                                    
                        <!--[if BLOCK]><![endif]-->                                <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">...</span>
                            </span>
                        <!--[if ENDBLOCK]><![endif]-->
                        
                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->                                                    
                        <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                        
                        <!--[if BLOCK]><![endif]-->                                <!--[if BLOCK]><![endif]-->                                    <span wire:key="paginator-page-page85">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(85, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 85">
                                            85
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                                                                <span wire:key="paginator-page-page86">
                                    <!--[if BLOCK]><![endif]-->                                            <button type="button" wire:click="gotoPage(86, 'page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Go to page 86">
                                            86
                                        </button>
                                    <!--[if ENDBLOCK]><![endif]-->                                    </span>
                            <!--[if ENDBLOCK]><![endif]-->                            <!--[if ENDBLOCK]><![endif]-->                        <!--[if ENDBLOCK]><![endif]-->
                    <span>
                        
                        <!--[if BLOCK]><![endif]-->                                <button type="button" wire:click="nextPage('page')" x-on:click="   ($el.closest('body') || document.querySelector('body')).scrollIntoView()" dusk="nextPage.after" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="Next &amp;raquo;">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        <!--[if ENDBLOCK]><![endif]-->                        </span>
                </span>
            </div>
        </div>
    </nav>
<!--[if ENDBLOCK]><![endif]--></div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>