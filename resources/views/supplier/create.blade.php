<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fournisseurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ajouter un Fournisseur') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Ajouter les informations du Fournisseur") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('supplier.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="name" :value="__('Nom')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="city" :value="__('Ville')" />
                                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city')" required autofocus autocomplete="city" />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>

                            <div>
                                <x-input-label for="country" :value="__('Pays')" />
                                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country')" required autofocus autocomplete="country" />
                                <x-input-error class="mt-2" :messages="$errors->get('country')" />
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Adresse')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" required autofocus autocomplete="address" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Numéro de téléphone')" />
                                <x-text-input id="phone" name="phone" type="number" class="mt-1 block w-full" :value="old('phone')" required autofocus autocomplete="phone" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <x-input-label for="type" :value="__('Type')" />
                                <x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('type')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'supplier-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('Sauvegardé.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
