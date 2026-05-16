<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            
            <div class="text-center mb-20">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                    Layanan <span class="text-blue-600">Rumah Laundry</span>
                </h1>
                <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                    Daftar layanan profesional kami untuk warga Tasikmalaya.
                </p>
            </div>

            @if(empty($services))
                <div class="text-center py-20 bg-gray-50 rounded-[2.5rem] border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 text-lg italic">Belum ada data layanan yang tersedia saat ini.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $s)
                    <div class="group bg-white border border-gray-100 p-8 rounded-[2.5rem] shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $s['name'] }}</h3>
                        
                        <div class="mb-4">
                            <span class="text-3xl font-black text-blue-600">Rp {{ number_format($s['price'], 0, ',', '.') }}</span>
                            <span class="text-gray-400 text-sm font-medium">/ {{ $s['unit'] }}</span>
                        </div>

                        <p class="text-gray-500 leading-relaxed mb-6">
                            Layanan {{ strtolower($s['name']) }} terbaik dengan proses pengerjaan yang teliti dan hasil maksimal.
                        </p>

                        <a href="{{ route('pesan') }}" class="inline-flex items-center font-bold text-blue-600 group-hover:translate-x-2 transition-transform">
                            Pesan Sekarang
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
    @include('partials.footer')
</x-app-layout>