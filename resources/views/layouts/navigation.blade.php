<nav x-data="{ open: false, logoutModal: false }" x-cloak class="bg-white border-b border-gray-100 sticky top-0 z-50">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-24"> 
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex flex-col">
                        <span class="text-xl font-bold leading-tight text-black">Rumah Laundry</span>
                        <span class="text-xl font-bold leading-tight text-black">Tasikmalaya</span>
                    </a>
                </div>

                <div class="hidden space-x-10 sm:-my-px sm:ms-12 sm:flex">
                    @php
                        $navLinks = [
                            ['url' => '/', 'label' => 'Home', 'active' => request()->is('/')],
                            ['url' => '/layanan', 'label' => 'Layanan', 'active' => request()->is('layanan*')],
                            ['url' => '/pesan', 'label' => 'Pesan', 'active' => request()->is('pesan*')],
                            ['url' => '/transactions', 'label' => 'Cek status', 'active' => request()->is('transactions*')],
                            ['url' => '/tentang-kami', 'label' => 'Tentang kami', 'active' => request()->is('tentang-kami*')],
                        ];
                    @endphp

                    @foreach($navLinks as $link)
                        <a href="{{ url($link['url']) }}" 
                           class="relative inline-flex items-center px-1 pt-1 text-lg font-medium transition duration-150 ease-in-out focus:outline-none group {{ $link['active'] ? 'text-blue-600' : 'text-black hover:text-blue-600' }}">
                            {{ __($link['label']) }}
                            <span class="absolute bottom-5 left-0 w-full h-0.5 bg-blue-600 transform origin-left transition-transform duration-300 {{ $link['active'] ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg group-hover:bg-blue-700 transition">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-sm font-bold text-gray-800 leading-none group-hover:text-blue-600 transition">{{ Auth::user()->name }}</span>
                                <span class="text-xs text-gray-400">Member</span>
                            </div>
                        </a>

                        <div class="h-8 w-px bg-gray-200 mx-2"></div>

                        <button type="button" 
                                @click="logoutModal = true"
                                class="text-sm font-bold text-red-500 hover:text-red-700 transition">
                            Keluar
                        </button>
                    </div>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="text-lg font-bold text-gray-600 hover:text-blue-600">
                            Login
                        </a>

                        <a href="{{ route('register') }}" 
                           class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open"
         x-transition
         x-cloak
         class="sm:hidden bg-white border-t border-gray-100 shadow-lg">

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/layanan')" :active="request()->is('layanan*')">
                {{ __('Layanan') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/pesan')" :active="request()->is('pesan*')">
                {{ __('Pesan') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/transactions')" :active="request()->is('transactions*')">
                {{ __('Cek status') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="url('/tentang-kami')" :active="request()->is('tentang-kami*')">
                {{ __('Tentang kami') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 bg-gray-50">
                <div class="px-4 flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="font-bold text-base text-gray-800">
                            {{ Auth::user()->name }}
                        </div>

                        <div class="font-medium text-sm text-gray-500">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link as="button"
                                           @click="logoutModal = true"
                                           class="text-red-600 font-bold w-full text-left">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @else
            <div class="pt-4 pb-4 border-t border-gray-200 px-4 space-y-2">
                <a href="{{ route('login') }}"
                   class="block w-full text-center py-2 font-bold text-gray-600 border border-gray-200 rounded-lg">
                    Login
                </a>

                <a href="{{ route('register') }}"
                   class="block w-full text-center py-2 font-bold text-white bg-blue-600 rounded-lg shadow-md">
                    Daftar
                </a>
            </div>
        @endauth
    </div>

    <div x-show="logoutModal"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50">

        <div @click.away="logoutModal = false"
             class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl transform transition-all">

            <div class="text-center">

                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Yakin mau keluar?
                </h3>

                <p class="text-sm text-gray-500 mb-6">
                    Kamu harus login kembali untuk mengakses data laundry kamu.
                </p>

                <div class="flex gap-3">

                    <button @click="logoutModal = false"
                            class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition">
                        Batal
                    </button>

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="flex-1">
                        @csrf

                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition">
                            Ya, Keluar
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</nav>