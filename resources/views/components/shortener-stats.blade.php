<x-card>
    <div class="border-b mb-4 pb-2">{{ $name }}</div>
    <div class="divide-y">
        @foreach ($data as $item)
            <div class="flex items-center justify-between py-2 text-sm">
                <span class="text-slate-500 capitalize">{{ $item?->name }}</span>
                <span class="text-slate-800 font-semibold">{{ $item?->total }}</span>
            </div>
        @endforeach
    </div>
</x-card>
