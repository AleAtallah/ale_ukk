<x-layouts.app :title="__('Transaksi')">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl" level="1">Log Transaksi</flux:heading>
            <flux:subheading>Monitoring arus masuk dan keluar kendaraan secara real-time.</flux:subheading>
        </div>
        
        <flux:button 
            :href="route('petugas.transaksi.create', ['id_area' => request()->query('area')])" 
            variant="primary" 
            icon="plus" 
            wire:navigate.hover
            class="bg-blue-600 hover:bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.4)]"
        >
            Kendaraan Masuk
        </flux:button>
    </div>

    {{-- Notification Alerts --}}
    @if (session('success'))
        <div class="mb-6 animate-in fade-in slide-in-from-top-2 duration-300">
            <div class="flex items-center gap-3 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl">
                <flux:icon name="check-circle" variant="micro" class="text-emerald-500 w-5 h-5" />
                <p class="text-sm font-medium text-emerald-400">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 animate-in fade-in slide-in-from-top-2 duration-300">
            <div class="flex items-center gap-3 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl">
                <flux:icon name="exclamation-triangle" variant="micro" class="text-red-500 w-5 h-5" />
                <p class="text-sm font-medium text-red-400">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Modern Table Card --}}
    <div class="mt-4 overflow-hidden bg-[#0b1222]/50 backdrop-blur-xl rounded-[2rem] border border-white/10 shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/[0.02] border-b border-white/5">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">No</th>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Kendaraan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Area</th>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Waktu Masuk</th>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Waktu Keluar</th>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Biaya</th>
                        <th class="px-6 py-4 text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Status</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-neutral-500 uppercase tracking-[0.2em]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($transaksis as $index => $transaksi)
                        <tr class="group hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 text-xs font-mono text-neutral-500">
                                {{ $transaksis->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-white tracking-wider group-hover:text-blue-400 transition-colors">
                                        {{ $transaksi->kendaraan->plat_nomor }}
                                    </span>
                                    <span class="text-[10px] uppercase text-neutral-500 font-bold">
                                        {{ $transaksi->kendaraan->jenis_kendaraan }} • {{ $transaksi->kendaraan->warna }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-lg bg-blue-500/10 border border-blue-500/20 text-[10px] font-black text-blue-400 uppercase">
                                    {{ $transaksi->area->nama_area }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs text-neutral-400 font-medium">
                                {{ $transaksi->waktu_masuk->format('H:i') }}
                                <span class="block text-[10px] text-neutral-600 uppercase">{{ $transaksi->waktu_masuk->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-neutral-400 font-medium">
                                @if($transaksi->waktu_keluar)
                                    {{ $transaksi->waktu_keluar->format('H:i') }}
                                    <span class="block text-[10px] text-neutral-600 uppercase">{{ $transaksi->waktu_keluar->format('d M Y') }}</span>
                                @else
                                    <span class="text-neutral-700 font-bold tracking-widest">--:--</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($transaksi->biaya_total)
                                    <span class="text-sm font-mono font-bold text-emerald-400">
                                        Rp{{ number_format($transaksi->biaya_total, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-neutral-600 font-mono text-xs italic opacity-50">Menunggu...</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($transaksi->status == 'masuk')
                                    <span class="flex items-center gap-2 text-[10px] font-black text-yellow-500 uppercase tracking-tighter">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                                        </span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="flex items-center gap-2 text-[10px] font-black text-emerald-500 uppercase tracking-tighter">
                                        <span class="h-2 w-2 inline-flex rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></span>
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if ($transaksi->status == 'masuk')
                                        <form action="{{ route('petugas.transaksi.update', $transaksi) }}" method="POST">
                                            @csrf @method('PUT')
                                            {{-- Hidden inputs to maintain data integrity --}}
                                            <input type="hidden" name="id_kendaraan" value="{{ $transaksi->id_kendaraan }}" />
                                            <input type="hidden" name="id_tarif" value="{{ $transaksi->id_tarif }}" />
                                            <input type="hidden" name="id_area" value="{{ $transaksi->id_area }}" />
                                            
                                            <button type="submit" onclick="return confirm('Proses pembayaran dan keluarkan kendaraan?')" class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-400 text-dark-950 text-[10px] font-black uppercase rounded-lg transition-all shadow-lg shadow-emerald-500/20 active:scale-95">
                                                Checkout
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('petugas.transaksi.cetak-struk', $transaksi->id) }}" target="_blank" class="p-2 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all border border-white/10 group/btn">
                                            <flux:icon name="printer" variant="micro" class="w-4 h-4 group-hover/btn:text-blue-400" />
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="p-4 bg-white/5 rounded-full mb-4">
                                        <flux:icon name="clipboard-document-list" class="w-12 h-12 text-neutral-700" />
                                    </div>
                                    <p class="text-sm font-black uppercase tracking-[0.3em] text-neutral-600">Belum ada transaksi</p>
                                    <p class="text-xs text-neutral-700 mt-1">Data akan muncul setelah ada kendaraan masuk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination Section --}}
    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>
</x-layouts.app>