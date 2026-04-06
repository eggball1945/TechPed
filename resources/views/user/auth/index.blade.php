@extends('user.layouts.app')

@section('title', 'Login | TechPed')

@section('content')
    {{-- Violet Theme Background --}}
    <div class="fixed inset-0 z-0 pointer-events-none opacity-20">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-violet-700 blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-violet-600 blur-[150px]"></div>
        <div class="absolute top-[20%] right-[10%] w-[30%] h-[30%] rounded-full bg-violet-500 blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
    </div>

    <div class="w-full relative z-10 lg:pt-8">
        <div class="flex flex-col lg:flex-row items-center justify-center max-w-7xl mx-auto px-6 h-full gap-12 lg:gap-20">
            
            {{-- Illustration with Simple Rounded Design --}}
            <div class="w-full lg:w-1/2 flex justify-center lg:justify-start" 
                 style="animation: slideInLeft 1s ease-out forwards;">
                <div class="relative group w-full max-w-[600px] aspect-square sm:aspect-auto rounded-[3rem] bg-violet-50/50 overflow-hidden border border-violet-100/50 transition-all duration-500 hover:bg-violet-50">
                    {{-- Solid Tint Glow --}}
                    <div class="absolute inset-0 bg-violet-700/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <img src="{{ asset('images/image.webp') }}" 
                         alt="Auth TechPed" 
                         class="relative z-10 w-full h-full object-cover rounded-[2.5rem] floating-animation shadow-sm transition-transform duration-500 group-hover:scale-105">
                </div>
            </div>

            {{-- Form Container with Glassmorphism --}}
            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end"
                 style="animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
                <div class="w-full max-w-[500px] bg-white/70 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_30px_100px_-20px_rgba(109,40,217,0.15)] border border-white/40 p-8 sm:p-12 transition-all duration-500 hover:shadow-[0_40px_120px_-20px_rgba(109,40,217,0.25)] hover:bg-white/80">
                    @yield('auth')
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .floating-animation {
            animation: floating 4s ease-in-out infinite;
        }
    </style>
@endsection