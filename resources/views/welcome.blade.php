<!DOCTYPE html>
<html lang="id" x-data="{ darkMode: true, mobileMenu: false }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ParkirPro | Kelola Parkir Jadi Mudah</title>

        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                        colors: {
                            accent: '#10b981',
                            dark: { 950: '#020617', 900: '#0f172a' }
                        }
                    }
                }
            }
        </script>

        <style>
            [x-cloak] { display: none !important; }
            body { scroll-behavior: smooth; overflow-x: hidden; }
            
            .mesh-gradient {
                position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
                background-color: #f8fafc;
                background-image: radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.08) 0px, transparent 50%);
            }
            .dark .mesh-gradient {
                background-color: #020617;
                background-image: radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.12) 0px, transparent 50%);
            }

            .glass {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(0, 0, 0, 0.05);
            }
            .dark .glass {
                background: rgba(15, 23, 42, 0.6);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }

            .floating { animation: floating 4s ease-in-out infinite; }
            @keyframes floating {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-15px) rotate(1deg); }
            }

            @media (max-width: 768px) {
                .road-text-mini { font-size: 1.5rem !important; }
                .car-mini { width: 60px !important; height: 22px !important; }
            }
        </style>
    </head>
    <body class="bg-slate-50 dark:bg-dark-950 text-slate-900 dark:text-white transition-colors duration-500 font-sans tracking-tight">
        
        <div class="mesh-gradient"></div>

        <nav class="fixed top-0 w-full z-[100] px-4 sm:px-6 py-4 sm:py-6" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
            <div class="max-w-6xl mx-auto flex items-center justify-between glass p-4 rounded-2xl shadow-sm transition-all"
                 :class="scrolled ? 'scale-95 shadow-lg shadow-black/5' : ''">
                
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-accent rounded-lg flex items-center justify-center font-extrabold text-white">P</div>
                    <span class="text-lg font-bold italic">Parkir<span class="text-accent">Pro</span></span>
                </div>

                <div class="hidden md:flex items-center gap-8 text-[11px] font-bold uppercase tracking-widest text-slate-500">
                    <a href="#fitur" class="hover:text-accent transition-all">Fitur</a>
                    <a href="#reviews" class="hover:text-accent transition-all">Testimoni</a>
                    <a href="#contact" class="hover:text-accent transition-all">Kontak</a>
                </div>

                <div class="flex items-center gap-2 sm:gap-4">
                    <button @click="darkMode = !darkMode" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                        <template x-if="!darkMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                        </template>
                        <template x-if="darkMode">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m3.343-5.657l-.707.707m12.728 12.728l-.707.707M6.343 17.657l-.707-.707M17.657 6.343l-.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z"/></svg>
                        </template>
                    </button>
                    
                    <a href="{{ route('login') }}" class="px-4 sm:px-6 py-2 sm:py-2.5 bg-slate-900 dark:bg-accent text-white dark:text-dark-950 rounded-xl text-[10px] sm:text-xs font-bold transition-all hover:opacity-80">Masuk</a>
                    
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 rounded-lg bg-slate-100 dark:bg-white/5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileMenu" x-cloak @click.away="mobileMenu = false" class="absolute top-24 left-6 right-6 glass p-6 rounded-2xl md:hidden flex flex-col gap-4 text-center font-bold text-xs uppercase tracking-widest">
                <a href="#fitur" @click="mobileMenu = false">Fitur</a>
                <a href="#reviews" @click="mobileMenu = false">Testimoni</a>
                <a href="#contact" @click="mobileMenu = false">Kontak</a>
            </div>
        </nav>

        <section class="min-h-screen flex items-center pt-32 pb-12 px-6">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center w-full">
                <div data-aos="fade-up" class="text-center lg:text-left">
                    <span class="text-accent text-[10px] font-bold tracking-[0.3em] uppercase block mb-4">Sistem Manajemen Terpadu</span>
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-[1.1] mb-6 italic tracking-tighter">
                        KONTROL FULL. <br><span class="text-accent text-outline">CUAN MAKSIMAL.</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 text-base sm:text-lg mb-10 max-w-md mx-auto lg:mx-0">
                        Pantau pendapatan, kelola akses, dan atur area parkir Anda lewat satu dashboard yang rapi dan transparan.
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <button class="px-8 py-4 bg-accent text-dark-950 rounded-2xl font-bold text-sm shadow-xl shadow-accent/20 hover:-translate-y-1 transition-all">Mulai Pakai</button>
                        <button class="px-8 py-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/5 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all text-slate-900 dark:text-white">Coba Demo</button>
                    </div>
                </div>

                <div class="relative w-full" data-aos="zoom-in">
                    <div class="glass p-4 sm:p-6 rounded-[2.5rem] floating shadow-2xl">
                        <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-inner">
                            <div class="p-4 border-b border-slate-100 dark:border-white/5 flex justify-between items-center">
                                <div class="flex gap-1.5">
                                    <div class="w-2.5 h-2.5 rounded-full bg-red-400"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-yellow-400"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-green-400"></div>
                                </div>
                                <span class="text-[9px] font-mono opacity-40">ParkirPro Analytics</span>
                            </div>
                            <div class="p-6 sm:p-8 space-y-6">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendapatan Hari Ini</p>
                                        <p class="text-2xl sm:text-3xl font-extrabold italic mt-1">Rp 8.420.000</p>
                                    </div>
                                    <div class="text-accent text-sm font-bold">+12%</div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="p-4 bg-slate-50 dark:bg-white/5 rounded-xl border border-slate-100 dark:border-white/5">
                                        <p class="text-[8px] font-bold opacity-50 uppercase">Slot Terisi</p>
                                        <p class="text-xl font-bold italic">840</p>
                                    </div>
                                    <div class="p-4 bg-slate-50 dark:bg-white/5 rounded-xl border border-slate-100 dark:border-white/5">
                                        <p class="text-[8px] font-bold opacity-50 uppercase">Member Baru</p>
                                        <p class="text-xl font-bold italic">12</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .road-mini { position: relative; width: 100%; height: 100px; border-radius: 1.0rem; overflow: hidden; display: flex; align-items: center; border: 1px solid rgba(0,0,0,0.05); transition: all 0.5s ease; margin-top: 1.5rem; }
                            .road-mini { background: rgba(0, 0, 0, 0.03); }
                            .dark .road-mini { background: #0f172a; border-color: rgba(255,255,255,0.05); }
                            .road-text-mini { position: absolute; width: 100%; text-align: center; font-size: 2rem; font-weight: 900; font-style: italic; text-transform: uppercase; letter-spacing: 0.2em; z-index: 1; color: rgba(15, 23, 42, 0.05); transition: color 0.5s ease; }
                            .dark .road-text-mini { color: rgba(255, 255, 255, 0.03); }
                            .road-line-mini { position: absolute; width: 100%; height: 2px; background: repeating-linear-gradient(90deg, transparent, transparent 30px, rgba(16, 185, 129, 0.2) 30px, rgba(16, 185, 129, 0.2) 60px); bottom: 20px; animation: drive-mini 0.8s linear infinite; }
                            .car-mini { position: relative; left: 51%; width: 70px; height: 25px; background: #10b981; border-radius: 6px 18px 6px 6px; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3); z-index: 10; animation: vibrate-mini 0.2s infinite; }
                            .car-mini::after { content: ''; position: absolute; top: 4px; right: 4px; width: 22px; height: 10px; background: #020617; border-radius: 3px 10px 3px 3px; }
                            .light-mini { position: absolute; right: -8px; top: 15px; width: 12px; height: 5px; background: #fff; filter: blur(4px); border-radius: 50%; box-shadow: 0 0 15px #fff; }
                            @keyframes drive-mini { from { background-position: 0 0; } to { background-position: -60px 0; } }
                            @keyframes vibrate-mini { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-1.5px); } }
                        </style>
                        <div class="road-mini">
                            <div class="road-text-mini">PARKIR...PRO</div>
                            <div class="road-line-mini"></div>
                            <div class="car-mini">
                                <div class="light-mini"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="py-24 px-6 border-t border-slate-200 dark:border-white/5">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="glass p-8 sm:p-10 rounded-[2rem] hover:border-accent transition-all duration-300" data-aos="fade-up">
                        <div class="w-12 h-12 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6 font-bold text-xl">01</div>
                        <h3 class="text-xl font-extrabold mb-3 italic uppercase">Anti Bocor</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Sistem pencatatan otomatis yang memastikan setiap rupiah masuk ke kantong Anda.</p>
                    </div>
                    <div class="glass p-8 sm:p-10 rounded-[2rem] hover:border-accent transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6 font-bold text-xl">02</div>
                        <h3 class="text-xl font-extrabold mb-3 italic uppercase">Laporan Real-Time</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Pantau grafik transaksi langsung dari HP atau Laptop kapan saja.</p>
                    </div>
                    <div class="glass p-8 sm:p-10 rounded-[2rem] hover:border-accent transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6 font-bold text-xl">03</div>
                        <h3 class="text-xl font-extrabold mb-3 italic uppercase">QR Scan Cepat</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Antrian lebih pendek karena proses masuk-keluar kendaraan hanya butuh sekali scan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="py-24 px-6">
            <div class="max-w-5xl mx-auto glass rounded-[2.5rem] sm:rounded-[3rem] p-8 sm:p-12 lg:p-16 flex flex-col md:flex-row gap-12 items-center">
                <div class="md:w-1/2 text-center md:text-left">
                    <h2 class="text-3xl sm:text-4xl font-extrabold mb-6 italic leading-none uppercase tracking-tighter">Punya Area Parkir? <br><span class="text-accent underline">Ayo Kerja Sama.</span></h2>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Konsultasikan kebutuhan Anda, tim kami akan siapkan solusi yang paling cocok.</p>
                </div>
                <form class="md:w-1/2 w-full space-y-4">
                    <input type="text" placeholder="Nama Anda" class="w-full bg-white dark:bg-dark-950 border border-slate-200 dark:border-white/10 p-4 rounded-xl outline-none focus:border-accent text-sm transition-all">
                    <textarea placeholder="Ceritakan Lokasi Parkir Anda" rows="3" class="w-full bg-white dark:bg-dark-950 border border-slate-200 dark:border-white/10 p-4 rounded-xl outline-none focus:border-accent text-sm transition-all"></textarea>
                    <button class="w-full py-4 bg-accent text-dark-950 font-bold rounded-xl shadow-lg shadow-accent/20 transition-all uppercase text-xs tracking-widest hover:scale-[1.02]">Hubungi Kami</button>
                </form>
            </div>
        </section>

        <footer class="py-12 text-center border-t border-slate-200 dark:border-white/5">
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.4em] px-4">&copy; 2026 ParkirPro // Fokus pada Efisiensi.</p>
        </footer>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script> AOS.init({ duration: 800, once: true }); </script>
    </body>
</html>