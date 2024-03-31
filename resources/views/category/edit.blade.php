<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catégorie') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Modifier une Catégorie') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Modifier les information d'une Catégorie") }}
                            </p>
                        </header>


                        <form method="POST" action="{{ route('category.update',['category'=>$category->id]) }}" class="mt-6 space-y-6">
                            @csrf
                            @method("patch")
                            <div>
                                <x-input-label for="name" :value="__('Nom')" />
                                <x-text-input id="name" name="name" type="name" class="mt-1 block w-full" :value="old('name',$category->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
            


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

                                @if (session('status') === 'category-updated')
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
