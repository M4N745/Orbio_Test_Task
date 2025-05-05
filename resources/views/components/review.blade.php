@props(['review'])

<div class="flex-1 bg-white rounded-[8px] shadow-[0px_1px_5px_0px_rgba(0,0,0,0.20)] p-4">
    <div class="mb-[6px] flex gap-3">
    <img class="size-[51px] rounded-full" src="{{ asset('profiles/'.$review['name'].'.png') }}" alt="{{ $review['name'] }} profile" />
        <div>
            <p class="text-[#1D1E20] font-semibold text-sm mb-2">{{ $review['name'] }}, {{ $review['age'] }}</p>
            <p class="text-[10px]">{{ $review['handle'] }}</p>
        </div>
    </div>
    <p class="text-[#1D1E20] text-xs leading-[20px]">
        {{ $review['description'] }}
    </p>
</div>