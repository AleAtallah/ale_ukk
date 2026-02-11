<x-layouts.app :title="__('Kendaraan Masuk')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-4 gap-4">
        <div>
            <flux:heading size="xl" level="1">Kendaraan Masuk</flux:heading>
            <flux:subheading>Registrasi kendaraan baru ke dalam sistem parkir.</flux:subheading>
        </div>
        
        <a href="{{ route('petugas.transaksi.index', ['area' => request()->query('id_area')]) }}" 
           class="inline-flex items-center gap-2 px-4 py-2 text-xs font-black uppercase tracking-widest text-neutral-500 hover:text-white transition-colors group">
            <flux:icon name="arrow-left" variant="micro" class="w-4 h-4 transition-transform group-hover:-translate-x-1" />
            Kembali ke Log
        </a>
    </div>

    <div class="mt-4 bg-[#0b1222]/50 backdrop-blur-xl rounded-[2rem] border border-white/10 shadow-2xl p-8 max-w-2xl">
        <form action="{{ route('petugas.transaksi.store') }}" method="POST" class="space-y-8">
            @csrf

            {{-- Hidden Area ID (Diteruskan dari URL) --}}
            <input type="hidden" name="id_area" value="{{ request()->query('id_area') }}" />

            <div class="grid grid-cols-1 gap-8">
                {{-- Kendaraan --}}
                <div class="space-y-3">
                    <label for="id_kendaraan" class="block text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">
                        Identitas Kendaraan <span class="text-blue-500">*</span>
                    </label>
                    <select name="id_kendaraan" id="id_kendaraan" required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="" class="bg-[#0b1222]">Cari Plat Nomor...</option>
                        @foreach($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}" {{ old('id_kendaraan') == $kendaraan->id ? 'selected' : '' }} class="bg-[#0b1222]">
                                {{ $kendaraan->plat_nomor }} — {{ $kendaraan->pemilik }} ({{ ucfirst($kendaraan->jenis_kendaraan) }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_kendaraan')
                        <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tarif --}}
                <div class="space-y-3">
                    <label for="id_tarif" class="block text-[10px] font-black uppercase tracking-[0.2em] text-neutral-500">
                        Kategori Tarif <span class="text-blue-500">*</span>
                    </label>
                    <select name="id_tarif" id="id_tarif" required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="" class="bg-[#0b1222]">Pilih Jenis Kendaraan...</option>
                        @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id }}" {{ old('id_tarif') == $tarif->id ? 'selected' : '' }} class="bg-[#0b1222]">
                                {{ ucfirst($tarif->jenis_kendaraan) }} — Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }} / jam
                            </option>
                        @endforeach
                    </select>
                    @error('id_tarif')
                        <p class="text-[10px] font-bold text-red-500 uppercase tracking-wider">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Info Area (Read Only Visual) --}}
                <div class="p-4 bg-blue-500/5 border border-blue-500/20 rounded-2xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-500/20 rounded-lg">
                            <flux:icon name="map-pin" variant="micro" class="w-5 h-5 text-blue-400" />
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Area Penempatan</p>
                            <p class="text-sm font-bold text-white uppercase">ID AREA: {{ request()->query('id_area') ?? 'Bebas' }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-neutral-600 uppercase italic">Otomatis Terpilih</span>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-4">
                <button type="reset" class="text-[10px] font-black uppercase tracking-widest text-neutral-500 hover:text-white transition-colors">
                    Reset Form
                </button>
                <button type="submit"
                        class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] active:scale-95">
                    Konfirmasi Masuk
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>