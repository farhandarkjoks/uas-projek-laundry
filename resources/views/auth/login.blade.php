<x-guest-layout>
    <style>
        body{
            overflow-x: hidden;
            background: linear-gradient(to bottom right, #eef2ff, #f8f9ff);
        }

        [x-cloak]{
            display:none !important;
        }

        .glass{
            background: rgba(255,255,255,.7);
            backdrop-filter: blur(18px);
        }

        .floating{
            animation: floating 5s ease-in-out infinite;
        }

        @keyframes floating{
            0%,100%{
                transform: translateY(0px);
            }
            50%{
                transform: translateY(-12px);
            }
        }

        .overlay-gradient{
            background:
                radial-gradient(circle at top left, rgba(255,255,255,.18), transparent 35%),
                radial-gradient(circle at bottom right, rgba(255,255,255,.12), transparent 35%),
                linear-gradient(135deg,#6D44E0 0%,#4C27B3 100%);
        }
    </style>

    <div
        x-data="{ register:false }"
        class="min-h-screen flex items-center justify-center px-4 py-10 relative overflow-hidden"
    >

        {{-- BACK BUTTON --}}
        <a href="{{ url('/') }}"
           class="absolute top-6 left-6 z-50 flex items-center gap-2 px-5 py-3 glass rounded-2xl shadow-lg hover:scale-105 transition-all duration-300 font-semibold text-gray-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            Kembali
        </a>

        {{-- BG BLUR --}}
        <div class="absolute top-[-120px] right-[-120px] w-[420px] h-[420px] bg-[#6D44E0]/20 blur-3xl rounded-full"></div>
        <div class="absolute bottom-[-120px] left-[-120px] w-[380px] h-[380px] bg-blue-300/30 blur-3xl rounded-full"></div>

        {{-- CONTAINER --}}
        <div class="relative w-full max-w-6xl min-h-[760px] bg-white rounded-[3rem] overflow-hidden shadow-[0_25px_80px_rgba(91,51,204,0.18)]">

            {{-- FORM WRAPPER --}}
            <div class="absolute inset-0 flex">

                {{-- LOGIN --}}
                <div
                    class="w-full lg:w-1/2 px-8 md:px-16 py-14 flex flex-col justify-center transition-all duration-700 ease-in-out"
                    :class="register
                        ? '-translate-x-full opacity-0 scale-90'
                        : 'translate-x-0 opacity-100 scale-100'"
                >

                    {{-- LOGO --}}
                    <div class="mb-8 flex justify-center lg:justify-start">
                        <div class="w-16 h-16 bg-[#5B33CC] rounded-2xl flex items-center justify-center shadow-xl shadow-[#5B33CC]/30 floating">
                            <span class="text-white text-3xl font-black italic">L</span>
                        </div>
                    </div>

                    {{-- TITLE --}}
                    <div class="text-center lg:text-left">
                        <h1 class="text-5xl font-black text-gray-900 leading-tight">
                            Sign In
                        </h1>

                        <p class="text-gray-500 mt-4 text-lg">
                            Masuk ke akun Rumah Laundry Anda
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4 mt-5" :status="session('status')" />

                    {{-- FORM LOGIN --}}
                    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                        @csrf

                        <div>
                            <x-text-input
                                id="login_email"
                                class="block w-full rounded-2xl border-0 bg-gray-100 py-4 px-5 text-gray-900 focus:ring-2 focus:ring-[#5B33CC] placeholder:text-gray-400 transition-all"
                                type="email"
                                name="email"
                                :value="old('email')"
                                placeholder="Email"
                                required
                                autofocus
                            />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input
                                id="login_password"
                                class="block w-full rounded-2xl border-0 bg-gray-100 py-4 px-5 text-gray-900 focus:ring-2 focus:ring-[#5B33CC] placeholder:text-gray-400 transition-all"
                                type="password"
                                name="password"
                                placeholder="Password"
                                required
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="rounded border-gray-300 text-[#5B33CC] focus:ring-[#5B33CC]"
                                >

                                <span class="text-gray-600">
                                    Ingat saya
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-[#5B33CC] hover:underline font-semibold">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <div class="pt-3">
                            <button
                                type="submit"
                                class="w-full py-4 bg-[#5B33CC] hover:bg-[#4B28B3] text-white font-bold rounded-2xl shadow-xl shadow-[#5B33CC]/25 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]"
                            >
                                SIGN IN
                            </button>
                        </div>
                    </form>
                </div>

                {{-- REGISTER --}}
                <div
                    class="absolute top-0 right-0 w-full lg:w-1/2 h-full px-8 md:px-16 py-14 flex flex-col justify-center bg-white transition-all duration-700 ease-in-out"
                    :class="register
                        ? 'translate-x-0 opacity-100 scale-100'
                        : 'translate-x-full opacity-0 scale-90'"
                >

                    {{-- LOGO --}}
                    <div class="mb-8 flex justify-center lg:justify-start">
                        <div class="w-16 h-16 bg-[#5B33CC] rounded-2xl flex items-center justify-center shadow-xl shadow-[#5B33CC]/30 floating">
                            <span class="text-white text-3xl font-black italic">L</span>
                        </div>
                    </div>

                    {{-- TITLE --}}
                    <div class="text-center lg:text-left">
                        <h1 class="text-5xl font-black text-gray-900 leading-tight">
                            Sign Up
                        </h1>

                        <p class="text-gray-500 mt-4 text-lg">
                            Buat akun baru Rumah Laundry
                        </p>
                    </div>

                    {{-- FORM REGISTER --}}
                    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                        @csrf

                        {{-- TAMBAHAN: Role default agar tidak Invalid Credentials --}}
                        <input type="hidden" name="role" value="user">

                        <div>
                            <x-text-input
                                id="name"
                                class="block w-full rounded-2xl border-0 bg-gray-100 py-4 px-5 text-gray-900 focus:ring-2 focus:ring-[#5B33CC]"
                                type="text"
                                name="name"
                                :value="old('name')"
                                placeholder="Nama Lengkap"
                                required
                            />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input
                                id="register_email"
                                class="block w-full rounded-2xl border-0 bg-gray-100 py-4 px-5 text-gray-900 focus:ring-2 focus:ring-[#5B33CC]"
                                type="email"
                                name="email"
                                :value="old('email')"
                                placeholder="Email"
                                required
                            />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input
                                id="register_password"
                                class="block w-full rounded-2xl border-0 bg-gray-100 py-4 px-5 text-gray-900 focus:ring-2 focus:ring-[#5B33CC]"
                                type="password"
                                name="password"
                                placeholder="Password"
                                required
                                autocomplete="new-password"
                            />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-text-input
                                id="password_confirmation"
                                class="block w-full rounded-2xl border-0 bg-gray-100 py-4 px-5 text-gray-900 focus:ring-2 focus:ring-[#5B33CC]"
                                type="password"
                                name="password_confirmation"
                                placeholder="Konfirmasi Password"
                                required
                            />
                        </div>

                        <div class="pt-3">
                            <button
                                type="submit"
                                class="w-full py-4 bg-[#5B33CC] hover:bg-[#4B28B3] text-white font-bold rounded-2xl shadow-xl shadow-[#5B33CC]/25 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]"
                            >
                                SIGN UP
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- OVERLAY --}}
            <div
                class="absolute top-0 left-1/2 hidden lg:block h-full w-1/2 transition-all duration-700 ease-in-out z-30"
                :class="register ? '-translate-x-full' : 'translate-x-0'"
            >

                <div class="overlay-gradient h-full w-full rounded-[6rem] flex flex-col items-center justify-center text-center px-14 text-white relative overflow-hidden">

                    {{-- DECORATION --}}
                    <div class="absolute top-10 right-10 w-40 h-40 border border-white/20 rounded-full"></div>
                    <div class="absolute bottom-10 left-10 w-52 h-52 border border-white/10 rounded-full"></div>

                    {{-- LOGIN OVERLAY (Tampil saat di hal Register) --}}
                    <div
                        class="absolute inset-0 flex flex-col items-center justify-center px-14 transition-all duration-700"
                        :class="register
                            ? 'opacity-0 translate-y-10 pointer-events-none'
                            : 'opacity-100 translate-y-0'"
                    >

                        <img
                            src="https://cdn-icons-png.flaticon.com/512/3082/3082037.png"
                            class="w-56 floating drop-shadow-2xl"
                            alt="Laundry"
                        >

                        <h2 class="text-5xl font-black leading-tight mt-8">
                            Hello,<br>Friend!
                        </h2>

                        <p class="mt-6 text-lg text-white/90 leading-relaxed max-w-md">
                            Belum punya akun? Daftar sekarang dan nikmati layanan laundry express terbaik.
                        </p>

                        <button
                            @click="register = true"
                            class="mt-10 px-12 py-4 border-2 border-white rounded-2xl font-bold hover:bg-white hover:text-[#5B33CC] transition-all duration-300 hover:scale-105"
                        >
                            SIGN UP
                        </button>
                    </div>

                    {{-- REGISTER OVERLAY (Tampil saat di hal Login) --}}
                    <div
                        class="absolute inset-0 flex flex-col items-center justify-center px-14 transition-all duration-700"
                        :class="register
                            ? 'opacity-100 translate-y-0'
                            : 'opacity-0 -translate-y-10 pointer-events-none'"
                    >

                        <img
                            src="https://cdn-icons-png.flaticon.com/512/2936/2936886.png"
                            class="w-56 floating drop-shadow-2xl"
                            alt="Laundry"
                        >

                        <h2 class="text-5xl font-black leading-tight mt-8">
                            Welcome<br>Back!
                        </h2>

                        <p class="mt-6 text-lg text-white/90 leading-relaxed max-w-md">
                            Sudah punya akun? Login kembali untuk melanjutkan pesanan laundry Anda.
                        </p>

                        <button
                            @click="register = false"
                            class="mt-10 px-12 py-4 border-2 border-white rounded-2xl font-bold hover:bg-white hover:text-[#5B33CC] transition-all duration-300 hover:scale-105"
                        >
                            SIGN IN
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-guest-layout>