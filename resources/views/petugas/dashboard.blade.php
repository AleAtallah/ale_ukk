<x-layouts.app>
    <div class="p-6 space-y-8 animate-in fade-in duration-700">
        <div class="flex justify-between items-center bg-[#0b0f1a] p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
            <div class="flex items-center gap-6">
                <div class="h-16 w-16 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-[0_0_20px_rgba(16,185,129,0.3)]">
                    <i data-lucide="scan-face" class="text-emerald-950 w-8 h-8"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter leading-none">Terminal <span class="text-emerald-500">Active</span></h1>
                    <p class="text-gray-500 text-[10px] font-mono mt-2 uppercase tracking-widest">Operator: {{ Auth::user()->name }} // Shift: {{ now()->format('A') }}</p>
                </div>
            </div>
            <a href="{{ route('petugas.transaksi.create') }}" class="px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 rounded-2xl font-black italic uppercase transition-all hover:scale-105 flex items-center gap-3">
                <i data-lucide="plus-circle"></i> Input Kendaraan
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white/[0.02] border border-white/10 rounded-[3rem] p-10 relative overflow-hidden group">
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.4em] mb-4 italic">Ketersediaan Slot Real-Time</p>
                    <div class="flex items-baseline gap-4">
                        <h2 class="text-9xl font-black text-white italic tracking-tighter leading-none">{{ $kapasitasTersedia }}</h2>
                        <span class="text-2xl font-bold text-gray-600 uppercase italic">Kosong</span>
                    </div>
                    
                    <div class="mt-12 grid grid-cols-2 gap-4">
                        @foreach($statistikArea as $area)
                        <div class="p-4 bg-white/5 rounded-2xl border border-white/5">
                            <div class="flex justify-between text-[10px] font-black uppercase text-gray-500 mb-2">
                                <span>{{ $area->nama_area }}</span>
                                <span>{{ $area->kapasitas - $area->terisi }} Sisa</span>
                            </div>
                            <div class="h-1.5 w-full bg-white/5 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500" style="width: {{ ($area->terisi/$area->kapasitas)*100 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-blue-600 rounded-[2.5rem] p-8 text-white relative overflow-hidden group">
                    <i data-lucide="trending-up" class="absolute -right-4 -bottom-4 w-24 h-24 opacity-20"></i>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-70">Produktivitas Anda</p>
                    <h3 class="text-4xl font-black italic mt-2">{{ $transaksiMasuk + $transaksiKeluar }}</h3>
                    <p class="text-xs font-bold opacity-70 mt-1 uppercase">Kendaraan Ditangani Hari Ini</p>
                </div>

                <div class="bg-[#0b0f1a] border border-white/5 rounded-[2.5rem] p-8">
                    <h4 class="text-xs font-black text-white uppercase tracking-widest mb-6 italic">Cek Cepat Status</h4>
                    <div class="space-y-4">
                        <a href="{{ route('petugas.transaksi.index') }}" class="w-full py-4 bg-white/5 hover:bg-white/10 rounded-2xl flex items-center justify-center gap-3 text-white text-[10px] font-black uppercase transition-all">
                            <i data-lucide="list"></i> Riwayat Transaksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>