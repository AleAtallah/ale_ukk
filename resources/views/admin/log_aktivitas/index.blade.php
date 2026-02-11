<x-layouts.app :title="__('Log Aktivitas')">
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        
        <div class="absolute top-[-10%] right-[-5%] w-[50%] h-[50%] bg-rose-600/10 blur-[130px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] left-[-5%] w-[40%] h-[40%] bg-blue-600/5 blur-[100px] rounded-full animate-pulse"></div>
        
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 50px 50px;"></div>
        
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-rose-500/[0.02] to-transparent h-[2px] w-full animate-scan"></div>
    </div>

    <div class="relative mb-8 p-8 bg-white/5 backdrop-blur-md rounded-[2.5rem] border border-white/10 overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <svg class="w-32 h-32 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
        
        <div class="relative flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-2 h-10 bg-rose-500 rounded-full shadow-[0_0_15px_#f43f5e]"></div>
                    <flux:heading size="xl" class="!text-4xl font-black italic tracking-tighter uppercase text-white leading-none">
                        Log <span class="text-rose-500 drop-shadow-[0_0_10px_rgba(244,63,94,0.3)]">Aktivitas</span>
                    </flux:heading>
                </div>
                <p class="text-[10px] font-black text-neutral-500 uppercase tracking-[0.3em] ml-5 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-ping"></span>
                    System Audit & Traceability Terminal
                </p>
            </div>

            <div class="flex items-center gap-4 bg-black/20 p-4 rounded-2xl border border-white/5 backdrop-blur-xl">
                <div class="text-right">
                    <p class="text-[9px] font-black text-neutral-500 uppercase tracking-widest">Status Sistem</p>
                    <p class="text-xs font-black text-emerald-500 uppercase italic">All Systems Nominal</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-emerald-500/30 flex items-center justify-center">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-4 p-4 bg-rose-500/10 backdrop-blur-md border border-rose-500/20 rounded-[1.5rem]">
                <div class="w-8 h-8 bg-rose-500 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <p class="text-xs font-black text-rose-500 uppercase italic tracking-widest">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-[#0b1222]/80 backdrop-blur-2xl rounded-[2.8rem] border border-white/10 shadow-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-700">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">No</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Operator</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Deskripsi Aktivitas</th>
                        <th class="px-8 py-7 text-left text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Timeline</th>
                        <th class="px-8 py-7 text-right text-[10px] font-black text-neutral-500 uppercase tracking-[0.4em]">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($data as $index => $log)
                        <tr class="group hover:bg-white/[0.03] transition-all duration-300">
                            <td class="px-8 py-6">
                                <span class="text-xs font-mono text-neutral-600 group-hover:text-rose-500 transition-colors">
                                    [{{ str_pad($data->firstItem() + $index, 4, '0', STR_PAD_LEFT) }}]
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-neutral-800 border border-white/10 flex items-center justify-center group-hover:border-rose-500/50 transition-colors">
                                        <span class="text-[10px] font-black text-neutral-400 group-hover:text-white">
                                            {{ strtoupper(substr($log->user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <span class="text-xs font-bold text-white uppercase tracking-wider">{{ $log->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full {{ str_contains(strtolower($log->aktivitas), 'hapus') ? 'bg-rose-500 shadow-[0_0_8px_#f43f5e]' : 'bg-blue-500 shadow-[0_0_8px_#3b82f6]' }}"></div>
                                    <span class="text-sm font-medium text-neutral-300 group-hover:text-white transition-colors">
                                        {{ $log->aktivitas }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-xs font-mono text-neutral-400 group-hover:text-rose-400 transition-colors">
                                        {{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('Y-m-d') }}
                                    </span>
                                    <span class="text-[10px] font-mono text-neutral-600">
                                        {{ \Carbon\Carbon::parse($log->waktu_aktivitas)->format('H:i:s') }} (SERVER_TIME)
                                    </span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.log-aktivitas.destroy', $log) }}" method="POST" 
                                      onsubmit="return confirm('Hapus record audit ini selamanya?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="p-2.5 bg-rose-500/5 hover:bg-rose-500 text-rose-500 hover:text-white rounded-xl transition-all border border-rose-500/10 opacity-20 group-hover:opacity-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center border border-white/10 mb-6 rotate-45 group">
                                        <svg class="w-8 h-8 text-neutral-700 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-black text-white italic uppercase tracking-tighter">No Incident Records</h3>
                                    <p class="text-[10px] text-neutral-500 font-bold uppercase tracking-[0.4em] mt-2 italic">Sistem dalam kondisi steril</p>
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
        .animate-scan { animation: scan 12s linear infinite; }
        body { background-color: #020617; }
    </style>
</x-layouts.app>