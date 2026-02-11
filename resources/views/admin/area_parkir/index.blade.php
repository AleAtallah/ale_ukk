<x-layouts.app :title="__('Area Parkir')">
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-600/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-emerald-500/5 blur-[100px] rounded-full animate-pulse"></div>

        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/[0.01] to-transparent h-[2px] w-full animate-scan"></div>
    </div>

    <div class="relative mb-8 p-8 bg-white/5 backdrop-blur-md rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <svg class="w-32 h-32 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
            </svg>
        </div>

        <div class="relative flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-10 bg-blue-500 rounded-full shadow-[0_0_15px_#3b82f6]"></div>
                    <flux:heading size="xl" class="!text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                        Area <span class="text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.3)]">Parkir</span>
                    </flux:heading>
                </div>
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.3em] ml-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                    Konfigurasi & Kapasitas Infrastruktur
                </p>
            </div>

            <a href="{{ route('admin.area-parkir.create') }}" wire:navigate.hover
                class="group relative inline-flex items-center gap-3 px-8 py-4 bg-white text-dark-950 text-xs font-black rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-2xl shadow-blue-500/20 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2 tracking-widest uppercase">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Area
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 animate-in slide-in-from-top-4 duration-500">
        <div class="flex items-center gap-4 p-4 bg-emerald-500/10 backdrop-blur-md border border-emerald-500/20 rounded-[1.5rem]">
            <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                <i data-lucide="check" class="text-white w-5 h-5"></i>
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
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Identitas Area</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Visual Kapasitas</th>
                        <th class="px-8 py-7 text-right text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Kontrol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($data as $index => $area)
                    @php
                    $persen = ($area->terisi / ($area->kapasitas ?: 1)) * 100;
                    $isKritis = $persen >= 90;
                    @endphp
                    <tr class="group hover:bg-white/[0.03] transition-all">
                        <td class="px-8 py-6">
                            <span class="text-xs font-mono text-neutral-600 group-hover:text-blue-500 transition-colors">
                                #{{ str_pad($data->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-neutral-800 to-neutral-950 border border-white/10 flex items-center justify-center shadow-xl group-hover:rotate-12 transition-all">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-blue-500"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-black text-white italic uppercase tracking-tight group-hover:text-blue-400 transition-colors">{{ $area->nama_area }}</span>
                                    <span class="text-[10px] text-neutral-500 font-bold uppercase tracking-widest mt-0.5">Static Infrastructure</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="w-full max-w-xs space-y-2">
                                <div class="flex justify-between items-end">
                                    <span class="text-[10px] font-black {{ $isKritis ? 'text-red-500' : 'text-blue-500' }} uppercase tracking-tighter">
                                        {{ $area->terisi }} / {{ $area->kapasitas }} <span class="text-neutral-600">Units</span>
                                    </span>
                                    <span class="text-xs font-mono {{ $isKritis ? 'text-red-500' : 'text-blue-400' }}">{{ round($persen) }}%</span>
                                </div>
                                <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden border border-white/5 p-[1px]">
                                    <div class="h-full rounded-full transition-all duration-1000 {{ $isKritis ? 'bg-red-500 shadow-[0_0_10px_#ef4444]' : 'bg-blue-500 shadow-[0_0_10px_#3b82f6]' }}"
                                        style="width: {{ $persen }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.area-parkir.edit', $area) }}" wire:navigate.hover
                                    class="flex items-center gap-2 px-3 py-2 bg-blue-600/10 hover:bg-blue-600 text-blue-500 hover:text-white rounded-xl transition-all border border-blue-500/20 text-[10px] font-black uppercase italic">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.area-parkir.destroy', $area) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus area ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-2 px-3 py-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-xl transition-all border border-red-500/20 text-[10px] font-black uppercase italic">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-32 text-center">
                            <div class="flex flex-col items-center">
                                <i data-lucide="layers" class="w-16 h-16 text-neutral-800 mb-4"></i>
                                <h3 class="text-2xl font-black text-white italic uppercase">No Infrastructure</h3>
                                <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-[0.4em] mt-2">Segera tambahkan area parkir baru</p>
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
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(1000%);
            }
        }

        .animate-scan {
            animation: scan 10s linear infinite;
        }

        .text-dark-950 {
            color: #020617;
        }

        body {
            background-color: #020617;
        }
    </style>
</x-layouts.app>