<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-semibold line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-gray-600 line-clamp-2 my-4">{{ $product->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600"><sup>Rp</sup>
                                    {{ number_format($product->price, 0, 0, '.') }}</span>
                                <x-primary-anchor :href="route('products.show', $product)">
                                    Details
                                </x-primary-anchor>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
