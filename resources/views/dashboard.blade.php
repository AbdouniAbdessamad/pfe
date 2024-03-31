<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste Utilisateurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(auth()->user()->role == 'administrateur')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nom') }}
                                </th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Fonction') }}
                                </th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Id') }}
                                </th>
                            </tr>
                        </thead>

                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600">
                                @foreach($users as $user)
                                <tr>
                                    <td class="py-2 px-4 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="py-2 px-4 whitespace-nowrap">
                                        {{ $user->role }}
                                    </td>
                                    <td class="py-2 px-4 whitespace-nowrap">
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
