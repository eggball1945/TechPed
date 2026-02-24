@extends('petugas.layouts.app')

@section('title', 'Kelola Order')

@section('content')
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-[18px] font-semibold text-black">
                    Kelola Pesanan
                </h1>
                <p class="text-[12px] text-gray-600">
                    Melacak dan mengelola pesanan pelanggan, pengiriman, dan pengembalian.
                </p>
            </div>
        </div>
        
        @include('petugas.order.content')
    </div>
@endsection