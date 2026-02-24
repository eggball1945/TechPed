<div class="w-[1100px] h-14 bg-white flex items-center px-6 border-b border-gray-300/70">
    <div class="flex items-center gap-2 ml-auto">

        <svg width="1" height="30" viewBox="0 0 1 30" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.3" d="M0.5 0V30" stroke="black" stroke-opacity="0.4"/>
        </svg>

        <div class="w-[30px] h-[30px] bg-violet-700 rounded-full flex items-center justify-center relative">
            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="30" height="30" rx="15" fill="#6D28D9" fill-opacity="0.5"/>
                <path d="M19.6875 21.5625V20C19.6875 19.1712 19.3978 18.3763 18.882 17.7903C18.3663 17.2042 17.6668 16.875 16.9375 16.875H12.125C11.3957 16.875 10.6962 17.2042 10.1805 17.7903C9.66473 18.3763 9.375 19.1712 9.375 20V21.5625" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 14.0625C16.5533 14.0625 17.8125 12.8033 17.8125 11.25C17.8125 9.6967 16.5533 8.4375 15 8.4375C13.4467 8.4375 12.1875 9.6967 12.1875 11.25C12.1875 12.8033 13.4467 14.0625 15 14.0625Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <span class="text-[10px] font-medium text-black">
            {{ Auth::guard('petugas')->user()->username }}
        </span>

    </div>
</div>
<script>
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let items = document.querySelectorAll('.search-item');

    items.forEach(item => {
        let text = item.dataset.search;
        item.style.display = text.includes(keyword) ? 'block' : 'none';
    });
});
</script>