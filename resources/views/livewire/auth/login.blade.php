<x-layouts.auth>
    <div class="relative group scale-90 md:scale-100"> <a href="{{ route('home') }}" class="absolute -top-12 left-0 flex items-center gap-2 text-[10px] font-black text-gray-500 hover:text-accent transition-all uppercase tracking-[0.2em] group/back">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover/back:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>

        <div class="absolute -inset-1 bg-gradient-to-r from-accent/50 to-emerald-600 rounded-[3rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
        
        <div class="relative flex flex-col w-[400px] p-10 bg-[#0b1222] rounded-[2.8rem] border border-white/10 shadow-2xl overflow-hidden">
            
            <div class="flex flex-col items-center mb-6"> <div class="relative mb-4">
                    <div class="w-14 h-14 bg-gradient-to-br from-accent to-emerald-700 rounded-2xl rotate-12 flex items-center justify-center shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                        <span class="text-xl font-black text-dark-900 -rotate-12">P</span>
                    </div>
                </div>
                
                <h2 class="text-3xl font-black italic tracking-tighter text-white uppercase">
                    Parkir<span class="text-accent">Pro</span>
                </h2>
                <div class="h-1 w-10 bg-accent mt-1 rounded-full opacity-50"></div>
            </div>

            <x-auth-session-status class="mb-4 text-center text-accent text-[10px] font-bold" :status="session('status')" />

            <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
                @csrf

                <div class="group/input">
                    <label class="block text-[9px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1.5 ml-4">Identitas Email</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within/input:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </span>
                        <input type="email" name="email" required autofocus
                            class="w-full bg-[#161f32] border border-white/5 rounded-2xl py-3.5 pl-12 pr-6 text-sm text-white placeholder-gray-700 outline-none focus:border-accent/50 focus:ring-4 focus:ring-accent/5 transition-all"
                            placeholder="admin@parkirpro.id">
                    </div>
                </div>

                <div class="group/input">
                    <div class="flex justify-between items-center mb-1.5 ml-4 mr-2">
                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-[0.2em]">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[9px] font-bold text-accent/60 hover:text-accent transition-colors">LUPA?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within/input:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input type="password" name="password" required
                            class="w-full bg-[#161f32] border border-white/5 rounded-2xl py-3.5 pl-12 pr-6 text-sm text-white placeholder-gray-700 outline-none focus:border-accent/50 focus:ring-4 focus:ring-accent/5 transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between px-2">
                    <label class="flex items-center gap-2 cursor-pointer group/check">
                        <div class="relative flex items-center">
                            <input type="checkbox" name="remember" class="peer h-4 w-4 opacity-0 absolute cursor-pointer">
                            <div class="h-4 w-4 bg-[#161f32] border border-white/10 rounded peer-checked:bg-accent peer-checked:border-accent transition-all flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5 text-dark-900 hidden peer-checked:block" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Tetap Masuk</span>
                    </label>
                </div>

                <button type="submit" class="relative overflow-hidden w-full bg-white hover:bg-gray-100 text-dark-900 font-black py-4 rounded-2xl transition-all group/btn mt-2 shadow-xl active:scale-95">
                    <span class="relative z-10 flex items-center justify-center gap-2 tracking-[0.2em] text-[10px]">
                        MASUK KE SISTEM
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-accent to-emerald-400 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-500"></div>
                </button>
            </form>

            @if (Route::has('register'))
                <div class="mt-8 pt-6 border-t border-white/5 text-center">
                    <p class="text-[9px] text-gray-600 font-black uppercase tracking-[0.2em]">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="inline-block mt-1 text-xs font-bold text-white hover:text-accent transition-all italic underline underline-offset-4 decoration-accent/30">Daftar Pengelola</a>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Menggunakan font Inter atau Poppins yang lebih bersih */
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
            overflow: hidden; /* Mencegah scroll jika tidak perlu */
        }
        .text-accent { color: #10b981; }
        .bg-accent { background-color: #10b981; }
        .text-dark-900 { color: #020617; }
    </style>
</x-layouts.auth>