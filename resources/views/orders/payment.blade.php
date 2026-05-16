<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-6">
            
            <div class="mb-6">
                <h1 class="text-2xl font-black text-gray-900 tracking-tight">Checkout Pesanan</h1>
                <p class="text-sm text-gray-500">Selesaikan detail pesanan laundry Anda</p>
            </div>

            <form action="{{ route('order.store') }}" method="POST" 
                  x-data="{ 
                      paymentMethod: 'transfer', 
                      deliveryType: 'Bawa Sendiri',
                      userPhone: '{{ auth()->user()->phone ?? '' }}',
                      userAddress: '{{ auth()->user()->address ?? '' }}',
                      services: {{ json_encode($items) }},
                      get serviceTotal() {
                          return {{ $totalPrice }};
                      },
                      get deliveryFee() {
                          return this.deliveryType === 'Antar Jemput' ? 10000 : 0;
                      },
                      get grandTotal() {
                          return this.serviceTotal + this.deliveryFee;
                      }
                  }" 
                  class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                @csrf
                
                <input type="hidden" name="items" value="{{ json_encode($items) }}">

                <div class="md:col-span-2 space-y-4">
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                        <h2 class="text-base font-black text-gray-900 mb-4 tracking-tight">Detail Pesanan</h2>
                        
                        <div class="divide-y divide-gray-100">
                            @foreach($items as $item)
                            <div class="py-4 flex items-center justify-between first:pt-0 last:pb-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                                        @if(Str::contains(strtolower($item['name']), 'kiloan')) 👕 
                                        @elseif(Str::contains(strtolower($item['name']), 'selimut')) 🛌
                                        @else 👟 @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-sm leading-tight">{{ $item['name'] }}</h4>
                                        <span class="inline-block mt-1 text-xs px-2 py-0.5 bg-blue-50 text-blue-600 font-bold rounded-md">Pasti Bersih</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-gray-900 text-sm">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5" x-text="'{{ $item['qty'] }} x'"></p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 space-y-4 md:sticky md:top-6">
                    
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Metode Penyerahan</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="border-2 rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer transition text-center"
                                   :class="deliveryType === 'Bawa Sendiri' ? 'border-blue-600 bg-blue-50/40 text-blue-700 font-bold' : 'border-gray-200 text-gray-500'">
                                <input type="radio" name="delivery_type" value="Bawa Sendiri" x-model="deliveryType" class="hidden">
                                <span class="text-xl mb-1">🏠</span>
                                <span class="text-xs font-bold">Bawa Sendiri</span>
                            </label>
                            
                            <label class="border-2 rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer transition text-center"
                                   :class="deliveryType === 'Antar Jemput' ? 'border-blue-600 bg-blue-50/40 text-blue-700 font-bold' : 'border-gray-200 text-gray-500'">
                                <input type="radio" name="delivery_type" value="Antar Jemput" x-model="deliveryType" class="hidden">
                                <span class="text-xl mb-1">🛵</span>
                                <span class="text-xs font-bold">Antar Jemput</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Metode Pembayaran</h3>
                        
                        <div class="space-y-2">
                            <label class="border rounded-xl p-3 flex items-center justify-between cursor-pointer transition"
                                   :class="paymentMethod === 'transfer' ? 'border-blue-500 bg-blue-50/20' : 'border-gray-200'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="transfer" x-model="paymentMethod" class="hidden">
                                    <span class="text-lg">🏦</span>
                                    <span class="text-xs font-bold text-gray-800">Transfer Bank (Manual)</span>
                                </div>
                                <div class="w-4 h-4 rounded-full border flex items-center justify-center" :class="paymentMethod === 'transfer' ? 'border-blue-600' : 'border-gray-300'">
                                    <div class="w-2 h-2 rounded-full bg-blue-600" x-show="paymentMethod === 'transfer'"></div>
                                </div>
                            </label>

                            <label class="border rounded-xl p-3 flex items-center justify-between cursor-pointer transition"
                                   :class="paymentMethod === 'tunai' ? 'border-blue-500 bg-blue-50/20' : 'border-gray-200'">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="payment_method" value="tunai" x-model="paymentMethod" class="hidden">
                                    <span class="text-lg">💵</span>
                                    <span class="text-xs font-bold text-gray-800">Tunai / Cash</span>
                                </div>
                                <div class="w-4 h-4 rounded-full border flex items-center justify-center" :class="paymentMethod === 'tunai' ? 'border-blue-600' : 'border-gray-300'">
                                    <div class="w-2 h-2 rounded-full bg-blue-600" x-show="paymentMethod === 'tunai'"></div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <div class="flex items-center gap-2 border-b pb-2 border-gray-100">
                            <span class="text-lg">📞</span>
                            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Informasi Kontak</h3>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-500">Nomor HP / WhatsApp Aktif</label>
                            <input type="text" name="user_phone" x-model="userPhone" required
                                   class="w-full text-sm bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-100 transition" 
                                   placeholder="Contoh: 081234567xxx">
                        </div>
                    </div>

                    <div x-show="deliveryType === 'Antar Jemput'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="bg-white border border-blue-100 rounded-2xl p-5 shadow-sm space-y-3">
                        
                        <div class="flex items-center gap-2 border-b pb-2 border-gray-100">
                            <span class="text-lg">📍</span>
                            <h3 class="text-xs font-bold text-blue-800 uppercase tracking-wider">Alamat Penjemputan</h3>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-500">Detail Alamat</label>
                            <textarea name="delivery_address" x-model="userAddress" rows="3" 
                                      :required="deliveryType === 'Antar Jemput'"
                                      class="w-full text-sm bg-gray-50 border border-gray-200 rounded-xl p-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-100 transition resize-none leading-relaxed"
                                      placeholder="Tulis alamat penjemputan lengkap..."></textarea>
                            
                            <p class="text-[10px] text-gray-400 flex items-center gap-1 mt-1 leading-normal">
                                <span>ℹ️</span>
                                <span>Alamat ini diambil dari profil Anda. Untuk mengubahnya secara permanen, silakan sesuaikan di halaman <strong>Pengaturan Profil</strong>.</span>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm space-y-3">
                        <h3 class="text-xs font-bold text-gray-800 border-b pb-2">Detail Pembayaran</h3>
                        
                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between text-gray-500">
                                <span>Total Pesanan</span>
                                <span class="font-semibold text-gray-900">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between text-gray-500" x-show="deliveryType === 'Antar Jemput'">
                                <span>Biaya Antar Jemput</span>
                                <span class="font-semibold text-gray-900">Rp 10.000</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-800">Total Pembayaran:</span>
                            <span class="text-lg font-black text-blue-600" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal)"></span>
                        </div>

                        <button type="submit" 
                                class="w-full mt-2 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-md transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span>Pesan Sekarang</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>