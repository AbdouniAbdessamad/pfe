<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('filter-button').addEventListener('click', function() {
            var filterValue = document.getElementById('supplier-filter').value.trim().toLowerCase();
            var tables = document.querySelectorAll('.min-w-full');

            tables.forEach(function(table) {
                var rows = table.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    var name = row.querySelector('td:nth-child(2)').textContent.trim().toLowerCase(); // Targeting the second column for name
                    if (name.includes(filterValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        document.getElementById('reset-button').addEventListener('click', function() {
            var tables = document.querySelectorAll('.min-w-full');
            tables.forEach(function(table) {
                var rows = table.querySelectorAll('tbody tr');
                rows.forEach(function(row) {
                    row.style.display = '';
                });
            });
            document.getElementById('supplier-filter').value = '';
        });
    });
</script>




<x-app-layout>
    <x-slot name="header">
        <x-slot name="header">
            <div class="flex flex-row justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <a href="{{ route('dashboard') }}"
                        style="{{ request()->routeIs('dashboard') ? 'color: #4F46E5;' : '' }}">
                        {{ __('Fournisseurs') }}
                    </a>
                </h2>
                <a href="{{ route('supplier.create') }}"
                    class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Ajouter
                    un Fournisseur</a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" text-gray-900 dark:text-gray-100">
                        <div class="flex items-center mb-4">
                            <input type="text" id="supplier-filter" class="form-input w-full rounded-md shadow-sm"
                                placeholder="Entrer Nom Fournisseur">
                            <button id="filter-button"
                                class="ml-2 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Filtrer</button>
                            <button id="reset-button"
                                class="ml-2 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Réinitialiser</button>
                        </div>
                        <div class="border flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                        Id</th>
                                                    <th scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                        Nom</th>
                                                    <th scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                        Ville</th>
                                                    <th scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                        Pays</th>
                                                    <th scope="col"
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                        Numéro de téléphone</th>
                                                    <th scope="col"
                                                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                        Type</th>
                                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                        <span class="sr-only">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                @foreach ($suppliers as $supplier)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $supplier->id }}</td>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        {{ $supplier->name }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    $supplier->city }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    $supplier->country }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    $supplier->phone }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                                    $supplier->type }}</td>
                                                    <td
                                                        class="relative py-4 pl-3 pr-4 text-sm sm:pr-6 flex flex-row gap-2">
                                                        @if(auth()->user()->role == 'administrateur')
                                                        <a href="{{ route('supplier.edit', ['supplier' => $supplier->id]) }}"
                                                            class="text-indigo-600 hover:text-indigo-900">
                                                            <x-primary-button>
                                                                Editer
                                                            </x-primary-button>
                                                        </a>
                                                        <x-danger-button x-data=""
                                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-supplier-{{$supplier->id}}-deletion')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="currentColor" class="w-4 h-4">
                                                                <path fill-rule="evenodd"
                                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="sr-only">Supprimer</span>
                                                        </x-danger-button>
                                                        @endif
                                                        <a
                                                            href="{{ route('supplier.show', ['supplier' => $supplier->id]) }}">
                                                            <button
                                                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                                                                Plus d'info
                                                            </button>
                                                        </a>



                                                        <x-modal name="confirm-supplier-{{$supplier->id}}-deletion"
                                                            focusable>
                                                            <form method="post" action="{{ route('supplier.destroy', ["supplier"=>
                                                            $supplier->id]) }}" class="p-6 text-center">
                                                                @csrf
                                                                @method('delete')

                                                                <h2
                                                                    class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                                    {{ __("Confirmer la suppression du Fournisseur")
                                                                }}
                                                                </h2>


                                                                <div class="mt-6 flex justify-center">
                                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                                        {{ __('Annuler') }}
                                                                    </x-secondary-button>

                                                                    <x-danger-button class="ml-3">
                                                                        {{ __('Supprimer') }}
                                                                    </x-danger-button>
                                                                </div>
                                                            </form>
                                                        </x-modal>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
</x-app-layout>
