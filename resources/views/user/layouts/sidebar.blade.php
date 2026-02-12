@php
    $menuItems = [
        ['title' => 'Build PC'],
        ['title' => 'Mini PC'],
        ['title' => 'Laptop'],
        ['title' => 'Gaming'],
        ['title' => 'Hardware'],
    ];
@endphp

<div class="w-[260px] flex flex-col px-14 pt-20 space-y-4">
    @foreach ($menuItems as $item)
        <div class="flex justify-between items-center w-full group cursor-pointer">
            <div class="font-title-16px-regular text-text-2 whitespace-nowrap
                        group-hover:text-violet-700 transition-colors">
                {{ $item['title'] }}
            </div>

            <div class="w-6 h-6 flex items-center justify-center
                        group-hover:text-violet-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    @endforeach
</div>
