<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <!-- Timer section -->
    <section
        x-data="Timer()"
        x-init="start()"
        class="bg-[#F33746] text-white font-bold h-[40px] flex justify-center items-center gap-[10px] text-sm lg:text-base"
    >
        The offer expires in:
        <div class="font-normal">
            <span x-text="String(hours).padStart(2, '0')"></span>:<span x-text="String(minutes).padStart(2, '0')"></span>:<span x-text="String(seconds).padStart(2, '0')"></span>
        </div>
    </section>

    <!-- Header -->
    <header class="px-3 mb-4 lg:mb-0 lg:px-0 h-[62px] lg:h-[77px] flex justify-between items-center container mx-auto py-4">
        <img
            src="{{ asset('assets/logo.svg') }}"
            alt="Logo"
            class="lg:w-[145px] lg:h-[40px]"
        />
        <button
            class="cursor-pointer px-[11.5px] lg:px-[31.5px] bg-[#3A5BA9] text-white rounded-full h-[30px] lg:h-[45px] font-semibold text-sm"
            type="button"
        >
            Claim my plan
        </button>
    </header>
    <!-- Checkout page -->
    <main class="lg:max-w-[936px] mx-auto px-3 lg:px-0">
        <h1 class="lg:mb-10 mb-6 lg:text-4xl text-xl tracking-[-0.044px] lg:tracking-normal text-center font-bold lg:w-[648px] mx-auto text-[#2E425F]">Get your ADHD hypnotherapy plan and see results in first month <span class="text-[#3A5BA9] italic">(without any effort)</span></h1>

        @php
            $getItem = array_values(array_filter($products, function($item) {
                return $item['default'] === true;
            }))
        @endphp
        <div
            class="w-[360px] mx-auto"
            x-data="{
                selected: @json($getItem[0]['id']),
                selectedPrice: @json($getItem[0]['pricing']['price']),
                ogPrice: @json($getItem[0]['pricing']['original_price'])
            }"
        >
            <h5 class="text-[28px] text-center text-[#2E425F] font-medium mb-5 lg:mb-6">Select your plan</h5>
            <div class="flex flex-col items-center gap-4">
                @foreach($products as $product)
                    <x-plan :product="$product" />
                @endforeach
                <button class="bg-[#3A5BA9] h-[56px] w-[360px] rounded-[10px] text-white text-lg font-bold" type="button">Order now</button>
            </div>
            <p class="text-[#949494] text-xs mt-5 lg:mt-6">
                By clicking Get my plan, I agree to pay €<span x-text="selectedPrice.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })"></span> for my plan and that if I do not cancel before the end of the 4-week introductory plan,
                Happyo will automatically charge my payment method the regular price €<span x-text="ogPrice.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })"></span> every 4 weeks thereafter until I cancel.
                I can cancel by contacting <a class="text-[#3A5BA9] decoration-solid underline" href="mailto:support@gethappyo.co">support@gethappyo.co</a>
            </p>
            <div class="mt-5 lg:mt-6 p-4 bg-white rounded-[10px] flex gap-6 text-xs leading-[16px] text-[#1B1B1F] justify-between items-center shadow-[0px_1px_2px_0px_rgba(0,0,0,0.30),0px_1px_3px_1px_rgba(0,0,0,0.15)]">
                <img src="{{ asset('assets/money-back.svg') }}" alt="30 day money back"/>
                <p>We offer a 100% money-back guarantee to users who have listened to at least 4 hypnotherapy sessions within 30 days and do not experience any improvement in their ADHD.</p>
            </div>
            <div>
                <h5 class="text-[#2E425F] text-center text-[28px] font-medium mt-12 lg:mt-16">How does it work?</h5>
                <div class="mt-5 lg:mt-10 flex flex-col justify-center items-center gap-[10px] lg:gap-3">
                    @foreach(["Find a quiet place where you can relax", "Access the hypnotherapy recording in our member area", "Listen to one 15-minute session per day", "Enjoy the first results in one week"] as $item)
                        <div class="bg-[#F3FFFC] w-full px-5 py-3 rounded-[8px] shadow-[0px_1px_5px_0px_rgba(0,0,0,0.20)] flex gap-4 items-center">
                            <span class="text-white font-medium text-[28px] size-[42px] bg-[#1FA37E] rounded-[25px] flex items-center justify-center">{{ $loop->iteration }}</span>
                            <p class="flex-1 text-sm">{{ $item }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-12 lg:mt-16">
            <h5 class="text-[#2E425F] text-[28px] font-medium text-center">Users love our plan</h5>
            <div class="flex flex-col lg:flex-row mt-5 lg:mt-10 lg:mb-26 mb-[52px] gap-4 lg:gap-[18px] items-start">
                @foreach($reviews as $review)
                    <x-review :review="$review" />
                @endforeach
            </div>
        </div>
    </main>
    <script>
        window.translations = @json(__('translations'));

        function Timer() {
            return {
                    totalSeconds: 900,
                    interval: null,
                    get hours() {
                        return Math.floor(this.totalSeconds / 3600);
                    },
                    get minutes() {
                        return Math.floor((this.totalSeconds % 3600) / 60);
                    },
                    get seconds() {
                        return this.totalSeconds % 60;
                    },
                    start() {
                        this.interval = setInterval(() => {
                            if(this.totalSeconds > 0) this.totalSeconds--;
                            else this.totalSeconds = 0;
                        }, 1000);
                    },
                    stop() {
                        clearInterval(this.interval);
                    },
                    reset() {
                        this.stop();
                        this.totalSeconds = 0;
                    }
                };

        }
    </script>
</body>
</html>
