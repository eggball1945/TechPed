@extends('admin.layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-[18px] font-semibold text-black">
                    Pengaturan & Keamanan
                </h1>
                <p class="text-[12px] text-gray-600">
                    Kelola pengaturan toko Anda, akun admin, dan preferensi keamanan.
                </p>
            </div>
        </div>
        
        @include('admin.setting.content')
    </div>
@endsection
