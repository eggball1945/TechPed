@extends('admin.layouts.app')

@section('title', 'Kelola User')

@section('content')
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-[18px] font-semibold text-black">
                    Kelola User
                </h1>
                <p class="text-[12px] text-gray-600">
                    Kelola akun pengguna, izin, dan aktivitas.
                </p>
            </div>
        </div>

        <div class="flex justify-center items-center rounded-[10px]">
        

            @include('admin.users.content')
    </div>
@endsection