@extends('admin.layouts.app')

@section('title', 'Kelola Laporan')

@section('content')
    <div class="p-6">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-[18px] font-semibold text-black">
                    Kelola laporan
                </h1>
                <p class="text-[12px] text-gray-600">
                    Kelola katalog produk, inventaris, dan kategori Anda.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
            <div class="bg-[#9cdeb4]/50 rounded-xl border border-[#55c47e] h-[120px] flex flex-col items-center justify-center text-center gap-1">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.6667 14.375H25C25 9.41025 20.4083 7.14575 16.6667 6.62425V3H13.3333V6.62425C9.59167 7.14575 5 9.41025 5 14.375C5 19.1105 9.44333 21.5728 13.3333 22.1275V30.825C10.92 30.3857 8.33333 29.033 8.33333 26.625H5C5 31.1557 9.04167 33.8333 13.3333 34.388V38H16.6667V34.3775C20.4083 33.856 25 31.5897 25 26.625C25 21.6602 20.4083 19.3958 16.6667 18.8743V10.175C18.8833 10.5932 21.6667 11.8217 21.6667 14.375ZM8.33333 14.375C8.33333 11.8217 11.1167 10.5932 13.3333 10.175V18.5732C11.0483 18.1305 8.33333 16.8197 8.33333 14.375ZM21.6667 26.625C21.6667 29.1782 18.8833 30.4067 16.6667 30.825V22.425C18.8833 22.8433 21.6667 24.0717 21.6667 26.625Z" fill="#55C47E"/>
                </svg>

                <p class="text-[13px] font-medium text-[#2f7a4b]">
                    Total Pendapatan ({{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }})
                </p>

                <h2 class="text-[20px] font-semibold text-[#2f7a4b]">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </h2>
            </div>

            <div class="bg-[#ebf3fe] rounded-xl border border-[#739ffc] h-[120px] flex flex-col items-center justify-center text-center gap-1">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.7916 26.25C25.5652 26.25 26.3071 26.5573 26.854 27.1043C27.401 27.6513 27.7083 28.3931 27.7083 29.1667C27.7083 29.9402 27.401 30.6821 26.854 31.2291C26.3071 31.776 25.5652 32.0833 24.7916 32.0833C24.0181 32.0833 23.2762 31.776 22.7293 31.2291C22.1823 30.6821 21.875 29.9402 21.875 29.1667C21.875 27.5479 23.1729 26.25 24.7916 26.25ZM1.45831 2.91667H6.22706L7.5979 5.83334H29.1666C29.5534 5.83334 29.9244 5.98698 30.1978 6.26047C30.4713 6.53396 30.625 6.9049 30.625 7.29167C30.625 7.53959 30.5521 7.7875 30.45 8.02084L25.2291 17.4563C24.7333 18.3458 23.7708 18.9583 22.6771 18.9583H11.8125L10.5 21.3354L10.4562 21.5104C10.4562 21.6071 10.4946 21.6998 10.563 21.7682C10.6314 21.8366 10.7241 21.875 10.8208 21.875H27.7083V24.7917H10.2083C9.43476 24.7917 8.6929 24.4844 8.14592 23.9374C7.59894 23.3904 7.29165 22.6486 7.29165 21.875C7.29165 21.3646 7.4229 20.8833 7.64165 20.475L9.62498 16.9021L4.37498 5.83334H1.45831V2.91667ZM10.2083 26.25C10.9819 26.25 11.7237 26.5573 12.2707 27.1043C12.8177 27.6513 13.125 28.3931 13.125 29.1667C13.125 29.9402 12.8177 30.6821 12.2707 31.2291C11.7237 31.776 10.9819 32.0833 10.2083 32.0833C9.43476 32.0833 8.6929 31.776 8.14592 31.2291C7.59894 30.6821 7.29165 29.9402 7.29165 29.1667C7.29165 27.5479 8.58956 26.25 10.2083 26.25ZM23.3333 16.0417L27.3875 8.75H8.95415L12.3958 16.0417H23.3333Z" fill="#739FFC"/>
                </svg>

                <p class="text-[13px] font-medium text-[#3a63b8]">
                    Total Order ({{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }})
                </p>

                <h2 class="text-[20px] font-semibold text-[#3a63b8]">
                    {{ number_format($totalOrder, 0, ',', '.') }}
                </h2>
            </div>

            @php
                $totalProducts = \App\Models\Product::count();
            @endphp

            <div class="bg-[#FFF1EA] rounded-xl border border-[#F8A07A] h-[120px] flex flex-col items-center justify-center text-center gap-1">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32.0833 4.375H2.91663V13.125H4.37496V29.1667C4.37496 29.9402 4.68225 30.6821 5.22923 31.2291C5.77621 31.776 6.51808 32.0833 7.29163 32.0833H27.7083C28.4818 32.0833 29.2237 31.776 29.7707 31.2291C30.3177 30.6821 30.625 29.9402 30.625 29.1667V13.125H32.0833V4.375ZM5.83329 7.29167H29.1666V10.2083H5.83329V7.29167ZM27.7083 29.1667H7.29163V13.125H27.7083V29.1667ZM13.125 16.0417H21.875C21.875 16.8152 21.5677 17.5571 21.0207 18.1041C20.4737 18.651 19.7318 18.9583 18.9583 18.9583H16.0416C15.2681 18.9583 14.5262 18.651 13.9792 18.1041C13.4323 17.5571 13.125 16.8152 13.125 16.0417Z" fill="#F7783F"/>
                </svg>
                <p class="text-[13px] font-medium text-[#C94A14]">Total Produk</p>
                <h2 class="text-[20px] font-semibold text-[#C94A14]">{{ $totalProducts }}</h2>
            </div>

            <div class="bg-[#fff6d8] rounded-xl border border-[#f4c430] h-[120px] flex flex-col items-center justify-center text-center gap-1">
                <svg width="25" height="25" viewBox="0 0 15 15" fill="none"xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.9462 6.83183C15.0169 6.02194 14.4441 4.31527 13.1016 4.31527H10.6724C10.0585 4.31527 9.51621 3.9153 9.33488 3.32878L8.61073 0.986469C8.20409 -0.328848 6.3423 -0.328848 5.93566 0.986469L5.21151 3.32878C5.03018 3.9153 4.48788 4.31527 3.87397 4.31527H1.4028C0.0646122 4.31527 -0.510888 6.01283 0.551411 6.82663L2.66789 8.44802C3.13204 8.80359 3.32634 9.41018 3.15515 9.96926L2.38615 12.4808C1.98735 13.7833 3.49486 14.8304 4.5762 14.0021L6.4218 12.5882C6.92416 12.2033 7.62222 12.2033 8.12458 12.5882L9.95388 13.9896C11.0368 14.8191 12.5457 13.768 12.1428 12.4647L11.3631 9.9428C11.1891 9.37985 11.3862 8.76818 11.8561 8.41272L13.9462 6.83183Z"fill="#FFAD33"/>
                </svg>
                <p class="text-[13px] font-medium text-[#8a6d00]">Total Ulasan Pengguna</p>
                <h2 class="text-[20px] font-semibold text-[#8a6d00]">{{ $rataRating }}/5</h2>
                <p class="text-[11px] text-gray-600 -mt-1">dari {{ $jumlahUlasan }} ulasan</p>
            </div>

        </div>

        @include('admin.laporan.content')
    </div>
@endsection