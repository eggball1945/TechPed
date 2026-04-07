<div id="notifDropdown"
    class="fixed sm:absolute inset-x-4 sm:inset-auto sm:right-0 top-[70px] sm:top-auto sm:mt-3 w-auto sm:w-[360px] bg-white rounded-2xl shadow-2xl border border-gray-100/80
        invisible opacity-0 scale-95 transition-all duration-200 origin-top sm:origin-top-right
        z-[9999]">
    <div class="p-4 border-b border-gray-100">
        <h3 class="font-semibold text-base text-gray-900">Notifikasi</h3>
    </div>

    <div class="px-4 py-3 border-b border-gray-100">
        <span class="font-semibold text-sm text-violet-700">Transaksi</span>
        <div class="flex justify-between items-center mt-1">
            <span class="text-xs text-gray-500">Status Pesanan</span>
            <a href="{{ route('orders') }}" class="text-xs text-violet-600 hover:text-violet-800 font-medium">Lihat
                Semua</a>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-2 px-4 py-3 border-b border-gray-100">
        <a href="{{ route('orders', ['status' => 'tertunda']) }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-violet-50 transition-colors">
                <svg width="24" height="24" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.0005 2.49976C13.359 2.49976 11.7335 2.82308 10.2169 3.45126C8.70038 4.07945 7.32239 5.00019 6.16165 6.16092C3.81745 8.50513 2.50049 11.6845 2.50049 14.9998C2.50049 18.315 3.81745 21.4944 6.16165 23.8386C7.32239 24.9993 8.70038 25.9201 10.2169 26.5483C11.7335 27.1764 13.359 27.4998 15.0005 27.4998C18.3157 27.4998 21.4951 26.1828 23.8393 23.8386C26.1835 21.4944 27.5005 18.315 27.5005 14.9998C27.5005 13.3582 27.1772 11.7328 26.549 10.2162C25.9208 8.69964 25.0001 7.32165 23.8393 6.16092C22.6786 5.00019 21.3006 4.07945 19.784 3.45126C18.2675 2.82308 16.642 2.49976 15.0005 2.49976ZM20.2505 20.2498L13.7505 16.2498V8.74976H15.6255V15.2498L21.2505 18.6248L20.2505 20.2498Z"
                        fill="#6D28D9" />
                </svg>
            </div>
            <span class="text-[11px] text-gray-600 text-center leading-tight">Menunggu</span>
        </a>
        <a href="{{ route('orders', ['status' => 'diproses']) }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-violet-50 transition-colors">
                <svg width="24" height="24" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.7812 10.625H5.15625C4.82473 10.625 4.50679 10.4933 4.27237 10.2589C4.03795 10.0245 3.90625 9.70652 3.90625 9.375V3.75C3.90625 3.41848 4.03795 3.10054 4.27237 2.86612C4.50679 2.6317 4.82473 2.5 5.15625 2.5C5.48777 2.5 5.80571 2.6317 6.04013 2.86612C6.27455 3.10054 6.40625 3.41848 6.40625 3.75V8.125H10.7812C11.1128 8.125 11.4307 8.2567 11.6651 8.49112C11.8996 8.72554 12.0312 9.04348 12.0312 9.375C12.0312 9.70652 11.8996 10.0245 11.6651 10.2589C11.4307 10.4933 11.1128 10.625 10.7812 10.625Z"
                        fill="#6D28D9" />
                    <path
                        d="M26.25 16.25C25.9185 16.25 25.6005 16.1183 25.3661 15.8839C25.1317 15.6495 25 15.3315 25 15C25.001 12.7994 24.2756 10.6601 22.9364 8.91389C21.5972 7.16771 19.7191 5.91237 17.5935 5.34266C15.468 4.77295 13.2138 4.92073 11.1809 5.76306C9.14787 6.6054 7.44975 8.09519 6.35 10.0013C6.18391 10.2882 5.91064 10.4974 5.5903 10.5828C5.26997 10.6683 4.92881 10.623 4.64188 10.4569C4.35495 10.2908 4.14575 10.0175 4.0603 9.69718C3.97485 9.37685 4.02016 9.03569 4.18625 8.74876C5.56157 6.36655 7.68461 4.50481 10.226 3.45236C12.7674 2.39992 15.5851 2.21559 18.242 2.92799C20.8988 3.64039 23.2463 5.20968 24.9203 7.39242C26.5942 9.57515 27.501 12.2493 27.5 15C27.5 15.3315 27.3683 15.6495 27.1339 15.8839C26.8995 16.1183 26.5815 16.25 26.25 16.25ZM24.8438 27.5C24.5122 27.5 24.1943 27.3683 23.9599 27.1339C23.7254 26.8995 23.5938 26.5815 23.5938 26.25V21.875H19.2188C18.8872 21.875 18.5693 21.7433 18.3349 21.5089C18.1004 21.2745 17.9688 20.9565 17.9688 20.625C17.9688 20.2935 18.1004 19.9755 18.3349 19.7411C18.5693 19.5067 18.8872 19.375 19.2188 19.375H24.8438C25.1753 19.375 25.4932 19.5067 25.7276 19.7411C25.9621 19.9755 26.0938 20.2935 26.0938 20.625V26.25C26.0938 26.5815 25.9621 26.8995 25.7276 27.1339C25.4932 27.3683 25.1753 27.5 24.8438 27.5Z"
                        fill="#6D28D9" />
                    <path
                        d="M15 27.5C11.6858 27.4967 8.50831 26.1787 6.16482 23.8352C3.82133 21.4917 2.50331 18.3142 2.5 15C2.5 14.6685 2.6317 14.3505 2.86612 14.1161C3.10054 13.8817 3.41848 13.75 3.75 13.75C4.08152 13.75 4.39946 13.8817 4.63388 14.1161C4.8683 14.3505 5 14.6685 5 15C4.99905 17.2006 5.72445 19.3399 7.06363 21.0861C8.40282 22.8323 10.2809 24.0876 12.4065 24.6573C14.532 25.2271 16.7862 25.0793 18.8191 24.2369C20.8521 23.3946 22.5502 21.9048 23.65 19.9987C23.7322 19.8567 23.8417 19.7322 23.972 19.6324C24.1024 19.5326 24.2511 19.4595 24.4097 19.4172C24.5683 19.3749 24.7337 19.3642 24.8964 19.3858C25.0592 19.4074 25.2161 19.4609 25.3581 19.5431C25.5002 19.6254 25.6247 19.7348 25.7245 19.8651C25.8243 19.9955 25.8974 20.1442 25.9397 20.3028C25.982 20.4614 25.9927 20.6268 25.9711 20.7896C25.9494 20.9523 25.896 21.1092 25.8137 21.2512C24.7146 23.147 23.1377 24.7216 21.2403 25.818C19.343 26.9144 17.1914 27.4943 15 27.5Z"
                        fill="#6D28D9" />
                </svg>
            </div>
            <span class="text-[11px] text-gray-600 text-center leading-tight">Proses</span>
        </a>
        <a href="{{ route('orders', ['status' => 'dikirim']) }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-violet-50 transition-colors">
                <svg width="24" height="24" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3 7.5C3 5.84531 4.34531 4.5 6 4.5H19.5C21.1547 4.5 22.5 5.84531 22.5 7.5V9H24.8766C25.6734 9 26.4375 9.31406 27 9.87656L29.1234 12C29.6859 12.5625 30 13.3266 30 14.1234V21C30 22.6547 28.6547 24 27 24H26.8453C26.3578 25.7297 24.7641 27 22.875 27C20.9859 27 19.3969 25.7297 18.9047 24H14.0953C13.6078 25.7297 12.0141 27 10.125 27C8.23594 27 6.64688 25.7297 6.15469 24H6C4.34531 24 3 22.6547 3 21V18.75H1.125C0.501562 18.75 0 18.2484 0 17.625C0 17.0016 0.501562 16.5 1.125 16.5H6.375C6.99844 16.5 7.5 15.9984 7.5 15.375C7.5 14.7516 6.99844 14.25 6.375 14.25H1.125C0.501562 14.25 0 13.7484 0 13.125C0 12.5016 0.501562 12 1.125 12H9.375C9.99844 12 10.5 11.4984 10.5 10.875C10.5 10.2516 9.99844 9.75 9.375 9.75H1.125C0.501562 9.75 0 9.24844 0 8.625C0 8.00156 0.501562 7.5 1.125 7.5H3ZM27 16.5V14.1234L24.8766 12H22.5V16.5H27ZM12 22.875C12 21.8391 11.1609 21 10.125 21C9.08906 21 8.25 21.8391 8.25 22.875C8.25 23.9109 9.08906 24.75 10.125 24.75C11.1609 24.75 12 23.9109 12 22.875ZM22.875 24.75C23.9109 24.75 24.75 23.9109 24.75 22.875C24.75 21.8391 23.9109 21 22.875 21C21.8391 21 21 21.8391 21 22.875C21 23.9109 21.8391 24.75 22.875 24.75Z"
                        fill="#6D28D9" />
                </svg>
            </div>
            <span class="text-[11px] text-gray-600 text-center leading-tight">Dikirim</span>
        </a>
        <a href="{{ route('orders', ['status' => 'selesai']) }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-violet-50 transition-colors">
                <svg width="24" height="24" viewBox="0 0 19 25" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.25 11.875C8.37384 11.875 7.53356 11.5458 6.91402 10.9597C6.29448 10.3737 5.94643 9.5788 5.94643 8.75C5.94643 7.9212 6.29448 7.12634 6.91402 6.54029C7.53356 5.95424 8.37384 5.625 9.25 5.625C10.1262 5.625 10.9664 5.95424 11.586 6.54029C12.2055 7.12634 12.5536 7.9212 12.5536 8.75C12.5536 9.16038 12.4681 9.56674 12.3021 9.94589C12.1361 10.325 11.8927 10.6695 11.586 10.9597C11.2792 11.2499 10.915 11.4801 10.5142 11.6371C10.1134 11.7942 9.68383 11.875 9.25 11.875ZM9.25 0C6.79675 0 4.44397 0.921872 2.70926 2.56282C0.974551 4.20376 0 6.42936 0 8.75C0 15.3125 9.25 25 9.25 25C9.25 25 18.5 15.3125 18.5 8.75C18.5 6.42936 17.5254 4.20376 15.7907 2.56282C14.056 0.921872 11.7033 0 9.25 0Z"
                        fill="#6D28D9" />
                </svg>
            </div>
            <span class="text-[11px] text-gray-600 text-center leading-tight">Selesai</span>
        </a>
    </div>

    <div class="px-4 py-3 border-b border-gray-100">
        <div class="flex justify-between items-center">
            <span class="font-medium text-sm text-violet-700">Untuk Kamu</span>
        </div>
    </div>

    <div class="max-h-[280px] overflow-y-auto rounded-2xl bg-white">
        @forelse(auth()->user()->notifications()->orderBy('created_at', 'desc')->take(5)->get() as $notification)
            <div class="px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0 group"
                data-notification-id="{{ $notification->id }}">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <div class="w-2 h-2 rounded-full bg-violet-500"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start">
                            <p class="text-xs font-medium text-gray-900">
                                {{ $notification->data['title'] ?? 'Notifikasi' }}</p>
                            <button type="button"
                                class="delete-notif opacity-0 group-hover:opacity-100 transition text-gray-400 hover:text-red-500 text-xs"
                                data-id="{{ $notification->id }}">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">{{ $notification->data['message'] ?? '' }}
                        </p>
                        <div class="flex justify-between items-center mt-1">
                            <p class="text-[10px] text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                            @if (isset($notification->data['order_id']))
                                <a href="{{ route('orders', $notification->data['order_id']) }}"
                                    class="text-[10px] text-violet-600 hover:text-violet-800">Lihat Pesanan</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center py-8 px-4">
                <svg class="w-12 h-12 text-gray-300 mb-3" viewBox="0 0 60 60" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M37.0752 47.5C36.5587 48.9638 35.6008 50.2314 34.3337 51.128C33.0665 52.0246 31.5525 52.5061 30.0002 52.5061C28.4479 52.5061 26.9338 52.0246 25.6667 51.128C24.3995 50.2314 23.4417 48.9638 22.9252 47.5H37.0752ZM30.0002 5.00001C34.6415 5.00001 39.0927 6.84375 42.3746 10.1256C45.6564 13.4075 47.5002 17.8587 47.5002 22.5V31.32C47.5006 31.708 47.5913 32.0906 47.7652 32.4375L52.0552 41.02C52.2649 41.4393 52.3639 41.9052 52.3428 42.3736C52.3218 42.8419 52.1813 43.2971 51.9348 43.6959C51.6884 44.0946 51.344 44.4238 50.9345 44.652C50.525 44.8803 50.064 45.0001 49.5952 45H48.5352L51.2127 47.6775C51.6681 48.149 51.9201 48.7805 51.9144 49.436C51.9087 50.0915 51.6458 50.7185 51.1822 51.1821C50.7187 51.6456 50.0917 51.9085 49.4362 51.9142C48.7807 51.9199 48.1492 51.6679 47.6777 51.2125L8.78769 12.325C8.54892 12.0944 8.35846 11.8185 8.22744 11.5135C8.09642 11.2085 8.02745 10.8805 8.02457 10.5485C8.02168 10.2166 8.08494 9.88736 8.21064 9.58012C8.33634 9.27288 8.52197 8.99375 8.7567 8.75902C8.99144 8.52429 9.27057 8.33865 9.57781 8.21295C9.88505 8.08725 10.2142 8.024 10.5462 8.02688C10.8781 8.02976 11.2062 8.09873 11.5112 8.22975C11.8162 8.36077 12.0921 8.55123 12.3227 8.79001L15.8027 12.27C17.4227 10.0181 19.5555 8.18426 22.0247 6.92008C24.4939 5.6559 27.2287 4.99773 30.0027 5.00001M12.5577 21.0675L36.4902 45H10.4052C9.93639 45.0001 9.47535 44.8803 9.06586 44.652C8.65637 44.4238 8.31204 44.0946 8.06555 43.6959C7.81907 43.2971 7.67863 42.8419 7.65756 42.3736C7.6365 41.9052 7.73551 41.4393 7.94519 41.02L12.2377 32.4375C12.4107 32.0904 12.5006 31.7078 12.5002 31.32V22.5C12.5002 22.0167 12.5194 21.5392 12.5577 21.0675Z"
                        fill="currentColor" />
                </svg>
                <span class="text-xs text-gray-500">Belum ada notifikasi</span>
            </div>
        @endforelse
    </div>
</div>
