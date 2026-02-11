<x-layouts.app>
    <div class="p-8 max-w-7xl mx-auto space-y-10 animate-in fade-in duration-700">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 border-b border-white/5 pb-10">
            <div>
                <h1 class="text-4xl font-black text-white tracking-tighter uppercase italic">
                    Financial <span class="text-emerald-500">Analytics</span>
                </h1>
                <p class="text-gray-500 font-mono text-[10px] uppercase tracking-[0.3em] mt-2">Periode Laporan: {{ \Carbon\Carbon::parse($startDate)->format('d M') }} — {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
            </div>

            <form action="{{ route('owner.dashboard') }}" method="GET" class="flex items-center gap-3 bg-[#0b0f1a] p-2 rounded-2xl border border-white/10 shadow-xl">
                <div class="flex items-center gap-2 px-4 border-r border-white/5">
                    <i data-lucide="calendar" class="w-4 h-4 text-emerald-500"></i>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="bg-transparent border-none text-white text-xs font-bold focus:ring-0 w-32">
                    <span class="text-gray-700 font-black">-</span>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="bg-transparent border-none text-white text-xs font-bold focus:ring-0 w-32">
                </div>
                <button type="submit" class="bg-emerald-500 hover:bg-emerald-400 text-emerald-950 px-6 py-2.5 rounded-xl text-xs font-black uppercase transition-all shadow-lg shadow-emerald-500/20">
                    Apply Filter
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 bg-gradient-to-br from-[#111827] to-[#0b0f1a] border border-white/10 rounded-[2.5rem] p-12 relative overflow-hidden shadow-2xl group">
                <div class="absolute top-0 right-0 p-12 opacity-[0.03] group-hover:scale-110 transition-transform duration-1000">
                    <i data-lucide="banknote" class="w-64 h-64 text-white"></i>
                </div>

                <div class="relative z-10 space-y-12">
                    <div>
                        <p class="text-emerald-500 font-black text-[10px] uppercase tracking-[0.4em] mb-4">Total Net Revenue</p>
                        <div class="flex items-baseline gap-4">
                            <span class="text-3xl font-bold text-gray-600 italic">IDR</span>
                            <h2 class="text-7xl md:text-8xl font-black text-white tracking-tighter italic leading-none">
                                {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-8 pt-10 border-t border-white/5">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Transactions</p>
                            <p class="text-2xl font-black text-white italic">{{ number_format($totalTransaksi) }} <span class="text-xs text-gray-600">Items</span></p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Avg Ticket</p>
                            <p class="text-2xl font-black text-white italic">Rp {{ number_format($totalTransaksi > 0 ? $totalPendapatan/$totalTransaksi : 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="space-y-1 hidden md:block">
                            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest">System Status</p>
                            <div class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981]"></span>
                                <p class="text-xs font-bold text-white uppercase italic">Optimal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#0b0f1a] border border-white/10 rounded-[2.5rem] p-10 flex flex-col justify-between shadow-2xl">
                <div>
                    <h3 class="text-sm font-black text-white uppercase tracking-widest mb-8 flex justify-between items-center">
                        Top Performance Area
                        <i data-lucide="bar-chart-2" class="text-emerald-500 w-4 h-4"></i>
                    </h3>

                    <div class="space-y-6">
                        @foreach($statistikArea->sortByDesc('pendapatan_area')->take(4) as $area)
                        <div class="group">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">{{ $area->nama_area }}</span>
                                <span class="text-xs font-bold text-white italic">Rp {{ number_format($area->pendapatan_area, 0, ',', '.') }}</span>
                            </div>
                            <div class="h-1 w-full bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 transition-all duration-1000 group-hover:bg-emerald-400"
                                    style="width: {{ $totalPendapatan > 0 ? ($area->pendapatan_area / $totalPendapatan) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12">
                    <button onclick="window.print()"
                        class="w-full flex items-center justify-center gap-3 bg-white text-black py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-500 hover:text-white transition-all group border border-gray-100 shadow-sm">
                        <i data-lucide="download" class="w-4 h-4 group-hover:-translate-y-1 transition-transform"></i>
                        Export PDF Report
                    </button>
                    <p class="text-[9px] text-gray-600 mt-4 text-center italic">Laporan akan dibuat otomatis sesuai tampilan layar saat ini.</p>
                </div>

            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @php
                $stats = [
                ['label' => 'Total In', 'value' => $transaksiMasuk, 'icon' => 'arrow-down-left', 'color' => 'text-blue-500'],
                ['label' => 'Total Out', 'value' => $transaksiKeluar, 'icon' => 'arrow-up-right', 'color' => 'text-emerald-500'],
                ['label' => 'Active Areas', 'value' => $totalAreaParkir, 'icon' => 'map-pin', 'color' => 'text-purple-500'],
                ['label' => 'Active Staff', 'value' => $statistikPerPetugas->count(), 'icon' => 'users', 'color' => 'text-orange-500'],
                ];
                @endphp

                @foreach($stats as $s)
                <div class="bg-white/[0.02] border border-white/5 rounded-3xl p-6 flex items-center gap-5 hover:bg-white/[0.04] transition-colors">
                    <div class="h-10 w-10 rounded-xl bg-white/5 flex items-center justify-center {{ $s['color'] }}">
                        <i data-lucide="{{ $s['icon'] }}" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-500 uppercase tracking-widest">{{ $s['label'] }}</p>
                        <p class="text-xl font-black text-white italic tracking-tighter">{{ $s['value'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
</x-layouts.app>