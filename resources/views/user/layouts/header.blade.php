@props([
    'text' => 'Diskon Musim Panas untuk Semua Hardware Komputer - Diskon 20%!',
    'linkText' => 'Belanja Sekarang',
    'showLanguage' => true,
    'showDropdown' => true,
])

<div class="w-full h-12 relative">

    {{-- BAR --}}
    <div class="top-0 left-0 w-full h-12 bg-violet-700 z-50"></div>

    {{-- CONTENT --}}
    <div class="absolute top-0 left-0 w-full h-12 flex justify-end items-center z-50">
        <div class="inline-flex mt-0 w-[859px] h-12 mr-[136px] relative items-center gap-[231px]">
                
            <div class="inline-flex items-center gap-2 flex-[0_0_auto] h-12">
                {{-- TEXT --}}
                <p class="font-title-14px-regular text-text text-[length:var(--title-14px-regular-font-size)] tracking-[var(--title-14px-regular-letter-spacing)] leading-[var(--title-14px-regular-line-height)] whitespace-nowrap">
                    {{ $text }}
                </p>

                {{-- LINK --}}
                <div class="font-semibold text-text text-sm underline whitespace-nowrap">
                    {{ $linkText }}
                </div>
            </div>
        </div>
    </div>

</div>
