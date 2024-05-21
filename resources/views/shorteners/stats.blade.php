<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Stats: <span class="text-slate-500">{{ $shortener->short }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-shortener-stats name="Device" :data="$devices" />
                <x-shortener-stats name="Device Type" :data="$device_types" />
                <x-shortener-stats name="Browser" :data="$browsers" />
                <x-shortener-stats name="Platform" :data="$platforms" />
                @if ($referrers->count() > 0)
                    <x-shortener-stats name="Referrer" :data="$referrers" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
