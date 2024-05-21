<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product: {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <header class="mb-4">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Update Product') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Update product information and submit to save changes.') }}
                    </p>
                </header>

                <form action="{{ route('products.update', $product) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $product->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            :value="old('price', $product->price)" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="short_url_key" :value="__('Short URL Key')" />

                        <div
                            class="focus-within:ring-1 focus-within:border-indigo-500 overflow-hidden rounded-md shadow-sm focus-within:ring-indigo-500 border mt-1 flex items-stretch divide-x divide-slate-300 border-slate-300">
                            <div class="px-2 bg-slate-50 flex items-center justify-center">
                                <span class="text-slate-500">{{ config('app.domain_shortener') }}/</span>
                            </div>
                            <input id="short_url_key" class="block w-full" type="text" name="short_url_key"
                                value="{{ old('short_url_key', $product->short_url_key) }}" />
                        </div>

                        <x-input-error :messages="$errors->get('short_url_key')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <x-textarea id="description" class="block mt-1 w-full" name="description" :value="old('description', $product->description)"
                            required />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="is_short" class="inline-flex items-center">
                            <input id="is_short" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-slate-600 shadow-sm focus:ring-slate-500 dark:focus:ring-slate-600 dark:focus:ring-offset-gray-800"
                                name="is_short">
                            <span
                                class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Generate Short Url') }}</span>
                        </label>
                    </div>

                    <x-primary-button class="mt-4">
                        Update
                    </x-primary-button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
