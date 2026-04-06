@extends('admin.layouts.app')

@section('title', 'Cetak Struk')

@section('content')
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-[18px] font-semibold text-black">
                    Cetak Struk
                </h1>
                <p class="text-[12px] text-gray-600">
                    Halaman untuk mencetak struk
                </p>
            </div>
        </div>
        
        @include('admin.struk.content')
    </div>
@endsection
