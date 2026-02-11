<div class="px-2 py-3">
    {{-- Profil Utama (Box Atas) --}}
    <div class="group relative p-4 rounded-2xl bg-gradient-to-br from-indigo-600/20 to-transparent border border-white/5 transition-all duration-300 hover:border-indigo-500/30 overflow-hidden">
        {{-- Background Glow Dekoratif --}}
        <div class="absolute -right-4 -top-4 w-16 h-16 bg-indigo-600/10 blur-2xl rounded-full group-hover:bg-indigo-600/20 transition-all"></div>
        
        <div class="flex items-center gap-3 relative z-10">
            {{-- Avatar dengan Neon Ring --}}
            <div class="relative">
                <div class="absolute inset-0 bg-indigo-500 blur-md opacity-20 group-hover:opacity-40 transition-opacity rounded-full"></div>
                <div class="w-12 h-12 rounded-full border-2 border-indigo-500/50 flex items-center justify-center bg-[#0b1222] text-indigo-400 font-black text-lg shadow-inner relative">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                {{-- Status Indicator --}}
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-[#020617] rounded-full"></div>
            </div>

            <div class="flex flex-col min-w-0">
                <span class="text-sm font-bold text-white truncate group-hover:text-indigo-300 transition-colors">
                    {{ auth()->user()->name }}
                </span>
                <span class="text-[10px] text-neutral-500 font-medium truncate uppercase tracking-widest">
                    {{ auth()->user()->role ?? 'User' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Action Menu (List Bawah) --}}
    <div class="mt-4 space-y-1">
        {{-- Menu Item: Settings --}}
        <a href="{{ route('profile.edit') }}" wire:navigate
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-neutral-400 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/5 transition-all group">
            <flux:icon name="cog-6-tooth" variant="micro" class="group-hover:rotate-90 transition-transform duration-500" />
            <span class="text-xs font-bold uppercase tracking-wider">{{ __('Settings') }}</span>
        </a>

        {{-- Menu Item: Log Out --}}
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400/70 hover:text-red-400 hover:bg-red-500/5 border border-transparent hover:border-red-500/10 transition-all group">
                <flux:icon name="arrow-right-start-on-rectangle" variant="micro" class="group-hover:translate-x-1 transition-transform" />
                <span class="text-xs font-bold uppercase tracking-wider">{{ __('Log Out') }}</span>
            </button>
        </form>
    </div>
</div>