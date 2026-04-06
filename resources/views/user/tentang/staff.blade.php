<div class="max-w-7xl mx-auto px-4 py-20">
    <div class="text-center mb-16 space-y-4">
        <h2 class="text-4xl font-bold text-gray-900">Tim Di Balik TechPed</h2>
        <p class="text-gray-500 max-w-2xl mx-auto">Dedikasi kami adalah untuk memberikan pengalaman berbelanja terbaik bagi Anda dengan dukungan teknologi terkini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($staff as $index => $person)
        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
             style="animation: slideUp 0.8s ease-out forwards; animation-delay: {{ $index * 0.2 }}s; opacity: 0;">
            
            {{-- Image Container --}}
            <div class="relative h-[400px] overflow-hidden bg-gray-100">
                <img src="{{ $person['image'] }}" 
                     alt="{{ $person['name'] }}" 
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                
                {{-- Social Overlay --}}
                <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/80 via-black/40 to-transparent translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                    <div class="flex justify-center gap-6">
                        @foreach($person['social'] as $platform => $url)
                        <a href="{{ $url }}" class="text-white hover:text-violet-400 transition-colors transform hover:scale-125 duration-300">
                            @if($platform == 'fb')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91V127.41c0-25.35 12.42-50.06 52.24-50.06H295V6.26S259.36 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.2V288z"/></svg>
                            @elseif($platform == 'tw')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H36L200.7 275.5 26.8 48h145.4l100.5 132.7L389.2 48z"/></svg>
                            @elseif($platform == 'ig')
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>
                            @elseif($platform == 'li')
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512"><path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 01107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/></svg>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-8 text-center bg-white">
                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-violet-600 transition-colors duration-300">{{ $person['name'] }}</h3>
                <p class="text-violet-500 font-medium mt-1">{{ $person['role'] }}</p>
                <div class="mt-4 w-12 h-1 bg-violet-100 mx-auto group-hover:w-24 transition-all duration-500"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

