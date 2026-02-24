<div class="max-w-6xl mx-auto flex gap-12 items-start">

    {{-- SIDEBAR --}}
    <aside class="w-60 shrink-0">
        <div class="mb-8">
            <span class="font-medium block mb-3">Kelola Akun Saya</span>
            <a href="{{ route('profile.edit') }}" class="text-black">Profil Saya</a>
        </div>

        <a href="{{ route('cart') }}" class="font-medium">Keranjang Saya</a>
    </aside>

    {{-- KONTEN --}}
    <section class="flex-1">
            <div class="bg-white rounded-xl shadow-xl p-8 w-full">

                <h2 class="text-xl font-semibold text-violet-700 mb-6">
                    Edit Profil
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-8">
                    @csrf

                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <label>Nama</label>
                            <input type="text" name="nama_depan"
                                value="{{ old('nama_depan', $user->nama_depan) }}"
                                class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm
                                focus:outline-none focus:ring-0 focus:border-violet-600
                                ">
                        </div>

                        <div>
                            <label>Email</label>
                            <input type="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm
                                focus:outline-none focus:ring-0 focus:border-violet-600
                                hover:border-gray-300">
                        </div>

                        <div>
                            <label>No Telepon</label>
                            <input name="no_telepon"
                                value="{{ old('no_telepon', $user->no_telepon) }}"
                                class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm
                                focus:outline-none focus:ring-0 focus:border-violet-600
                                ">
                        </div>
                    </div>

                    <div>
                        <label>Alamat</label>
                        <textarea name="alamat" rows="4" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600 resize-none" placeholder="Masukkan alamat lengkap">{{ old('alamat', optional($user->address)->alamat) }}</textarea>
                    </div>


                    <div class="grid grid-cols-3 gap-6">
                        <input name="kota" placeholder="Kota" value="{{ old('kota', optional($user->address)->kota) }}" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600">
                        <input name="provinsi" placeholder="Provinsi" value="{{ old('provinsi', optional($user->address)->provinsi) }}" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600">
                        <input name="kode_pos" placeholder="Kode Pos" value="{{ old('kode_pos', optional($user->address)->kode_pos) }}" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600">
                    </div>

                    <div class="max-w-md flex flex-col gap-4">
                        <span class="font-medium">Ubah Password</span>

                        <p class="text-[12px] text-black">
                            Biarkan kolom password kosong jika Anda tidak ingin mengubah password.
                        </p>

                        <input type="password" id="current_password" name="current_password" placeholder="Password Saat Ini" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600">

                            @error('current_password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror


                        <input type="password" id="password" name="password" placeholder="Password Baru" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600">

                            @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru" class="w-full rounded-lg border bg-neutral-100 border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-violet-600">

                        <label class="flex items-center gap-2 text-sm cursor-pointer">
                            <input type="checkbox" onclick="toggleAllPasswords(this)" class="accent-violet-700 w-4 h-4">
                            Lihat password
                        </label>
                    </div>

                    <div class="flex gap-6 items-center">
                        <a href="{{ url()->previous() }}">Batal</a>
                        <button class="bg-violet-700 text-white px-10 py-3 rounded">
                            Simpan Perubahan
                        </button>
                    </div>

                    @if(session('success'))
                        <p class="text-green-600">{{ session('success') }}</p>
                    @endif

                </form>
            </div>
    </section>
</div>

<script>
function toggleAllPasswords(checkbox) {
const passwordFields = document.querySelectorAll('input[type="password"], input[data-password]');

    passwordFields.forEach(input => {
        if (checkbox.checked) {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    });
}
</script>