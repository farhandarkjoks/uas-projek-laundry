<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-2xl mx-auto px-6">
            
            <div class="bg-white border border-gray-200 rounded-[2.5rem] p-8 md:p-10 shadow-sm text-center space-y-6">
                
                <div class="mx-auto w-20 h-20 bg-green-50 text-green-500 rounded-3xl flex items-center justify-center text-4xl">
                    🎉
                </div>

                <div>
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight">Pesanan Berhasil Dibuat!</h1>
                    <p class="text-sm text-gray-400 mt-1">Nomor Nota: <span class="font-bold text-gray-800">#{{ $transaction->invoice_code }}</span></p>
                </div>

                <div class="bg-gray-50 border border-gray-100 rounded-3xl p-5 text-left divide-y divide-gray-200/60 text-sm">
                    <div class="pb-3 flex justify-between items-center text-gray-500">
                        <span>Metode Penyerahan</span>
                        <span class="font-bold text-gray-900 bg-white px-3 py-1 rounded-lg border border-gray-100">{{ $transaction->delivery_type }}</span>
                    </div>
                    <div class="py-3 flex justify-between items-center text-gray-500">
                        <span>Metode Pembayaran</span>
                        <span class="font-bold text-gray-900">
                            {{ $transaction->payment_method === 'transfer' ? '🏦 Transfer Bank (Manual)' : '💵 Tunai / Cash' }}
                        </span>
                    </div>
                    <div class="pt-3 flex justify-between items-center">
                        <span class="font-bold text-gray-800">Total Pembayaran</span>
                        <span class="text-2xl font-black text-blue-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($transaction->payment_method === 'transfer')
                <div class="border-t border-dashed border-gray-200 pt-8 text-left space-y-5">
                    
                    <div class="flex items-center gap-3 text-amber-700 font-bold text-xs bg-amber-50 p-4 rounded-2xl border border-amber-100 leading-relaxed">
                        <span class="text-xl">⚠️</span>
                        <p>Pesanan akan diproses setelah Anda melakukan transfer dan admin memverifikasi bukti pembayaran.</p>
                    </div>

                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest px-1">Informasi Rekening</h3>
                    
                    <div class="bg-blue-600 rounded-[2rem] p-6 text-white shadow-xl shadow-blue-100 space-y-4 relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 w-32 h-32 bg-blue-500 rounded-full opacity-50"></div>
                        
                        <div class="relative z-10">
                            <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest">Bank Tujuan</p>
                            <h2 class="text-xl font-black italic">BANK BCA</h2>
                        </div>

                        <div class="relative z-10 flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest">Nomor Rekening</p>
                                <p class="text-2xl font-black tracking-[0.2em]" id="norek">1320495831</p>
                            </div>
                            <button onclick="copyToClipboard('1320495831')" 
                                    class="bg-white/20 hover:bg-white/30 backdrop-blur-md text-white px-4 py-2 rounded-xl text-xs font-bold transition active:scale-95 border border-white/30">
                                Salin
                            </button>
                        </div>

                        <div class="relative z-10 border-t border-white/20 pt-3">
                            <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest">Atas Nama</p>
                            <p class="font-bold">Rumah Laundry Tasikmalaya</p>
                        </div>
                    </div>

                    <div class="space-y-3 px-1">
                        <h4 class="text-sm font-black text-gray-800">Langkah Pembayaran:</h4>
                        <ul class="text-xs text-gray-500 space-y-3">
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">1</span>
                                <span>Transfer tepat <strong class="text-gray-800">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong> ke rekening BCA di atas.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">2</span>
                                <span>Screenshot atau simpan bukti transfer Anda.</span>
                            </li>
                            <li class="flex gap-3">
                                <span class="flex-shrink-0 w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">3</span>
                                <span>Buka menu riwayat transaksi untuk upload bukti pembayaran.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <div class="border-t border-dashed border-gray-200 pt-8 text-left">
                    <div class="bg-gray-50 border border-gray-200 rounded-[2rem] p-6 flex items-start gap-4">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-gray-100">
                            💵
                        </div>
                        <div class="text-xs text-gray-500 leading-relaxed">
                            <p class="font-black text-gray-800 text-sm mb-1 uppercase tracking-tight">Pembayaran Tunai</p>
                            <p>Siapkan uang tunai sebesar <strong class="text-gray-900 font-bold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>. Pembayaran dilakukan saat penyerahan pakaian kepada kurir atau petugas outlet kami.</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="pt-6 flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('/dashboard') }}" 
                       class="flex-1 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl text-sm shadow-xl shadow-blue-100 transition-all active:scale-[0.98] text-center">
                        Cek Status Laundry
                    </a>
                    <a href="{{ url('/') }}" 
                       class="flex-1 py-4 bg-white border-2 border-gray-100 text-gray-600 font-bold rounded-2xl text-sm hover:bg-gray-50 transition-all text-center">
                        Kembali ke Home
                    </a>
                </div>

            </div>

            <p class="text-center text-[11px] text-gray-400 mt-8 leading-relaxed">
                Butuh bantuan? Hubungi WhatsApp Customer Service kami di <br>
                <a href="#" class="text-blue-500 font-bold hover:underline">0812-3456-7890</a>
            </p>

        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor rekening berhasil disalin!');
            }).catch(err => {
                console.error('Gagal menyalin teks: ', err);
            });
        }
    </script>
</x-app-layout>