@props([
    'text' => 'Upgrade Perangkatmu dengan Hardware Terbaik di TechPed!',
    'linkText' => 'Cek Sekarang',
])

<div class="w-full bg-violet-700 h-10 flex items-center justify-center px-4 overflow-hidden">
    <div class="max-w-7xl w-full flex justify-center items-center gap-4 text-white text-xs sm:text-sm transition-all duration-300">
        <p class="truncate opacity-90">
            {{ $text }}
        </p>
        <a href="{{ route('landing') }}#hardware-promo-section" class="font-bold underline whitespace-nowrap hover:text-violet-200 transition-all duration-200 decoration-2 underline-offset-4">
            {{ $linkText }}
        </a>
    </div>
</div>
