<x-layouts.app :title="__('Kendaraan')">
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="absolute top-[-10%] left-[-5%] w-[50%] h-[50%] bg-indigo-600/10 blur-[130px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[10%] right-[-5%] w-[40%] h-[40%] bg-violet-500/5 blur-[100px] rounded-full animate-pulse"></div>
        
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/[0.01] to-transparent h-[2px] w-full animate-scan"></div>
    </div>

    <div class="relative mb-8 p-8 bg-white/5 backdrop-blur-md rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <svg class="w-32 h-32 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
            </svg>
        </div>
        
        <div class="relative flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-10 bg-indigo-500 rounded-full shadow-[0_0_15px_#6366f1]"></div>
                    <flux:heading size="xl" class="!text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                        Registry <span class="text-indigo-500 drop-shadow-[0_0_10px_rgba(99,102,241,0.3)]">Kendaraan</span>
                    </flux:heading>
                </div>
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.3em] ml-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                    Centralized Vehicle Identification System
                </p>
            </div>

            <a href="{{ route('admin.kendaraan.create') }}" wire:navigate.hover 
               class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-dark-950 text-xs font-black rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-2xl shadow-indigo-500/20 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2 tracking-widest uppercase">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Unit
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 animate-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-4 p-4 bg-emerald-500/10 backdrop-blur-md border border-emerald-500/20 rounded-[1.5rem]">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="text-xs font-black text-emerald-500 uppercase italic tracking-widest">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-[#0b1222]/80 backdrop-blur-2xl rounded-[2.8rem] border border-white/10 shadow-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-700">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">No</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Identifikasi Unit</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Detail Spek</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Pemilik / Entitas</th>
                        <th class="px-8 py-7 text-right text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Kontrol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($data as $index => $kendaraan)
                        <tr class="group hover:bg-white/[0.03] transition-all duration-300">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-neutral-600 group-hover:text-indigo-400 transition-colors">
                                    #{{ str_pad($data->firstItem() + $index, 3, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="px-3 py-1.5 bg-neutral-900 border-2 border-neutral-700 rounded-md shadow-inner">
                                        <span class="text-sm font-mono font-black text-white tracking-widest uppercase">
                                            {{ $kendaraan->plat_nomor }}
                                        </span>
                                    </div>
                                    <div class="h-8 w-[1px] bg-white/10"></div>
                                    <span class="text-[10px] font-black text-indigo-500 uppercase tracking-tighter">Verified Plate</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-white italic uppercase tracking-tight group-hover:text-indigo-400 transition-colors">
                                        {{ $kendaraan->jenis_kendaraan }}
                                    </span>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="w-2 h-2 rounded-full shadow-[0_0_5px_currentColor]" style="color: {{ strtolower($kendaraan->warna) == 'putih' ? '#fff' : (strtolower($kendaraan->warna) == 'hitam' ? '#444' : $kendaraan->warna) }}; background-color: currentColor"></div>
                                        <span class="text-[10px] text-neutral-500 font-bold uppercase tracking-widest">{{ $kendaraan->warna }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-[10px] font-black text-white">
                                        {{ substr($kendaraan->pemilik, 0, 1) }}
                                    </div>
                                    <span class="text-xs font-bold text-neutral-300 uppercase tracking-wide group-hover:text-white transition-colors">
                                        {{ $kendaraan->pemilik }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2 opacity-20 group-hover:opacity-100 transition-all duration-300">
                                    <a href="{{ route('admin.kendaraan.edit', $kendaraan) }}" wire:navigate.hover
                                       class="p-2.5 bg-white/5 hover:bg-indigo-600 text-white rounded-xl transition-all border border-white/5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.kendaraan.destroy', $kendaraan) }}" method="POST" 
                                          onsubmit="return confirm('Hapus unit dari database?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="p-2.5 bg-white/5 hover:bg-red-500 text-white rounded-xl transition-all border border-white/5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="relative w-24 h-24 mb-6">
                                        <div class="absolute inset-0 bg-indigo-500/20 rounded-full animate-ping"></div>
                                        <div class="relative bg-neutral-900 rounded-full w-full h-full flex items-center justify-center border border-white/10">
                                            <svg class="w-10 h-10 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">No Units Tracked</h3>
                                    <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-[0.4em] mt-2 italic">Database identitas masih kosong</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($data->hasPages())
            <div class="px-8 py-6 bg-white/[0.03] border-t border-white/5">
                {{ $data->links() }}
            </div>
        @endif
    </div>

    <style>
        @keyframes scan {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(1000%); }
        }
        .animate-scan { animation: scan 10s linear infinite; }
        .text-dark-950 { color: #020617; }
        body { background-color: #020617; }
    </style>
</x-layouts.app>