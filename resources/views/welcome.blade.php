<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rumah Laundry Tasikmalaya - Singaparna</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ===== FLOATING ===== */
        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-14px); }
        }
        .animate-floating { animation: floating 3.8s ease-in-out infinite; }

        @keyframes pulse-soft {
            0%, 100% { opacity: 0.2; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.05); }
        }
        .animate-pulse-soft { animation: pulse-soft 6s infinite; }

        /* ===== HERO BADGE ===== */
        .hero-badge {
            background: white;
            padding: 0.75rem 1.25rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.06);
            border: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: fit-content;
        }

        /* ===== SERVICE CARDS ===== */
        .service-text { color: #1e293b; font-size: 0.8rem; }
        .service-card {
            background: white;
            border-radius: 1.5rem;
            border: 2px solid #f1f5f9;
            padding: 1.25rem 0.75rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            cursor: default;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .service-card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.12);
        }
        .service-icon-wrap {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1.25rem;
            padding: 10px;
            transition: transform 0.3s ease;
        }
        .service-card:hover .service-icon-wrap { transform: scale(1.08); }

        /* ===== HERO MACHINE ANIMATIONS ===== */
        .drum-spin { transform-origin: 145px 235px; animation: drumRotate 3s linear infinite; }
        @keyframes drumRotate { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
        .wave-anim   { animation: waveMove 2s ease-in-out infinite alternate; }
        .wave-anim-2 { animation: waveMove 2.5s ease-in-out infinite alternate-reverse; }
        @keyframes waveMove { 0%{transform:translateX(-15px)} 100%{transform:translateX(15px)} }
        .inner-bubble { animation: bubbleRise 2s ease-in infinite; }
        .ib1{animation-delay:0s} .ib2{animation-delay:.7s} .ib3{animation-delay:1.4s}
        @keyframes bubbleRise { 0%{transform:translateY(0);opacity:.65} 100%{transform:translateY(-65px);opacity:0} }
        .sparkle{animation:sparklePop 2s ease-in-out infinite}
        .s1{animation-delay:0s}.s2{animation-delay:.5s}.s3{animation-delay:1s}.s4{animation-delay:1.5s}
        @keyframes sparklePop { 0%,100%{opacity:.3;transform:scale(.8) rotate(-10deg)} 50%{opacity:1;transform:scale(1.2) rotate(10deg)} }
        .display-text{animation:blinkDisplay 1.2s step-end infinite}
        @keyframes blinkDisplay{0%,100%{opacity:1}50%{opacity:.25}}

        /* ===== HERO CHARACTER ===== */
        @keyframes walkCycle{0%,100%{transform:translateX(0)}50%{transform:translateX(4px)}}
        @keyframes armSwingR{0%,100%{transform:rotate(-14deg)}50%{transform:rotate(14deg)}}
        @keyframes armSwingL{0%,100%{transform:rotate(14deg)}50%{transform:rotate(-14deg)}}
        @keyframes legSwingR{0%,100%{transform:rotate(-10deg)}50%{transform:rotate(10deg)}}
        @keyframes legSwingL{0%,100%{transform:rotate(10deg)}50%{transform:rotate(-10deg)}}
        @keyframes headBob{0%,100%{transform:translateY(0)}50%{transform:translateY(-3px)}}
        @keyframes speechPop{0%,100%{transform:scale(1)}50%{transform:scale(1.04)}}
        .char-walk{animation:walkCycle .65s ease-in-out infinite}
        .char-arm-r{transform-origin:310px 218px;animation:armSwingR .65s ease-in-out infinite}
        .char-arm-l{transform-origin:272px 218px;animation:armSwingL .65s ease-in-out infinite}
        .char-leg-r{transform-origin:302px 275px;animation:legSwingR .65s ease-in-out infinite}
        .char-leg-l{transform-origin:282px 275px;animation:legSwingL .65s ease-in-out infinite}
        .char-head{transform-origin:291px 190px;animation:headBob .65s ease-in-out infinite}
        .speech-pop{animation:speechPop 1.8s ease-in-out infinite;transform-origin:291px 148px}

        /* ===== SOAP BUBBLES BG ===== */
        .bubble{position:absolute;border-radius:50%;background:radial-gradient(circle at 30% 30%,rgba(255,255,255,.8),rgba(6,182,212,.12));border:1px solid rgba(6,182,212,.22);animation:floatBubble linear infinite;pointer-events:none}
        .bubble-1{width:60px;height:60px;left:5%;bottom:-60px;animation-duration:9s;animation-delay:0s}
        .bubble-2{width:38px;height:38px;left:22%;bottom:-38px;animation-duration:11s;animation-delay:2s}
        .bubble-3{width:76px;height:76px;left:68%;bottom:-76px;animation-duration:13s;animation-delay:1s}
        .bubble-4{width:28px;height:28px;left:84%;bottom:-28px;animation-duration:7s;animation-delay:3s}
        .bubble-5{width:50px;height:50px;left:48%;bottom:-50px;animation-duration:10s;animation-delay:.5s}
        @keyframes floatBubble{0%{transform:translateY(0) rotate(0deg);opacity:0}10%{opacity:.55}90%{opacity:.35}100%{transform:translateY(-650px) rotate(360deg);opacity:0}}

        /* ===== SERVICE ICON UNIQUE ANIMATIONS ===== */
        @keyframes basketBounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-6px)}}
        .anim-basket{animation:basketBounce 1.1s ease-in-out infinite}

        @keyframes ironSlide{0%,100%{transform:translateX(0)}50%{transform:translateX(7px)}}
        .anim-iron{animation:ironSlide .9s ease-in-out infinite}

        @keyframes shoeWalk{0%,100%{transform:rotate(-9deg) translateY(0)}50%{transform:rotate(9deg) translateY(-5px)}}
        .anim-shoe{animation:shoeWalk .85s ease-in-out infinite;transform-origin:center bottom}

        @keyframes bagSwing{0%,100%{transform:rotate(-7deg)}50%{transform:rotate(7deg)}}
        .anim-bag{animation:bagSwing 1.1s ease-in-out infinite;transform-origin:top center}

        @keyframes wheelSpin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
        .anim-carpet-roll{animation:wheelSpin 1.4s linear infinite;transform-origin:16px 43px}
        .anim-carpet-roll2{animation:wheelSpin 1.4s linear infinite;transform-origin:64px 43px}

        @keyframes curtainSway{0%,100%{transform:skewX(-2deg) scaleX(1)}50%{transform:skewX(2deg) scaleX(1.04)}}
        .anim-curtain-l{animation:curtainSway 1.3s ease-in-out infinite;transform-origin:14px 19px}
        .anim-curtain-r{animation:curtainSway 1.3s ease-in-out infinite reverse;transform-origin:66px 19px}

        @keyframes coverFlap{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
        .anim-cover{animation:coverFlap 1.1s ease-in-out infinite}

        @keyframes sheetFloat{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-6px) rotate(1.5deg)}}
        .anim-sheet{animation:sheetFloat 1.4s ease-in-out infinite}

        @keyframes pillowPulse{0%,100%{transform:scale(1)}50%{transform:scaleX(1.07) scaleY(.93)}}
        .anim-pillow{animation:pillowPulse 1.2s ease-in-out infinite;transform-origin:center}

        .anim-wheel-f{animation:wheelSpin .65s linear infinite;transform-origin:62px 72px}
        .anim-wheel-b{animation:wheelSpin .65s linear infinite;transform-origin:22px 72px}

        @keyframes bearBounce{0%,100%{transform:translateY(0) rotate(0deg)}30%{transform:translateY(-5px) rotate(-4deg)}70%{transform:translateY(-5px) rotate(4deg)}}
        .anim-bear{animation:bearBounce 1.3s ease-in-out infinite;transform-origin:center bottom}
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900 overflow-x-hidden">

  @include('layouts.navigation')

    <!-- ===== HERO ===== -->
    <header class="relative py-16 md:py-24 bg-white overflow-hidden">
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="bubble bubble-1"></div>
            <div class="bubble bubble-2"></div>
            <div class="bubble bubble-3"></div>
            <div class="bubble bubble-4"></div>
            <div class="bubble bubble-5"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-8" data-aos="fade-right">
                <h1 class="text-5xl md:text-7xl font-black text-gray-950 leading-[1.1]">
                    No 1 <br>
                    <span class="text-cyan-500">laundry <br> express</span> di <br>
                    <span class="relative">
                        Singaparna
                        <svg class="absolute -bottom-2 left-0 w-full h-3 text-cyan-200 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 25 0 50 5 T 100 5" stroke="currentColor" stroke-width="4" fill="none"/>
                        </svg>
                    </span>
                </h1>
                <div class="space-y-4">
                    <div class="hero-badge" data-aos="fade-left" data-aos-delay="200">
                        <div class="bg-cyan-100 p-2 rounded-lg text-cyan-600"><i class="fas fa-truck-fast text-lg"></i></div>
                        <span class="font-bold text-gray-700">Pickup dalam 30 menit</span>
                    </div>
                    <div class="hero-badge" data-aos="fade-left" data-aos-delay="350">
                        <div class="bg-cyan-100 p-2 rounded-lg text-cyan-600"><i class="fas fa-tags text-lg"></i></div>
                        <span class="font-bold text-gray-700">Harga Mulai Dari IDR 8.000</span>
                    </div>
                    <div class="hero-badge" data-aos="fade-left" data-aos-delay="500">
                        <div class="bg-cyan-100 p-2 rounded-lg text-cyan-600"><i class="fas fa-clock text-lg"></i></div>
                        <span class="font-bold text-gray-700">Express 3 Jam Selesai</span>
                    </div>
                </div>
                <div class="pt-4" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-cyan-600 text-white font-extrabold rounded-2xl shadow-xl shadow-cyan-100 hover:bg-cyan-700 hover:-translate-y-1 transition-all">
                        Pesan Online Sekarang
                    </a>
                </div>
            </div>

            <div class="relative flex items-center justify-center" data-aos="zoom-in" data-aos-delay="300">
                <div class="absolute inset-0 bg-cyan-100 rounded-full mix-blend-multiply filter blur-3xl opacity-25 animate-pulse-soft"></div>
                <svg viewBox="0 0 420 480" xmlns="http://www.w3.org/2000/svg" class="w-full max-w-lg drop-shadow-2xl relative animate-floating">
                    <ellipse cx="150" cy="468" rx="110" ry="8" fill="#e2e8f0" opacity="0.7"/>
                    <ellipse cx="310" cy="468" rx="52" ry="6" fill="#e2e8f0" opacity="0.5"/>
                    <rect x="20" y="70" width="250" height="300" rx="26" fill="#f0fdff" stroke="#a5f3fc" stroke-width="2.5"/>
                    <rect x="20" y="70" width="250" height="65" rx="26" fill="#0891b2"/>
                    <rect x="20" y="110" width="250" height="25" fill="#0891b2"/>
                    <circle cx="55" cy="100" r="11" fill="#67e8f9" opacity="0.85"/>
                    <circle cx="83" cy="100" r="7" fill="#a5f3fc" opacity="0.65"/>
                    <circle cx="104" cy="100" r="5" fill="#cffafe" opacity="0.5"/>
                    <rect x="148" y="80" width="100" height="34" rx="7" fill="#082f49"/>
                    <text x="198" y="102" font-family="monospace" font-size="15" fill="#22d3ee" text-anchor="middle" class="display-text">03:00</text>
                    <circle cx="145" cy="235" r="98" fill="white" stroke="#a5f3fc" stroke-width="3.5"/>
                    <circle cx="145" cy="235" r="84" fill="#ecfeff" stroke="#67e8f9" stroke-width="2.5"/>
                    <circle cx="145" cy="235" r="70" fill="#cffafe"/>
                    <g class="drum-spin" style="transform-origin:145px 235px">
                        <circle cx="145" cy="165" r="8.5" fill="white" opacity="0.72"/>
                        <circle cx="145" cy="305" r="8.5" fill="white" opacity="0.72"/>
                        <circle cx="75"  cy="235" r="8.5" fill="white" opacity="0.72"/>
                        <circle cx="215" cy="235" r="8.5" fill="white" opacity="0.72"/>
                        <circle cx="97"  cy="187" r="6.5" fill="white" opacity="0.55"/>
                        <circle cx="193" cy="283" r="6.5" fill="white" opacity="0.55"/>
                        <circle cx="97"  cy="283" r="6.5" fill="white" opacity="0.55"/>
                        <circle cx="193" cy="187" r="6.5" fill="white" opacity="0.55"/>
                    </g>
                    <clipPath id="drumClip"><circle cx="145" cy="235" r="69"/></clipPath>
                    <g clip-path="url(#drumClip)">
                        <path class="wave-anim"   d="M55 258 Q 90 240 125 258 Q 160 276 195 258 Q 220 244 240 258 L 240 320 L 55 320 Z" fill="#06b6d4" opacity="0.38"/>
                        <path class="wave-anim-2" d="M55 267 Q 90 250 125 267 Q 160 284 195 267 Q 220 254 240 267 L 240 320 L 55 320 Z" fill="#0891b2" opacity="0.32"/>
                        <circle class="inner-bubble ib1" cx="112" cy="252" r="5.5" fill="white" opacity="0.65"/>
                        <circle class="inner-bubble ib2" cx="145" cy="244" r="4"   fill="white" opacity="0.55"/>
                        <circle class="inner-bubble ib3" cx="178" cy="255" r="4.5" fill="white" opacity="0.6"/>
                    </g>
                    <rect x="130" y="308" width="30" height="9" rx="4.5" fill="#0891b2"/>
                    <rect x="38"  y="348" width="66" height="12" rx="6" fill="#a5f3fc" opacity="0.45"/>
                    <rect x="118" y="348" width="66" height="12" rx="6" fill="#a5f3fc" opacity="0.45"/>
                    <rect x="198" y="348" width="56" height="12" rx="6" fill="#a5f3fc" opacity="0.45"/>
                    <rect x="50"  y="362" width="24" height="16" rx="5" fill="#0891b2" opacity="0.55"/>
                    <rect x="216" y="362" width="24" height="16" rx="5" fill="#0891b2" opacity="0.55"/>
                    <text x="258" y="118" font-size="18" class="sparkle s1">✨</text>
                    <text x="10"  y="148" font-size="14" class="sparkle s2">💧</text>
                    <text x="265" y="295" font-size="16" class="sparkle s3">🫧</text>
                    <text x="8"   y="310" font-size="12" class="sparkle s4">✨</text>
                    <!-- Character -->
                    <rect x="262" y="258" width="58" height="36" rx="8" fill="#fde68a" stroke="#f59e0b" stroke-width="1.5"/>
                    <line x1="262" y1="268" x2="320" y2="268" stroke="#f59e0b" stroke-width="1" opacity="0.55"/>
                    <line x1="262" y1="278" x2="320" y2="278" stroke="#f59e0b" stroke-width="1" opacity="0.55"/>
                    <path d="M272 258 Q 277 246 282 258" fill="#f87171"/>
                    <path d="M287 258 Q 292 244 297 258" fill="#60a5fa"/>
                    <path d="M303 258 Q 307 249 311 258" fill="#a78bfa"/>
                    <g class="char-leg-r"><rect x="295" y="298" width="14" height="58" rx="7" fill="#1e40af"/></g>
                    <g class="char-leg-l"><rect x="275" y="298" width="14" height="58" rx="7" fill="#1e40af"/></g>
                    <ellipse cx="302" cy="357" rx="12" ry="6" fill="#1e293b"/>
                    <ellipse cx="282" cy="357" rx="12" ry="6" fill="#1e293b"/>
                    <rect x="266" y="208" width="50" height="66" rx="15" fill="#0891b2"/>
                    <rect x="277" y="213" width="22" height="26" rx="5" fill="#0e7490" opacity="0.4"/>
                    <g class="char-arm-r"><rect x="316" y="213" width="13" height="44" rx="6.5" fill="#fed7aa"/></g>
                    <g class="char-arm-l"><rect x="253" y="213" width="13" height="44" rx="6.5" fill="#fed7aa"/></g>
                    <rect x="279" y="200" width="16" height="14" rx="6" fill="#fed7aa"/>
                    <g class="char-head">
                        <circle cx="287" cy="187" r="24" fill="#fed7aa"/>
                        <path d="M263 184 Q 266 160 287 158 Q 308 160 311 184 Q 305 170 287 168 Q 269 170 263 184 Z" fill="#292524"/>
                        <circle cx="279" cy="185" r="3.5" fill="white"/>
                        <circle cx="295" cy="185" r="3.5" fill="white"/>
                        <circle cx="280" cy="186" r="2"   fill="#1e293b"/>
                        <circle cx="296" cy="186" r="2"   fill="#1e293b"/>
                        <circle cx="281" cy="185" r="0.8" fill="white"/>
                        <circle cx="297" cy="185" r="0.8" fill="white"/>
                        <path d="M280 196 Q 287 202 294 196" fill="none" stroke="#1e293b" stroke-width="1.8" stroke-linecap="round"/>
                        <circle cx="272" cy="194" r="5" fill="#fda4af" opacity="0.42"/>
                        <circle cx="302" cy="194" r="5" fill="#fda4af" opacity="0.42"/>
                    </g>
                    <g class="speech-pop">
                        <rect x="230" y="138" width="118" height="36" rx="14" fill="#0891b2"/>
                        <polygon points="268,174 258,188 280,174" fill="#0891b2"/>
                        <text x="289" y="152" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" font-weight="700" fill="white" text-anchor="middle">Bersih &amp; Wangi!</text>
                        <text x="289" y="166" font-family="'Plus Jakarta Sans', sans-serif" font-size="10" font-weight="700" fill="white" text-anchor="middle">Siap antar! 🧺</text>
                    </g>
                </svg>
            </div>
        </div>
    </header>

    <!-- ===== LAYANAN ===== -->
    <section id="layanan" class="py-24 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-up">
                <h2 class="text-4xl font-extrabold text-gray-950">Layanan Laundry Kami</h2>
                <p class="text-gray-500 mt-3 max-w-xl mx-auto">Kami menangani kebutuhan laundry harian hingga barang khusus Anda dengan sepenuh hati.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-3 gap-5">

                {{-- 1. Daily Kiloan - Amber/Orange --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="50">
                    <div class="service-icon-wrap" style="background:#fff7ed;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" class="anim-basket">
                            <rect x="18" y="14" width="44" height="8" rx="4" fill="#fb923c" stroke="#ea580c" stroke-width="1.5"/>
                            <rect x="24" y="10" width="12" height="8" rx="3" fill="#fbbf24" stroke="#d97706" stroke-width="1.5"/>
                            <rect x="44" y="10" width="12" height="8" rx="3" fill="#f472b6" stroke="#db2777" stroke-width="1.5"/>
                            <rect x="14" y="22" width="52" height="40" rx="8" fill="#fde68a" stroke="#f59e0b" stroke-width="2.5"/>
                            <line x1="14" y1="33" x2="66" y2="33" stroke="#f59e0b" stroke-width="1.5" opacity="0.55"/>
                            <line x1="14" y1="44" x2="66" y2="44" stroke="#f59e0b" stroke-width="1.5" opacity="0.55"/>
                            <line x1="14" y1="55" x2="66" y2="55" stroke="#f59e0b" stroke-width="1.5" opacity="0.55"/>
                            <line x1="27" y1="22" x2="27" y2="62" stroke="#f59e0b" stroke-width="1" opacity="0.35"/>
                            <line x1="40" y1="22" x2="40" y2="62" stroke="#f59e0b" stroke-width="1" opacity="0.35"/>
                            <line x1="53" y1="22" x2="53" y2="62" stroke="#f59e0b" stroke-width="1" opacity="0.35"/>
                            <text x="58" y="18" font-size="10" fill="#fb923c">✦</text>
                            <text x="8" y="28" font-size="8" fill="#fbbf24">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Daily Kiloan</p>
                </div>

                {{-- 2. Cuci & Setrika - Blue --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon-wrap" style="background:#eff6ff;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <!-- Steam (always animating) -->
                            <g style="animation:sparklePop 1.5s ease-in-out infinite">
                                <circle cx="32" cy="17" r="4" fill="#bfdbfe" opacity="0.75"/>
                                <circle cx="44" cy="13" r="5" fill="#93c5fd" opacity="0.75"/>
                                <circle cx="56" cy="17" r="3.5" fill="#bfdbfe" opacity="0.75"/>
                            </g>
                            <g class="anim-iron">
                                <path d="M10 42 Q 10 30 30 30 L 68 30 L 68 50 Q 68 58 58 58 L 18 58 Q 10 58 10 50 Z" fill="#3b82f6" stroke="#1d4ed8" stroke-width="2"/>
                                <rect x="32" y="20" width="20" height="14" rx="5" fill="#60a5fa" stroke="#2563eb" stroke-width="1.5"/>
                                <path d="M12 56 Q 10 60 15 62 L 62 62 Q 68 62 68 58 L 68 56 Z" fill="#93c5fd" stroke="#1d4ed8" stroke-width="1.5"/>
                                <circle cx="26" cy="48" r="2" fill="#1d4ed8" opacity="0.5"/>
                                <circle cx="36" cy="48" r="2" fill="#1d4ed8" opacity="0.5"/>
                                <circle cx="46" cy="48" r="2" fill="#1d4ed8" opacity="0.5"/>
                                <circle cx="56" cy="48" r="2" fill="#1d4ed8" opacity="0.5"/>
                                <path d="M68 36 Q 76 36 76 28 Q 76 20 70 20" fill="none" stroke="#93c5fd" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="70" cy="20" r="2.5" fill="#60a5fa"/>
                                <ellipse cx="22" cy="38" rx="7" ry="4" fill="white" opacity="0.25" transform="rotate(-20 22 38)"/>
                            </g>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Cuci &amp; Setrika</p>
                </div>

                {{-- 3. Laundry Sepatu - Green --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="150">
                    <div class="service-icon-wrap" style="background:#f0fdf4;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <g class="anim-shoe">
                                <path d="M8 60 Q 8 68 18 68 L 66 68 Q 74 68 74 62 L 74 58 L 8 58 Z" fill="#16a34a" stroke="#15803d" stroke-width="2"/>
                                <path d="M10 58 L 10 38 Q 10 26 24 24 L 48 24 Q 64 24 68 36 L 74 58 Z" fill="#4ade80" stroke="#16a34a" stroke-width="2"/>
                                <path d="M10 58 L 10 46 Q 10 36 20 34 L 32 34 Q 20 38 18 50 L 10 58 Z" fill="#86efac" opacity="0.65"/>
                                <line x1="30" y1="30" x2="30" y2="50" stroke="white" stroke-width="1.8" stroke-dasharray="3,3"/>
                                <line x1="40" y1="28" x2="40" y2="50" stroke="white" stroke-width="1.8" stroke-dasharray="3,3"/>
                                <line x1="50" y1="28" x2="50" y2="48" stroke="white" stroke-width="1.8" stroke-dasharray="3,3"/>
                                <line x1="26" y1="38" x2="54" y2="36" stroke="white" stroke-width="1.5"/>
                                <line x1="26" y1="44" x2="54" y2="42" stroke="white" stroke-width="1.5"/>
                            </g>
                            <text x="56" y="20" font-size="10" fill="#4ade80">✦</text>
                            <text x="62" y="34" font-size="8"  fill="#86efac">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Sepatu</p>
                </div>

                {{-- 4. Laundry Tas - Purple --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon-wrap" style="background:#faf5ff;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <g class="anim-bag">
                                <path d="M28 20 Q 28 10 40 10 Q 52 10 52 20" fill="none" stroke="#7c3aed" stroke-width="3.5" stroke-linecap="round"/>
                                <rect x="12" y="20" width="56" height="44" rx="12" fill="#a78bfa" stroke="#7c3aed" stroke-width="2.5"/>
                                <rect x="22" y="32" width="36" height="22" rx="8" fill="#7c3aed" stroke="#6d28d9" stroke-width="1.5"/>
                                <line x1="30" y1="32" x2="50" y2="32" stroke="#c4b5fd" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="40" cy="32" r="3" fill="#ddd6fe" stroke="#7c3aed" stroke-width="1"/>
                                <line x1="16" y1="28" x2="64" y2="28" stroke="#c4b5fd" stroke-width="1" stroke-dasharray="3,3" opacity="0.6"/>
                            </g>
                            <text x="56" y="18" font-size="10" fill="#a78bfa">✦</text>
                            <text x="8"  y="32" font-size="8"  fill="#c4b5fd">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Tas</p>
                </div>

                {{-- 5. Laundry Karpet - Orange/Red (ANIMATED ROLL ENDS) --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="250">
                    <div class="service-icon-wrap" style="background:#fff7ed;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <rect x="16" y="26" width="48" height="30" rx="4" fill="#f97316" stroke="#ea580c" stroke-width="2"/>
                            <rect x="22" y="31" width="36" height="20" rx="2" fill="#fbbf24" stroke="#f59e0b" stroke-width="1"/>
                            <polygon points="40,34 46,41 40,48 34,41" fill="#ef4444" stroke="#dc2626" stroke-width="1"/>
                            <!-- Left roll end animated -->
                            <ellipse cx="16" cy="41" rx="6" ry="15" fill="#ea580c" stroke="#c2410c" stroke-width="2"/>
                            <g class="anim-carpet-roll">
                                <line x1="16" y1="28" x2="16" y2="54" stroke="#c2410c" stroke-width="1.5" opacity="0.7"/>
                                <line x1="9"  y1="41" x2="23" y2="41" stroke="#c2410c" stroke-width="1.5" opacity="0.7"/>
                                <line x1="11" y1="32" x2="21" y2="50" stroke="#c2410c" stroke-width="1" opacity="0.45"/>
                                <line x1="21" y1="32" x2="11" y2="50" stroke="#c2410c" stroke-width="1" opacity="0.45"/>
                            </g>
                            <!-- Right roll end animated -->
                            <ellipse cx="64" cy="41" rx="6" ry="15" fill="#ea580c" stroke="#c2410c" stroke-width="2"/>
                            <g class="anim-carpet-roll2">
                                <line x1="64" y1="28" x2="64" y2="54" stroke="#c2410c" stroke-width="1.5" opacity="0.7"/>
                                <line x1="57" y1="41" x2="71" y2="41" stroke="#c2410c" stroke-width="1.5" opacity="0.7"/>
                                <line x1="59" y1="32" x2="69" y2="50" stroke="#c2410c" stroke-width="1" opacity="0.45"/>
                                <line x1="69" y1="32" x2="59" y2="50" stroke="#c2410c" stroke-width="1" opacity="0.45"/>
                            </g>
                            <!-- Fringe -->
                            <line x1="22" y1="56" x2="22" y2="65" stroke="#fbbf24" stroke-width="2" stroke-linecap="round"/>
                            <line x1="28" y1="56" x2="28" y2="66" stroke="#f97316" stroke-width="2" stroke-linecap="round"/>
                            <line x1="34" y1="56" x2="34" y2="65" stroke="#fbbf24" stroke-width="2" stroke-linecap="round"/>
                            <line x1="40" y1="56" x2="40" y2="66" stroke="#f97316" stroke-width="2" stroke-linecap="round"/>
                            <line x1="46" y1="56" x2="46" y2="65" stroke="#fbbf24" stroke-width="2" stroke-linecap="round"/>
                            <line x1="52" y1="56" x2="52" y2="66" stroke="#f97316" stroke-width="2" stroke-linecap="round"/>
                            <line x1="58" y1="56" x2="58" y2="65" stroke="#fbbf24" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Karpet</p>
                </div>

                {{-- 6. Laundry Gorden - Magenta --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon-wrap" style="background:#fdf4ff;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <rect x="8" y="12" width="64" height="5" rx="2.5" fill="#a21caf" stroke="#86198f" stroke-width="1"/>
                            <circle cx="8"  cy="14" r="4" fill="#d946ef" stroke="#a21caf" stroke-width="1.5"/>
                            <circle cx="72" cy="14" r="4" fill="#d946ef" stroke="#a21caf" stroke-width="1.5"/>
                            <circle cx="22" cy="14" r="2.5" fill="none" stroke="#e879f9" stroke-width="1.5"/>
                            <circle cx="36" cy="14" r="2.5" fill="none" stroke="#e879f9" stroke-width="1.5"/>
                            <circle cx="50" cy="14" r="2.5" fill="none" stroke="#e879f9" stroke-width="1.5"/>
                            <circle cx="62" cy="14" r="2.5" fill="none" stroke="#e879f9" stroke-width="1.5"/>
                            <!-- Left curtain -->
                            <g class="anim-curtain-l">
                                <path d="M12 17 Q 10 33 15 44 Q 17 54 12 68 L 38 68 Q 33 54 35 44 Q 39 33 36 17 Z" fill="#e879f9" stroke="#d946ef" stroke-width="1.5"/>
                                <path d="M21 23 Q 19 38 23 50" fill="none" stroke="#f0abfc" stroke-width="1.5" opacity="0.65"/>
                                <path d="M29 23 Q 31 38 27 53" fill="none" stroke="#f0abfc" stroke-width="1.5" opacity="0.65"/>
                            </g>
                            <!-- Right curtain -->
                            <g class="anim-curtain-r">
                                <path d="M42 17 Q 40 33 45 44 Q 47 54 42 68 L 68 68 Q 63 54 65 44 Q 69 33 66 17 Z" fill="#c026d3" stroke="#a21caf" stroke-width="1.5"/>
                                <path d="M51 23 Q 49 38 53 50" fill="none" stroke="#e879f9" stroke-width="1.5" opacity="0.65"/>
                                <path d="M59 23 Q 61 38 57 53" fill="none" stroke="#e879f9" stroke-width="1.5" opacity="0.65"/>
                            </g>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Gorden</p>
                </div>

                {{-- 7. Laundry Bed Cover - Teal --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="350">
                    <div class="service-icon-wrap" style="background:#f0fdfa;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <g class="anim-cover">
                                <rect x="10" y="54" width="60" height="10" rx="5" fill="#0d9488" stroke="#0f766e" stroke-width="2"/>
                                <rect x="12" y="42" width="56" height="14" rx="5" fill="#14b8a6" stroke="#0d9488" stroke-width="2"/>
                                <rect x="14" y="30" width="52" height="14" rx="5" fill="#2dd4bf" stroke="#14b8a6" stroke-width="2"/>
                                <rect x="10" y="16" width="60" height="18" rx="8" fill="#5eead4" stroke="#14b8a6" stroke-width="2"/>
                                <path d="M10 24 Q 10 16 18 16 L 62 16 Q 70 16 70 24 L 70 28 Q 40 22 10 28 Z" fill="#99f6e4" opacity="0.8"/>
                                <circle cx="26" cy="22" r="2.5" fill="#0d9488" opacity="0.45"/>
                                <circle cx="40" cy="20" r="2.5" fill="#0d9488" opacity="0.45"/>
                                <circle cx="54" cy="22" r="2.5" fill="#0d9488" opacity="0.45"/>
                            </g>
                            <text x="62" y="14" font-size="9" fill="#14b8a6">✦</text>
                            <text x="6"  y="18" font-size="7" fill="#2dd4bf">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Bed Cover</p>
                </div>

                {{-- 8. Laundry Sprei - Indigo --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-icon-wrap" style="background:#eef2ff;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <g class="anim-sheet">
                                <rect x="8"  y="52" width="64" height="10" rx="5" fill="#4338ca" stroke="#3730a3" stroke-width="2"/>
                                <rect x="10" y="38" width="60" height="16" rx="5" fill="#6366f1" stroke="#4338ca" stroke-width="2"/>
                                <rect x="8"  y="22" width="64" height="18" rx="8" fill="#818cf8" stroke="#6366f1" stroke-width="2"/>
                                <path d="M8 24 Q 20 18 32 24 Q 44 30 56 24 Q 68 18 72 24" fill="none" stroke="#a5b4fc" stroke-width="2" stroke-linecap="round"/>
                                <line x1="16" y1="30" x2="64" y2="30" stroke="#a5b4fc" stroke-width="1.5" opacity="0.45"/>
                                <line x1="16" y1="36" x2="64" y2="36" stroke="#a5b4fc" stroke-width="1.5" opacity="0.45"/>
                            </g>
                            <text x="60" y="18" font-size="10" fill="#818cf8">✦</text>
                            <text x="6"  y="24" font-size="8"  fill="#a5b4fc">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Sprei</p>
                </div>

                {{-- 9. Sarung Bantal - Rose --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="450">
                    <div class="service-icon-wrap" style="background:#fff1f2;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <g class="anim-pillow">
                                <rect x="8" y="22" width="64" height="40" rx="14" fill="#fb7185" stroke="#e11d48" stroke-width="2.5"/>
                                <ellipse cx="40" cy="42" rx="22" ry="14" fill="#fda4af" opacity="0.55"/>
                                <circle cx="40" cy="42" r="4" fill="#e11d48" stroke="#be123c" stroke-width="1.5"/>
                                <circle cx="40" cy="42" r="2" fill="#fff1f2"/>
                                <rect x="14" y="28" width="52" height="28" rx="10" fill="none" stroke="#fda4af" stroke-width="1.5" stroke-dasharray="4,3"/>
                                <circle cx="18" cy="30" r="4" fill="#fda4af" opacity="0.45"/>
                                <circle cx="62" cy="30" r="4" fill="#fda4af" opacity="0.45"/>
                                <circle cx="18" cy="54" r="4" fill="#fda4af" opacity="0.45"/>
                                <circle cx="62" cy="54" r="4" fill="#fda4af" opacity="0.45"/>
                            </g>
                            <text x="60" y="18" font-size="10" fill="#fb7185">✦</text>
                            <text x="8"  y="20" font-size="7"  fill="#fda4af">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Sarung Bantal</p>
                </div>

                {{-- 10. Laundry Stroller - Sky Blue (BAN BERPUTAR!) --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-icon-wrap" style="background:#f0f9ff;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 44 Q 14 20 40 16 Q 66 12 68 44 Z" fill="#0ea5e9" stroke="#0284c7" stroke-width="2"/>
                            <path d="M20 44 Q 18 26 40 20" fill="none" stroke="#7dd3fc" stroke-width="2" opacity="0.55"/>
                            <path d="M32 44 Q 32 22 52 18" fill="none" stroke="#7dd3fc" stroke-width="2" opacity="0.55"/>
                            <path d="M12 44 L 12 60 Q 12 66 20 66 L 60 66 Q 68 66 68 60 L 68 44 Z" fill="#38bdf8" stroke="#0ea5e9" stroke-width="2"/>
                            <path d="M10 44 Q 8 30 14 22" fill="none" stroke="#0284c7" stroke-width="3" stroke-linecap="round"/>
                            <line x1="12" y1="52" x2="68" y2="52" stroke="#7dd3fc" stroke-width="1.5" opacity="0.45"/>
                            <!-- Baby face -->
                            <circle cx="40" cy="56" r="7" fill="#fed7aa" stroke="#fdba74" stroke-width="1"/>
                            <circle cx="37" cy="55" r="1.2" fill="#1e293b"/>
                            <circle cx="43" cy="55" r="1.2" fill="#1e293b"/>
                            <path d="M37 59 Q 40 62 43 59" fill="none" stroke="#1e293b" stroke-width="1" stroke-linecap="round"/>
                            <!-- Front wheel SPINNING -->
                            <g class="anim-wheel-f" style="transform-origin:62px 72px">
                                <circle cx="62" cy="72" r="9" fill="#0284c7" stroke="#0369a1" stroke-width="2"/>
                                <circle cx="62" cy="72" r="3.5" fill="#7dd3fc"/>
                                <line x1="62" y1="63" x2="62" y2="81" stroke="#7dd3fc" stroke-width="1.5" opacity="0.85"/>
                                <line x1="53" y1="72" x2="71" y2="72" stroke="#7dd3fc" stroke-width="1.5" opacity="0.85"/>
                                <line x1="56" y1="66" x2="68" y2="78" stroke="#7dd3fc" stroke-width="1" opacity="0.5"/>
                                <line x1="68" y1="66" x2="56" y2="78" stroke="#7dd3fc" stroke-width="1" opacity="0.5"/>
                            </g>
                            <!-- Back wheel SPINNING -->
                            <g class="anim-wheel-b" style="transform-origin:22px 72px">
                                <circle cx="22" cy="72" r="9" fill="#0284c7" stroke="#0369a1" stroke-width="2"/>
                                <circle cx="22" cy="72" r="3.5" fill="#7dd3fc"/>
                                <line x1="22" y1="63" x2="22" y2="81" stroke="#7dd3fc" stroke-width="1.5" opacity="0.85"/>
                                <line x1="13" y1="72" x2="31" y2="72" stroke="#7dd3fc" stroke-width="1.5" opacity="0.85"/>
                                <line x1="16" y1="66" x2="28" y2="78" stroke="#7dd3fc" stroke-width="1" opacity="0.5"/>
                                <line x1="28" y1="66" x2="16" y2="78" stroke="#7dd3fc" stroke-width="1" opacity="0.5"/>
                            </g>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Stroller</p>
                </div>

                {{-- 11. Laundry Boneka - Amber/Warm --}}
                <div class="service-card" data-aos="fade-up" data-aos-delay="550">
                    <div class="service-icon-wrap" style="background:#fefce8;">
                        <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                            <g class="anim-bear">
                                <!-- Ears -->
                                <circle cx="22" cy="20" r="10" fill="#d97706" stroke="#b45309" stroke-width="2"/>
                                <circle cx="22" cy="20" r="5"  fill="#fbbf24"/>
                                <circle cx="58" cy="20" r="10" fill="#d97706" stroke="#b45309" stroke-width="2"/>
                                <circle cx="58" cy="20" r="5"  fill="#fbbf24"/>
                                <!-- Head -->
                                <circle cx="40" cy="34" r="22" fill="#f59e0b" stroke="#d97706" stroke-width="2.5"/>
                                <!-- Snout -->
                                <ellipse cx="40" cy="40" rx="12" ry="9" fill="#fde68a"/>
                                <!-- Eyes -->
                                <circle cx="32" cy="30" r="4" fill="#1e293b"/>
                                <circle cx="48" cy="30" r="4" fill="#1e293b"/>
                                <circle cx="33" cy="29" r="1.5" fill="white"/>
                                <circle cx="49" cy="29" r="1.5" fill="white"/>
                                <!-- Nose -->
                                <ellipse cx="40" cy="38" rx="4" ry="3" fill="#92400e"/>
                                <!-- Smile -->
                                <path d="M35 42 Q 40 47 45 42" fill="none" stroke="#92400e" stroke-width="1.8" stroke-linecap="round"/>
                                <!-- Cheeks -->
                                <circle cx="27" cy="38" r="5" fill="#fca5a5" opacity="0.45"/>
                                <circle cx="53" cy="38" r="5" fill="#fca5a5" opacity="0.45"/>
                                <!-- Body -->
                                <rect x="26" y="54" width="28" height="18" rx="10" fill="#f59e0b" stroke="#d97706" stroke-width="2"/>
                                <ellipse cx="40" cy="62" rx="8" ry="6" fill="#fde68a"/>
                            </g>
                            <text x="62" y="16" font-size="9" fill="#fbbf24">✦</text>
                            <text x="6"  y="22" font-size="7" fill="#fde68a">✦</text>
                            <text x="64" y="50" font-size="8" fill="#f59e0b">✦</text>
                        </svg>
                    </div>
                    <p class="service-text font-bold">Laundry Boneka</p>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-gray-950 p-12 md:p-16 rounded-[40px] grid md:grid-cols-3 gap-12 items-center overflow-hidden relative" data-aos="zoom-in">
                <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-600/20 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
                <div class="md:col-span-2 space-y-6 relative z-10">
                    <h3 class="text-3xl md:text-5xl font-black text-white leading-tight">
                        Cucian di rumah <br> sudah numpuk?
                    </h3>
                    <p class="text-base text-gray-400 max-w-lg">
                        Jangan biarkan cucian kotor mengganggu waktu istirahat Anda. Tim kami siap jemput dan antar kembali dalam kondisi bersih dan wangi.
                    </p>
                    <a href="https://wa.me/628123456789" target="_blank" class="inline-flex items-center gap-3 px-8 py-4 bg-white text-gray-950 font-bold rounded-2xl hover:bg-cyan-500 hover:text-white transition-all">
                        <i class="fab fa-whatsapp text-xl"></i>
                        Hubungi Kami Sekarang
                    </a>
                </div>
                <div class="relative z-10">
                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/man-delivering-clothes-illustration-download-in-svg-png-gif-file-formats--order-delivery-courier-clean-services-illustrations-4623715.png" class="w-full h-auto animate-floating" alt="Contact Us">
                </div>
            </div>
        </div>
    </section>

   @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, offset: 100 });
    </script>
</body>
</html>