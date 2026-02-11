<x-layouts.auth>
    <div class="relative group mx-auto scale-90 md:scale-95 transition-all"> <a href="{{ route('home') }}" class="absolute -top-10 left-0 flex items-center gap-2 text-[9px] font-black text-gray-500 hover:text-accent transition-all uppercase tracking-[0.2em] group/back">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover/back:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
            </svg>
            Beranda
        </a>

        <div class="absolute -inset-1 bg-gradient-to-r from-accent/50 to-emerald-600 rounded-[3rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
        
        <div class="relative flex flex-col w-[450px] p-9 bg-[#0b1222] rounded-[2.8rem] border border-white/10 shadow-2xl overflow-hidden">
            
            <div class="flex flex-col items-center mb-6">
                <div class="relative mb-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-accent to-emerald-700 rounded-2xl rotate-12 flex items-center justify-center shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                        <span class="text-xl font-black text-dark-900 -rotate-12">P</span>
                    </div>
                </div>
                
                <h2 class="text-2xl font-black italic tracking-tighter text-white uppercase">
                    Daftar <span class="text-accent">ParkirPro</span>
                </h2>
                <p class="text-[9px] text-gray-500 font-bold tracking-[0.3em] uppercase mt-1">Registrasi Pengelola</p>
            </div>

            <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
                @csrf

                <div class="group/input">
                    <label class="block text-[9px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1.5 ml-4">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within/input:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input type="text" name="name" :value="old('name')" required autofocus
                            class="w-full bg-[#161f32] border border-white/5 rounded-2xl py-3 pl-12 pr-6 text-sm text-white placeholder-gray-700 outline-none focus:border-accent/50 focus:ring-4 focus:ring-accent/5 transition-all"
                            placeholder="Input nama lengkap...">
                    </div>
                </div>

                <div class="group/input">
                    <label class="block text-[9px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1.5 ml-4">Email Resmi</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within/input:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input type="email" name="email" :value="old('email')" required
                            class="w-full bg-[#161f32] border border-white/5 rounded-2xl py-3 pl-12 pr-6 text-sm text-white placeholder-gray-700 outline-none focus:border-accent/50 focus:ring-4 focus:ring-accent/5 transition-all"
                            placeholder="nama@perusahaan.id">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="group/input">
                        <label class="block text-[9px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1.5 ml-4">Sandi</label>
                        <input type="password" name="password" required
                            class="w-full bg-[#161f32] border border-white/5 rounded-2xl py-3 px-5 text-sm text-white placeholder-gray-700 outline-none focus:border-accent/50 focus:ring-4 focus:ring-accent/5 transition-all"
                            placeholder="Min. 8 char">
                    </div>

                    <div class="group/input">
                        <label class="block text-[9px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1.5 ml-4">Ulangi</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full bg-[#161f32] border border-white/5 rounded-2xl py-3 px-5 text-sm text-white placeholder-gray-700 outline-none focus:border-accent/50 focus:ring-4 focus:ring-accent/5 transition-all"
                            placeholder="Sandi sama">
                    </div>
                </div>

                <button type="submit" class="relative overflow-hidden w-full bg-white hover:bg-gray-100 text-dark-900 font-black py-4 rounded-2xl transition-all group/btn mt-2 shadow-xl active:scale-95">
                    <span class="relative z-10 flex items-center justify-center gap-2 tracking-[0.2em] text-[10px]">
                        DAFTARKAN AKUN
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-accent to-emerald-400 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-white/5 text-center">
                <p class="text-[9px] text-gray-600 font-black uppercase tracking-[0.2em]">Sudah punya akses?</p>
                <a href="{{ route('login') }}" class="inline-block mt-1 text-xs font-bold text-white hover:text-accent transition-all italic underline underline-offset-4 decoration-accent/30">Kembali Login</a>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');

        body {
            background-color: #020617 !important;
            background-image: 
                radial-gradient(at 100% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 40%),
                radial-gradient(at 0% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 40%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            overflow: hidden;
        }
        .text-accent { color: #10b981; }
        .bg-accent { background-color: #10b981; }
        .text-dark-900 { color: #020617; }
    </style>
</x-layouts.auth>