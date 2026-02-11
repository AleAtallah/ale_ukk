<x-app-layout>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-4xl font-black text-white uppercase italic tracking-tighter">
                System <span class="text-emerald-500">Dashboard</span>
            </h1>
            <p class="text-gray-500 text-sm font-medium tracking-wide">Monitoring and Analytics Control Center</p>
        </div>
        
        <div class="bg-[#0b1222] border border-white/5 p-2 rounded-2xl shadow-2xl backdrop-blur-xl">
            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap md:flex-nowrap gap-3 items-center">
                <div class="flex items-center gap-2 px-3">
                    <span class="text-[10px] font-black text-emerald-500/50 uppercase tracking-widest">From</span>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="bg-transparent border-none text-white text-xs font-bold focus:ring-0 cursor-pointer">
                </div>
                <div class="w-[1px] h-6 bg-white/10 hidden md:block"></div>
                <div class="flex items-center gap-2 px-3">
                    <span class="text-[10px] font-black text-emerald-500/50 uppercase tracking-widest">To</span>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="bg-transparent border-none text-white text-xs font-bold focus:ring-0 cursor-pointer">
                </div>
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-400 text-dark-900 px-6 py-2 rounded-xl text-xs font-black uppercase italic transition-all shadow-lg shadow-emerald-500/20">
                    Filter
                </button>
                @if (auth()->user()->role === 'owner')
                    <a href="{{ route('dashboard.cetak-rekap-transaksi', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                        class="bg-white/5 hover:bg-white/10 text-white border border-white/10 px-6 py-2 rounded-xl text-xs font-black uppercase italic transition-all">
                        Export PDF
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-[#0b1222] border border-white/5 rounded-[2.5rem] p-8 relative overflow-hidden group shadow-2xl">
            <div class="relative z-10">
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Total Transaksi</p>
                <h3 class="text-4xl font-black text-white italic">{{ number_format($totalTransaksi) }}</h3>
                <div class="mt-4 flex gap-3">
                    <span class="text-[10px] font-bold text-yellow-500 bg-yellow-500/10 px-2 py-0.5 rounded-md">IN: {{ $transaksiMasuk }}</span>
                    <span class="text-[10px] font-bold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-md">OUT: {{ $transaksiKeluar }}</span>
                </div>
            </div>
            <div class="absolute -right-6 -top-6 text-white/[0.03] group-hover:text-emerald-500/[0.05] transition-colors">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>

        <div class="bg-[#0b1222] border border-emerald-500/20 rounded-[2.5rem] p-8 relative overflow-hidden group shadow-2xl border-b-4 border-b-emerald-500">
            <div class="relative z-10">
                <p class="text-emerald-500/70 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Revenue</p>
                <h3 class="text-3xl font-black text-white italic">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                <p class="text-gray-600 text-[10px] mt-2 font-bold uppercase tracking-widest">Collected Balance</p>
            </div>
        </div>

        <div class="bg-[#0b1222] border border-white/5 rounded-[2.5rem] p-8 relative overflow-hidden group shadow-2xl">
            <div class="relative z-10">
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Total Registered</p>
                <h3 class="text-4xl font-black text-white italic">{{ number_format($totalKendaraan) }}</h3>
                <p class="text-gray-600 text-[10px] mt-2 font-bold uppercase tracking-widest">Vehicles in System</p>
            </div>
        </div>

        <div class="bg-[#0b1222] border border-white/5 rounded-[2.5rem] p-8 relative overflow-hidden group shadow-2xl">
            <div class="relative z-10">
                <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Parking Capacity</p>
                <h3 class="text-3xl font-black text-white italic">{{ number_format($kapasitasTersedia) }} <span class="text-sm text-gray-600 not-italic">/ {{ $totalKapasitas }}</span></h3>
                <div class="mt-4 w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full shadow-[0_0_10px_#10b981]" style="width: {{ $totalKapasitas > 0 ? min(($totalTerisi / $totalKapasitas) * 100, 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <div class="lg:col-span-2 bg-[#0b1222] border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-6 border-b border-white/5 bg-white/[0.02] flex justify-between items-center">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-white italic">Parking Area Statistics</h3>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($statistikArea as $area)
                    <div class="p-5 bg-white/[0.02] border border-white/5 rounded-2xl hover:border-emerald-500/30 transition-all">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm font-black text-white uppercase italic tracking-wider">{{ $area->nama_area }}</span>
                            <span class="text-[10px] font-bold text-gray-500">{{ $area->terisi }}/{{ $area->kapasitas }} SLOT</span>
                        </div>
                        <div class="flex justify-between items-end">
                            <span class="text-[10px] text-gray-500 uppercase font-bold">{{ $area->total_transaksi }} Transaksi</span>
                            <span class="text-sm font-black text-emerald-500 italic">Rp {{ number_format($area->pendapatan_area ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-xs italic">No area data available.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-[#0b1222] border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl">
            <div class="px-8 py-6 border-b border-white/5 bg-white/[0.02]">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-white italic">Officer Activity</h3>
            </div>
            <div class="p-8 space-y-4">
                @if($user->role === 'admin')
                    @forelse($statistikPerPetugas as $petugas)
                        <div class="flex justify-between items-center p-4 bg-white/[0.02] rounded-2xl border border-white/5">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-xs font-bold text-gray-300 uppercase">{{ $petugas->name }}</span>
                            </div>
                            <span class="text-[10px] font-black text-emerald-500 bg-emerald-500/10 px-3 py-1 rounded-full uppercase italic">{{ $petugas->total_transaksi }} TX</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-xs italic text-center">No active officers.</p>
                    @endforelse
                @else
                    <div class="flex flex-col items-center justify-center py-10 opacity-20">
                        <svg class="w-16 h-16 text-white mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <p class="text-[10px] font-black uppercase tracking-widest text-white">Access Restricted</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-[#0b1222] border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl">
        <div class="px-8 py-6 border-b border-white/5 bg-white/[0.02]">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-white italic">Live Transaction Feed</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/[0.02] text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] border-b border-white/5">
                    <tr>
                        <th class="px-8 py-5">#</th>
                        <th class="px-8 py-5">Vehicle ID</th>
                        <th class="px-8 py-5">Zone</th>
                        <th class="px-8 py-5">Entry Time</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5 text-right">Fee</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($transaksiTerbaru as $index => $transaksi)
                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="px-8 py-5 text-xs text-gray-600 font-bold">{{ $index + 1 }}</td>
                            <td class="px-8 py-5 text-sm font-black text-white uppercase italic tracking-widest group-hover:text-emerald-500 transition-colors">
                                {{ $transaksi->kendaraan->plat_nomor }}
                            </td>
                            <td class="px-8 py-5 text-xs text-gray-400 uppercase font-bold">{{ $transaksi->area->nama_area }}</td>
                            <td class="px-8 py-5 text-xs text-gray-500 font-medium">{{ $transaksi->waktu_masuk->format('d/m/y H:i') }}</td>
                            <td class="px-8 py-5">
                                <span class="text-[9px] font-black uppercase italic px-3 py-1 rounded-full tracking-widest border {{ $transaksi->status == 'masuk' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' }}">
                                    {{ $transaksi->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right text-sm font-black text-white italic">
                                {{ $transaksi->biaya_total ? 'Rp ' . number_format($transaksi->biaya_total, 0, ',', '.') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center opacity-30">
                                <p class="text-[10px] font-black uppercase tracking-[0.5em] text-white">No Active Data Stream</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>