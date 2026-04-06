<div class="w-full lg:w-[380px] lg:sticky lg:top-28 self-start mt-8 lg:mt-0 animate-fade-in-up" style="animation-delay: 200ms">
    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-violet-100/50 p-8 border border-gray-50 relative overflow-hidden group">
        {{-- Decorative background --}}
        <div class="absolute -top-12 -right-12 w-32 h-32 bg-violet-600 rounded-full blur-[60px] opacity-10 group-hover:opacity-20 transition-opacity"></div>
        
        <h2 class="text-2xl font-black text-gray-900 mb-8 relative z-10">Ringkasan <span class="text-violet-700">Belanja</span></h2>
        
        <div class="space-y-5 mb-8 relative z-10">
            <div class="flex justify-between items-center text-sm">
                <span class="font-bold text-gray-400 uppercase tracking-widest text-[10px]">Total Produk</span>
                <span id="subtotal-display" class="font-black text-gray-900">Rp 0</span>
            </div>
            <div class="flex justify-between items-center text-sm hidden">
                <span class="font-bold text-gray-400 uppercase tracking-widest text-[10px]">Diskon Hemat</span>
                <span id="discount-display" class="font-black text-emerald-600">-Rp 0</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="font-bold text-gray-400 uppercase tracking-widest text-[10px]">Ongkos Kirim</span>
                <div class="flex items-center gap-1.5 px-3 py-1 bg-violet-50 rounded-lg">
                    <span class="text-[10px] font-black text-violet-700 uppercase">Dihitung di Checkout</span>
                </div>
            </div>
        </div>
        
        <div class="border-t-2 border-dashed border-gray-100 pt-6 mb-10 relative z-10">
            <div class="flex justify-between items-end">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Tagihan</p>
                    <span id="total-display" class="text-3xl font-black text-violet-700 leading-none tracking-tighter">Rp 0</span>
                </div>
                {{-- <div class="text-[10px] font-bold text-gray-400 italic">PPN 11% Included</div> --}}
            </div>
        </div>
        
        <button id="checkout-selected" data-selected="" class="w-full bg-violet-700 hover:shadow-2xl hover:shadow-violet-200 text-white font-black py-5 px-6 rounded-2xl transition-all duration-300 transform active:scale-[0.98] flex items-center justify-center gap-3 mb-6 group/btn shadow-lg shadow-violet-100 uppercase tracking-widest text-xs">
            <span>Proses Checkout</span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
        
        <a href="{{ route('user.products') }}" class="flex items-center justify-center gap-2 text-xs font-black text-gray-400 hover:text-violet-700 transition-colors uppercase tracking-widest group/back">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Lanjut Belanja</span>
        </a>
    </div>
</div>