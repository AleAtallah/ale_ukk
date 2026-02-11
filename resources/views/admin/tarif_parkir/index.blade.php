<x-layouts.app :title="__('Tarif Parkir')">
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="absolute top-[-5%] right-[-5%] w-[45%] h-[45%] bg-amber-500/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[5%] w-[35%] h-[35%] bg-blue-600/5 blur-[100px] rounded-full animate-pulse" style="animation-delay: 2s"></div>
        
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/[0.01] to-transparent h-[2px] w-full animate-scan"></div>
    </div>

    <div class="relative mb-8 p-8 bg-white/5 backdrop-blur-md rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <svg class="w-32 h-32 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M11.8 2.1c-.5-.1-1-.1-1.5 0L4.2 4.5c-.7.2-1.2.9-1.2 1.6V18c0 .7.5 1.4 1.2 1.6l6.1 2.4c.5.2 1 .2 1.5 0l6.1-2.4c.7-.2 1.2-.9 1.2-1.6V6.1c0-.7-.5-1.4-1.2-1.6l-6.1-2.4zM12 4.1l4.5 1.8L12 7.7 7.5 5.9 12 4.1zM5 16.9V7.6l6 2.4v9.3l-6-2.4zm14 0l-6 2.4v-9.3l6-2.4v9.3z"/>
            </svg>
        </div>
        
        <div class="relative flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-10 bg-amber-500 rounded-full shadow-[0_0_15px_#f59e0b]"></div>
                    <flux:heading size="xl" class="!text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                        Tarif <span class="text-amber-500 drop-shadow-[0_0_10px_rgba(245,158,11,0.3)]">Parkir</span>
                    </flux:heading>
                </div>
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.3em] ml-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                    Parameter Monetisasi & Jenis Kendaraan
                </p>
            </div>

            <a href="{{ route('admin.tarif-parkir.create') }}" wire:navigate.hover 
               class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-dark-950 text-xs font-black rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-2xl shadow-amber-500/20 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2 tracking-widest uppercase text-dark-950">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v12m6-6H6"/>
                    </svg>
                    Tambah Tarif
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-amber-400 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-4 p-4 bg-amber-500/10 backdrop-blur-md border border-amber-500/20 rounded-[1.5rem]">
                <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-dark-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="text-xs font-black text-amber-500 uppercase italic tracking-widest">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-[#0b1222]/80 backdrop-blur-2xl rounded-[2.8rem] border border-white/10 shadow-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-700">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">No</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Klasifikasi</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Nilai Ekonomi</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Timestamp</th>
                        <th class="px-8 py-7 text-right text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Kontrol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($tarifs as $index => $tarif)
                        <tr class="group hover:bg-white/[0.03] transition-all duration-300">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-neutral-600 group-hover:text-amber-500 transition-colors">
                                    #{{ str_pad($tarifs->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    @php
                                        $icon = match($tarif->jenis_kendaraan) {
                                            'mobil' => 'M21 16V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8M3 10h18M7 15h.01M17 15h.01',
                                            'motor' => 'M10 17a3 3 0 100-6 3 3 0 000 6z M19 17a3 3 0 100-6 3 3 0 000 6z M14 9l-3 3M14 9h5',
                                            default => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'
                                        };
                                        $colorClass = match($tarif->jenis_kendaraan) {
                                            'mobil' => 'text-blue-400 bg-blue-500/10 border-blue-500/20',
                                            'motor' => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                                            default => 'text-purple-400 bg-purple-500/10 border-purple-500/20'
                                        };
                                    @endphp
                                    <div class="w-10 h-10 rounded-xl border flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform {{ $colorClass }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-black text-white italic uppercase tracking-wider group-hover:text-amber-400 transition-colors">
                                        {{ $tarif->jenis_kendaraan }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-amber-500 font-mono tracking-tighter">
                                        IDR {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[9px] text-neutral-500 font-bold uppercase tracking-widest mt-0.5">Per 60 Minutes cycle</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col opacity-60 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[11px] font-bold text-white uppercase">{{ $tarif->created_at->format('d M Y') }}</span>
                                    <span class="text-[9px] font-mono text-neutral-500 mt-0.5">{{ $tarif->created_at->format('H:i:s') }} UTC</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3 opacity-20 group-hover:opacity-100 transition-all duration-300">
                                    <a href="{{ route('admin.tarif-parkir.edit', $tarif) }}" wire:navigate.hover
                                       class="p-3 bg-white/5 hover:bg-amber-500 hover:text-dark-950 text-white rounded-2xl transition-all border border-white/5 hover:-translate-y-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.tarif-parkir.destroy', $tarif) }}" method="POST" 
                                          onsubmit="return confirm('Hapus parameter tarif ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="p-3 bg-white/5 hover:bg-red-500 text-white rounded-2xl transition-all border border-white/5 hover:-translate-y-1">
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
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center border border-white/10 mb-4 animate-pulse">
                                        <svg class="w-10 h-10 text-neutral-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">Zero Economic Data</h3>
                                    <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-[0.4em] mt-2 italic">Belum ada tarif yang dikonfigurasi</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tarifs->hasPages())
            <div class="px-8 py-6 bg-white/[0.03] border-t border-white/5">
                {{ $tarifs->links() }}
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