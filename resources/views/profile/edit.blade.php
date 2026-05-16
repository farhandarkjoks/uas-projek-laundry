<x-app-layout>
    <style>
        [x-cloak] { 
            display: none !important; 
        }

        /* FIX ICON AGAR TIDAK KEPOTONG */
        .menu-icon svg,
        .info-icon svg {
            width: 20px;
            height: 20px;
            min-width: 20px;
            min-height: 20px;
            display: block;
            overflow: visible;
            stroke-width: 2;
        }

        .menu-icon,
        .info-icon {
            overflow: visible !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="bg-gray-50 min-h-screen py-8" x-data="{ 
        logoutModal: false, 
        editInfo: false,
        name: '{{ Auth::user()->name }}',
        email: '{{ Auth::user()->email }}',
        phone: '{{ Auth::user()->phone ?? '' }}'
    }">
        <div class="max-w-6xl mx-auto px-6">
            
            <div class="bg-white rounded-[2rem] p-6 mb-8 border border-gray-100 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-5">
                    <div class="w-20 h-20 bg-blue-600 rounded-2xl flex items-center justify-center text-3xl font-black text-white shadow-lg shadow-blue-100 shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold text-gray-900" x-text="name"></h1>
                        <p class="text-gray-500 font-medium" x-text="email"></p>

                        <div class="flex gap-2 mt-1">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold uppercase tracking-wider italic">
                                Member Silver
                            </span>
                        </div>
                    </div>
                </div>

                <button 
                    @click="editInfo = !editInfo" 
                    class="w-full md:w-auto px-8 py-3 rounded-2xl font-bold transition shadow-lg"
                    :class="editInfo ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-gray-900 text-white hover:bg-gray-800'"
                >
                    <span x-text="editInfo ? 'Batal Edit' : 'Edit Profil'"></span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                        Total Pesanan
                    </p>

                    <p class="text-3xl font-black text-blue-600">0</p>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                        Pesanan Aktif
                    </p>

                    <p class="text-3xl font-black text-blue-600">0</p>
                </div>

                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                        Total Bayar
                    </p>

                    <p class="text-3xl font-black text-blue-600">Rp 0</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- KIRI --}}
                <div class="space-y-6">

                    <h2 class="text-xl font-bold text-gray-900 px-2">
                        Informasi Akun
                    </h2>

                    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-6 space-y-6">

                        <div class="space-y-4">

                            {{-- NAMA --}}
                            <div class="flex items-center gap-4">
                                <div class="info-icon w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>

                                <div class="flex-1">
                                    <p class="text-xs font-bold text-gray-400">
                                        Nama Lengkap
                                    </p>

                                    <template x-if="!editInfo">
                                        <p class="text-gray-900 font-semibold" x-text="name"></p>
                                    </template>

                                    <template x-if="editInfo">
                                        <input 
                                            type="text" 
                                            x-model="name" 
                                            class="w-full mt-1 border-gray-200 rounded-xl text-sm focus:ring-blue-500"
                                        >
                                    </template>
                                </div>
                            </div>

                            {{-- EMAIL --}}
                            <div class="flex items-center gap-4">
                                <div class="info-icon w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <div class="flex-1">
                                    <p class="text-xs font-bold text-gray-400">
                                        Email
                                    </p>

                                    <template x-if="!editInfo">
                                        <p class="text-gray-900 font-semibold" x-text="email"></p>
                                    </template>

                                    <template x-if="editInfo">
                                        <input 
                                            type="email" 
                                            x-model="email" 
                                            class="w-full mt-1 border-gray-200 rounded-xl text-sm focus:ring-blue-500"
                                        >
                                    </template>
                                </div>
                            </div>

                            {{-- PHONE --}}
                            <div class="flex items-center gap-4">
                                <div class="info-icon w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>

                                <div class="flex-1">
                                    <p class="text-xs font-bold text-gray-400">
                                        Nomor WhatsApp
                                    </p>

                                    <template x-if="!editInfo">
                                        <p class="text-gray-900 font-semibold" x-text="phone || 'Belum diisi'"></p>
                                    </template>

                                    <template x-if="editInfo">
                                        <input 
                                            type="text" 
                                            x-model="phone" 
                                            placeholder="Contoh: 0812..." 
                                            class="w-full mt-1 border-gray-200 rounded-xl text-sm focus:ring-blue-500"
                                        >
                                    </template>
                                </div>
                            </div>

                            <div x-show="editInfo" x-cloak class="pt-4">
                                <button 
                                    @click="saveInfo($data)" 
                                    class="w-full py-3 bg-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-100 transition hover:bg-blue-700"
                                >
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>

                        <hr class="border-gray-50">

                        {{-- ALAMAT --}}
                        <div class="flex items-start gap-4" x-data="{ editing: false, address: '{{ Auth::user()->address ?? 'Alamat belum diisi' }}' }">

                            <div class="info-icon w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-blue-600 shrink-0">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>

                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <p class="text-xs font-bold text-gray-400">
                                        Alamat Pengiriman
                                    </p>

                                    <button 
                                        @click="editing = !editing" 
                                        class="text-xs text-blue-600 font-bold" 
                                        x-text="editing ? 'Batal' : 'Ubah'"
                                    ></button>
                                </div>

                                <div x-show="!editing" x-cloak>
                                    <p class="text-gray-900 font-semibold leading-relaxed" x-text="address"></p>
                                </div>

                                <div x-show="editing" x-cloak class="mt-2 space-y-3">
                                    <textarea 
                                        x-model="address" 
                                        class="w-full p-4 bg-gray-50 border-none rounded-2xl text-sm focus:ring-2 focus:ring-blue-500 font-medium" 
                                        rows="3"
                                    ></textarea>

                                    <div class="flex gap-2">
                                        <button 
                                            @click="handleGps($data)" 
                                            class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-xl text-xs font-bold flex items-center justify-center gap-2"
                                        >
                                            GPS
                                        </button>

                                        <button 
                                            @click="saveAddress(address)" 
                                            class="flex-[2] py-3 bg-blue-600 text-white rounded-xl text-xs font-bold shadow-lg"
                                        >
                                            Simpan Alamat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="space-y-6">

                    <h2 class="text-xl font-bold text-gray-900 px-2">
                        Lainnya
                    </h2>

                    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-4 space-y-2">

                        {{-- BANTUAN --}}
                        <a 
                            href="https://api.whatsapp.com/send/?phone=6281223513917&text=Halo+Admin+Rumah+Laundry..." 
                            target="_blank" 
                            class="flex items-center justify-between p-4 hover:bg-blue-50 rounded-2xl transition group"
                        >
                            <div class="flex items-center gap-4">

                                <div class="menu-icon w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            d="M8 5l7 7-7 7"
                                        />
                                    </svg>
                                </div>

                                <span class="font-bold text-gray-700">
                                    Bantuan Pelanggan
                                </span>
                            </div>
                        </a>

                        {{-- LOGOUT --}}
                        <button 
                            @click="logoutModal = true" 
                            class="w-full flex items-center justify-between p-4 hover:bg-red-50 rounded-2xl transition group text-left"
                        >
                            <div class="flex items-center gap-4">

                                <div class="menu-icon w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors shrink-0">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            d="M17 16l4-4m0 0l-4-4m4 4H9"
                                        />
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            d="M13 20v1a1 1 0 01-1 1H6a2 2 0 01-2-2V4a2 2 0 012-2h6a1 1 0 011 1v1"
                                        />
                                    </svg>
                                </div>

                                <span class="font-bold text-red-600">
                                    Keluar Akun
                                </span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL LOGOUT --}}
        <div 
            x-show="logoutModal" 
            x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        >
            <div class="bg-white rounded-[2rem] p-8 max-w-sm w-full text-center shadow-2xl">
                
                <h3 class="text-xl font-bold mb-2">
                    Keluar Akun?
                </h3>

                <p class="text-gray-500 mb-6">
                    Kamu perlu login kembali untuk melakukan pemesanan.
                </p>

                <div class="flex gap-3">

                    <button 
                        @click="logoutModal = false" 
                        class="flex-1 py-3 bg-gray-100 rounded-xl font-bold"
                    >
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf

                        <button 
                            type="submit" 
                            class="w-full py-3 bg-red-600 text-white rounded-xl font-bold"
                        >
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function saveInfo(alpineData) {
            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            fetch('{{ route("profile.update-info") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    name: alpineData.name,
                    email: alpineData.email,
                    phone: alpineData.phone
                })
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Profil Diperbarui!',
                    showConfirmButton: false,
                    timer: 1500
                });

                alpineData.editInfo = false;
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memperbarui profil'
                });
            });
        }

        function handleGps(alpineData) {
            Swal.fire({
                title: 'Mencari Lokasi...',
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {

                    const res = await fetch(
                        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`
                    );

                    const data = await res.json();

                    alpineData.address = data.display_name;

                    Swal.close();

                }, () => {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Izin Lokasi Ditolak'
                    });
                });
            }
        }

        function saveAddress(val) {
            Swal.fire({
                title: 'Menyimpan...',
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            fetch('{{ route("profile.update-address") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    address: val
                })
            })
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Alamat Tersimpan!',
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => window.location.reload(), 1500);
            });
        }
    </script>
</x-app-layout>