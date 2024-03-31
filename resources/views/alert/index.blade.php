<!-- resources/views/low_quantity/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quantité existante') }}
        </h2>
    </x-slot>
    <br>
    <h1 class="text-center text-2xl">Articles à basse quantité sont en orange !</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($lowquantities as $article)
                            <tr class="{{ $article->quantity < 10 ? 'bg-orange-500' : '' }}">
                                <td class="px-6 py-4 text-lg whitespace-nowrap">{{ $article->ref }}</td>
                                <td class="px-6 py-4 text-lg whitespace-nowrap">{{ $article->name }}</td>
                                <td class="px-6 py-4 text-lg whitespace-nowrap">{{ $article->quantity }}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
