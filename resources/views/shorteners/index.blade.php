<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shorteners') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($shorteners as $shortener)
                    <x-card>
                        <span class="text-slate-500 text-sm">
                            {{ $shortener->short }}
                        </span>

                        <p class="line-clamp-1 mb-4">
                            {{ $shortener->original }}
                        </p>

                        <x-primary-anchor href="{{ route('shorteners.stats', $shortener) }}">
                            Stats
                        </x-primary-anchor>
                    </x-card>
                @endforeach
            </div>

            @if ($shorteners->hasPages())
                <div class="mt-8">
                    {{ $shorteners->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
