<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stock') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ajouter un article') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Ajouter les information de l'article") }}
                            </p>
                        </header>


                        <form method="post" action="{{ route('articles.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full"
                                    :value="old('date')" required autofocus autocomplete="date" />
                                <x-input-error class="mt-2" :messages="$errors->get('date')" />
                            </div>

                            <div>
                                <x-input-label for="bon_commande" :value="__('Bon Commande/Bon Sortie')" />
                                <x-text-input id="bon_commande" name="bon_commande" type="text"
                                    class="mt-1 block w-full" :value="old('bon_commande')" required autofocus
                                    autocomplete="bon_commande" />
                                <x-input-error class="mt-2" :messages="$errors->get('bon_commande')" />
                            </div>

                            <div>
                                <x-input-label for="supplier_id" :value="__('Fournisseur/Bénéficiaire')" />
                                <select name="supplier_id" id="" class="form-control w-full">
                                    <option class="text-2xl text-black" disabled>Fournisseurs</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                    <option class="text-2xl text-black" disabled>Bénéficiaires</option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach

                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('supplier_id')" />
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Désignation')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="ref" :value="__('Reference')" />
                                <x-text-input id="ref" name="ref" type="text" class="mt-1 block w-full"
                                    :value="old('ref')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('ref')" />

                            </div>

                            <div>
                                <x-input-label for="quantity" :value="__('Quantité')" />
                                <x-text-input id="quantity" name="quantity" type="number" class="mt-1 block w-full"
                                    :value="old('quantity')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('quantity')" />

                            </div>

                            <div>
                                <x-input-label for="category" :value="__('Catégorie')" />
                                <select name="category_id" id="category" class="form-control w-full">
                                    @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <div>
                                <x-input-label for="emplacement" :value="__('Emplacement')" />
                                <x-text-input id="emplacement" name="emplacement" type="text" class="mt-1 block w-full"
                                    :value="old('emplacement')"  autofocus autocomplete="emplacement" />
                                <x-input-error class="mt-2" :messages="$errors->get('emplacement')" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status">
                                    <option value=""></option>
                                    <option value="entrée">Entrée</option>
                                    <option value="sortie">Sortie</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status')" />

                            </div>

                            <div>
                                <x-input-label for="last_editor" :value="__('Dernier éditeur')" />
                                <x-text-input id="last_editor" name="last_editor" type="text" class="mt-1 block w-full"
                                    :value="old('last_editor')" disabled />
                                <x-input-error class="mt-2" :messages="$errors->get('last_editor')" />

                            </div>



                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Sauvegardé.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
