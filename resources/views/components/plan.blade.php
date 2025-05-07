@props(['product'])

<div
    @click="
        selected = @json($product['id']);
        selectedPrice = @json($product['pricing']['price']);
        ogPrice = @json($product['pricing']['original_price']);
        period = '{{$product['slug']}}';
    "
    :class="selected === {{ $product['id'] }} ? 'border-2 border-[#1FA37E]' : 'border border-[#ADB1B9]'"
    class="cursor-pointer flex items-center gap-2 py-4 px-[15px] bg-white rounded-2xl"
>
    <img
        class="size-[32px]"
        :src='selected === {{ $product["id"] }} 
            ? "{{ asset("assets/filled-circle.svg") }}" 
            : "{{ asset("assets/empty-circle.svg") }}"' 
        alt="checkbox"
    />
    <div class="w-[140px] flex flex-col justify-center items-center">
        <div class="text-[#2E425F] leading-[20px] font-semibold mb-2" x-data><span x-text="window.translations['{{$product['slug']}}']"></span></div>
        <div class="text-[#2E425F] text-xs font-medium tracking-[-0.024px]">
            <span class="text-[#F33746] line-through">€{{ number_format($product['pricing']['original_price'], 2, ',', '') }}</span>
            €{{ number_format($product['pricing']['price'], 2, ',', '') }}
            <p class="text-[10px] text-[#949494]">Billed every {{ $product['slug'][0]}} {{ $product['slug'][0] == 1 ? 'month' : 'months'}}</p>
        </div>
        @if($product['default'])
            <span class="rounded-[14px] bg-[#F33746] py-1 px-2 text-white text-center text-xs font-semibold">Most popular</span>
        @endif
    </div>
    <div class="h-[82px] w-[1px] bg-[#E1E2EC]"></div>
    <div class="w-[134px] flex flex-col justify-center items-center">
        <p class="text-[#2E425F] leading-[40px] text-center font-semibold text-[32px]">€{{ number_format($product['pricing']['price'] / $product['slug'][0], 2, ',', '') }}</p>
        <p class="text-xs leading-[18px] text-center text-[#949494] font-medium">per month</p>
    </div>
</div>