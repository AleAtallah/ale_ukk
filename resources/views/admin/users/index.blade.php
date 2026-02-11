<x-layouts.app :title="__('Manajemen User')">
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-emerald-500/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/5 blur-[100px] rounded-full animate-pulse" style="animation-delay: 1s"></div>
        
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/[0.01] to-transparent h-[2px] w-full animate-scan"></div>
    </div>

    <div class="relative mb-8 p-8 bg-white/5 backdrop-blur-md rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <svg class="w-32 h-32 text-accent" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>
        
        <div class="relative flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-10 bg-accent rounded-full shadow-[0_0_15px_#10b981]"></div>
                    <flux:heading size="xl" class="!text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                        Data <span class="text-accent drop-shadow-[0_0_10px_rgba(16,185,129,0.3)]">User</span>
                    </flux:heading>
                </div>
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.3em] ml-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                    Otoritas & Akses Pengelola Sistem
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}" wire:navigate.hover 
               class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-dark-950 text-xs font-black rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-2xl shadow-accent/20 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2 tracking-widest uppercase">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah User
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-accent to-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 animate-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-4 p-4 bg-accent/10 backdrop-blur-md border border-accent/20 rounded-[1.5rem] shadow-lg shadow-accent/5">
                <div class="flex-shrink-0 w-10 h-10 bg-accent rounded-xl flex items-center justify-center shadow-[0_0_15px_#10b981]">
                    <svg class="w-6 h-6 text-dark-900" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p class="text-sm font-black text-accent uppercase italic tracking-wider">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-[#0b1222]/80 backdrop-blur-2xl rounded-[2.8rem] border border-white/10 shadow-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-700">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">No</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Profil Pengelola</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Level Akses</th>
                        <th class="px-8 py-7 text-right text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Kontrol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($users as $index => $user)
                        <tr class="group hover:bg-white/[0.03] transition-all">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-neutral-600 group-hover:text-accent transition-colors">
                                    #{{ str_pad($users->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-neutral-800 to-neutral-950 border border-white/10 flex items-center justify-center font-black text-accent shadow-xl group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-white group-hover:text-accent transition-colors tracking-tight italic uppercase">{{ $user->name }}</span>
                                        <span class="text-[11px] text-neutral-500 font-mono tracking-tighter">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $roleColor = match($user->role) {
                                        'admin' => 'bg-red-500/10 text-red-500 border-red-500/30 shadow-[0_0_10px_rgba(239,68,68,0.1)]',
                                        'petugas' => 'bg-accent/10 text-accent border-accent/30 shadow-[0_0_10px_rgba(16,185,129,0.1)]',
                                        default => 'bg-blue-500/10 text-blue-500 border-blue-500/30 shadow-[0_0_10px_rgba(59,130,246,0.1)]',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border {{ $roleColor }} backdrop-blur-md">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3 opacity-30 group-hover:opacity-100 transition-all duration-300">
                                    <a href="{{ route('admin.users.edit', $user) }}" wire:navigate.hover
                                       class="p-3 bg-white/5 hover:bg-accent hover:text-dark-950 text-white rounded-2xl transition-all shadow-lg border border-white/5 hover:-translate-y-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                          onsubmit="return confirm('Hapus user ini dari sistem?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="p-3 bg-white/5 hover:bg-red-500 text-white rounded-2xl transition-all shadow-lg border border-white/5 hover:-translate-y-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="relative mb-6">
                                        <div class="absolute inset-0 bg-accent/20 blur-3xl rounded-full animate-pulse"></div>
                                        <div class="relative w-24 h-24 bg-white/5 rounded-[2.5rem] flex items-center justify-center border border-white/10 shadow-2xl">
                                            <svg class="w-12 h-12 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter">Database Kosong</h3>
                                    <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-[0.4em] mt-2">Menunggu registrasi pengelola baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-8 py-6 bg-white/[0.03] border-t border-white/5 backdrop-blur-md">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <style>
        @keyframes scan {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(1000%); }
        }
        .animate-scan { animation: scan 10s linear infinite; }
        
        .text-accent { color: #10b981; }
        .bg-accent { background-color: #10b981; }
        .text-dark-950 { color: #020617; }
        
        body { background-color: #020617; }
    </style>
</x-layouts.app>