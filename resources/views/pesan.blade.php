<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8 relative" 
         x-data="{ 
            selected: [], 
            services: {{ Js::from($services) }},
            getTotal() {
                return this.selected.reduce((acc, item) => acc + (item.price * item.qty), 0);
            }
         }">

        @guest
        <div class="absolute inset-0 z-40 flex items-start justify-center pt-32 px-6">
            <div class="absolute inset-0 bg-white/30 backdrop-blur-[2px]"></div>
            
            <div class="relative bg-white p-8 rounded-[2.5rem] shadow-2xl border border-gray-100 text-center max-w-sm w-full animate-bounce-short">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-black text-gray-900 mb-2">Login Dulu Yuk!</h2>
                <p class="text-gray-500 text-sm mb-6 leading-relaxed">Kamu bisa melihat layanan kami, tetapi silakan login untuk mulai memesan.</p>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('login') }}" class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                        Login Sekarang
                    </a>
                </div>
            </div>
        </div>

        <style>
            @keyframes bounce-short {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .animate-bounce-short { animation: bounce-short 3s infinite; }
        </style>
        @endguest

        <div class="max-w-6xl mx-auto px-6 {{ Auth::check() ? '' : 'pointer-events-none select-none opacity-60' }}"> 
            
            <div class="mb-6 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight">Order Laundry</h1>
                    <p class="text-sm text-gray-500">Pilih layanan yang Anda butuhkan</p>
                </div>
                <div class="hidden md:block"> 
                    <span class="text-xs font-bold bg-blue-100 text-blue-700 px-3 py-1 rounded-full uppercase">Layanan Tasikmalaya</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                
                <div class="md:col-span-2 space-y-6">
                    @php
                        // Mengelompokkan array/collection $services berdasarkan kolom 'category'
                        $groupedServices = collect($services)->groupBy('category');
                    @endphp

                    @forelse($groupedServices as $category => $items)
                        <div class="space-y-3">
                            <h2 class="text-sm font-black text-gray-800 tracking-wide uppercase border-l-4 border-blue-600 pl-2">
                                {{ $category ? $category : 'Layanan Lainnya' }}
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($items as $s)
                                @php 
                                    // Amankan data tipe Object maupun Array dari DB Laragon
                                    $sId = data_get($s, 'id');
                                    $sName = data_get($s, 'name');
                                    $sPrice = data_get($s, 'price', 0);
                                    $sUnit = data_get($s, 'unit', 'kg');
                                @endphp
                                <div class="bg-white border rounded-2xl p-4 transition-all duration-300 hover:shadow-md"
                                     :class="selected.find(i => i.id === {{ $sId }}) ? 'border-blue-500 ring-1 ring-blue-50' : 'border-gray-200'">
                                    
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-xl shrink-0">
                                                @if(Str::contains(strtolower($sName), 'kiloan')) 👕 
                                                @elseif(Str::contains(strtolower($sName), ['selimut', 'bedcover', 'bantal', 'linen'])) 🛌
                                                @elseif(Str::contains(strtolower($sName), ['sepatu', 'tas'])) 👟 
                                                @else 🧺 @endif
                                            </div>
                                            <div>
                                                <h3 class="font-bold text-gray-900 text-sm leading-tight">{{ $sName }}</h3>
                                                <p class="text-xs text-blue-600 font-semibold mt-0.5">Rp {{ number_format($sPrice, 0, ',', '.') }} / {{ $sUnit }}</p>
                                            </div>
                                        </div>

                                        @php
                                            $isSingleUnit = Str::contains(strtolower($sUnit), ['pcs', 'satuan', 'pasang']);
                                            $step = $isSingleUnit ? 1 : 0.5;
                                        @endphp

                                        <div class="flex items-center gap-2 bg-gray-50 rounded-full p-1 scale-90" 
                                             x-data="{ qty: 0, step: {{ $step }} }"
                                             x-init="$watch('qty', value => {
                                                 let id = {{ $sId }};
                                                 let index = selected.findIndex(i => i.id === id);
                                                 if (value > 0) {
                                                     if (index === -1) {
                                                         selected.push({ id: id, name: '{{ $sName }}', price: {{ $sPrice }}, qty: value });
                                                     } else {
                                                         selected[index].qty = value;
                                                     }
                                                 } else if (index !== -1) {
                                                     selected.splice(index, 1);
                                                 }
                                             })">
                                            <button type="button" @click="if(qty > 0) qty -= step" class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-blue-600 font-bold text-lg">–</button>
                                            <span class="w-10 text-center text-xs font-bold text-gray-900" x-text="qty"></span>
                                            <button type="button" @click="qty += step" class="w-7 h-7 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-md shadow-blue-100">+</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-white rounded-2xl border border-dashed border-gray-300">
                            <p class="text-gray-500 font-medium text-sm">Layanan tidak tersedia di database lokal.</p>
                        </div>
                    @endforelse
                </div>

                <form action="{{ route('order.checkout') }}" method="POST" class="md:col-span-1 md:sticky md:top-6">
                    @csrf
                    <input type="hidden" name="items" :value="JSON.stringify(selected)">

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-4">
                        <h2 class="text-sm font-bold text-gray-800 border-b pb-3">Daftar Pesanan</h2>
                        
                        <div class="divide-y divide-gray-100 max-h-60 overflow-y-auto pr-1">
                            <template x-for="item in selected" :key="item.id">
                                <div class="py-3 flex justify-between items-center text-sm">
                                    <div>
                                        <p class="font-bold text-gray-800" x-text="item.name"></p>
                                        <p class="text-xs text-gray-400" x-text="item.qty + 'x'"></p>
                                    </div>
                                    <p class="font-semibold text-gray-900" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(item.price * item.qty)"></p>
                                </div>
                            </template>
                            
                            <div x-show="selected.length === 0" class="py-6 text-center text-xs text-gray-400">
                                Belum ada layanan yang dipilih.
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs font-semibold text-gray-500">Total harga:</span>
                            <span class="text-lg font-black text-blue-600" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(getTotal())"></span>
                        </div>

                        <button type="submit"
                                :disabled="selected.length === 0" 
                                class="w-full py-3.5 bg-blue-600 disabled:bg-gray-200 text-white disabled:text-gray-400 rounded-xl font-bold text-sm shadow-md shadow-blue-50 transition-all active:scale-[0.98] block text-center">
                            Lanjutkan ke Checkout
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>