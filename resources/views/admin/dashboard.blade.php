<x-layouts.app>
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255,255,255,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-emerald-500/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-600/10 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s"></div>
        
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/[0.01] to-transparent h-[2px] w-full animate-scan"></div>
    </div>

    <div class="p-6 space-y-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 relative">
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-emerald-500/5 blur-3xl rounded-full"></div>
            
            <div class="relative">
                <div class="flex items-center gap-3 mb-2">
                    <div class="flex items-center gap-1.5">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black uppercase tracking-widest rounded-full border border-emerald-500/20 backdrop-blur-md">
                            System Online
                        </span>
                    </div>
                    <span class="text-gray-600 font-mono text-[10px] tracking-tighter">{{ now()->format('d M Y H:i') }}</span>
                </div>
                <h1 class="text-6xl font-black text-white italic tracking-tighter uppercase leading-[0.85]">
                    System<br><span class="text-emerald-500 drop-shadow-[0_0_15px_rgba(16,185,129,0.3)]">Architect</span>
                </h1>
            </div>

            <div class="flex gap-4 relative">
                @if($areaKritis > 0)
                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-4 animate-bounce-slow backdrop-blur-md">
                    <div class="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                        <i data-lucide="alert-triangle" class="text-red-500 w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-red-500 uppercase tracking-widest">Warning</p>
                        <p class="text-xs font-bold text-white">{{ $areaKritis }} Area Hampir Penuh</p>
                    </div>
                </div>
                @endif
                
                <div class="p-6 bg-[#0b0f1a]/80 backdrop-blur-xl border border-white/5 rounded-3xl text-center min-w-[140px] shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <p class="text-[10px] font-black text-gray-500 uppercase mb-2 tracking-[0.2em] relative z-10">Total Staff</p>
                    <p class="text-4xl font-black text-white italic relative z-10">{{ $statistikPerPetugas->count() }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($statistikArea as $area)
                @php $persen = ($area->terisi/($area->kapasitas ?: 1))*100; @endphp
                <div class="relative bg-white/[0.03] backdrop-blur-md border {{ $persen >= 90 ? 'border-red-500/40 shadow-[0_0_30px_rgba(239,68,68,0.05)]' : 'border-white/10 shadow-xl' }} rounded-[2.8rem] p-8 hover:bg-white/[0.06] transition-all group overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 {{ $persen >= 90 ? 'bg-red-500/5' : 'bg-emerald-500/5' }} blur-3xl rounded-full transition-all group-hover:scale-150"></div>

                    <div class="flex justify-between items-start mb-8 relative z-10">
                        <div class="h-12 w-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-emerald-950 group-hover:rotate-12 transition-all duration-500">
                            <i data-lucide="map" class="w-5 h-5"></i>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-black {{ $persen >= 90 ? 'text-red-400 bg-red-400/10' : 'text-emerald-500 bg-emerald-500/10' }} px-4 py-1.5 rounded-full uppercase italic tracking-wider border border-white/5">
                                {{ $area->total_transaksi }} Transaksi
                            </span>
                        </div>
                    </div>
                    
                    <h4 class="text-2xl font-black text-white italic uppercase tracking-tighter relative z-10">{{ $area->nama_area }}</h4>
                    
                    <div class="mt-8 space-y-4 relative z-10">
                        <div class="flex justify-between items-end">
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest opacity-60">Live Occupancy</p>
                                <p class="text-3xl font-black text-white italic">
                                    {{ $area->terisi }}<span class="text-gray-600 text-sm italic">/{{ $area->kapasitas }}</span>
                                </p>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="text-lg font-black italic {{ $persen >= 90 ? 'text-red-500' : 'text-emerald-500' }}">
                                    {{ round($persen) }}%
                                </span>
                            </div>
                        </div>
                        
                        <div class="w-full bg-white/5 h-2.5 rounded-full p-[2px] border border-white/5">
                            <div class="h-full rounded-full {{ $persen >= 90 ? 'bg-gradient-to-r from-red-600 to-orange-500 shadow-[0_0_15px_#ef4444]' : 'bg-gradient-to-r from-emerald-600 to-teal-400 shadow-[0_0_15px_#10b981]' }} transition-all duration-1000 ease-out" 
                                 style="width: {{ $persen }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="space-y-6">
                <div class="bg-[#0b0f1a]/60 backdrop-blur-2xl border border-white/10 rounded-[2.8rem] p-8 shadow-2xl">
                    <h3 class="text-[10px] font-black text-white uppercase tracking-[0.3em] mb-8 flex items-center gap-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Live Activity Log
                    </h3>
                    <div class="space-y-8">
                        @foreach($logTerbaru as $log)
                        <div class="flex items-start gap-4 border-l-2 border-white/5 pl-6 relative group/item">
                            <div class="absolute -left-[5px] top-0 w-2 h-2 rounded-full bg-gray-700 group-hover/item:bg-emerald-500 transition-colors shadow-[0_0_10px_transparent] group-hover/item:shadow-emerald-500/50"></div>
                            <div class="flex-1">
                                <p class="text-[11px] font-black text-white uppercase tracking-tight group-hover/item:text-emerald-400 transition-colors">{{ $log->area->nama_area }}</p>
                                <p class="text-[10px] text-gray-500 leading-relaxed font-medium mt-1"><span class="text-gray-300">{{ $log->user->name }}</span> mencatat kendaraan baru</p>
                            </div>
                            <span class="text-[9px] font-mono text-gray-600 mt-0.5">{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.users.index') }}" class="relative overflow-hidden p-6 bg-white/[0.03] border border-white/10 rounded-[2rem] group transition-all hover:-translate-y-1 hover:bg-emerald-500">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-150 transition-transform">
                             <i data-lucide="users" class="w-12 h-12 text-white"></i>
                        </div>
                        <i data-lucide="users" class="text-emerald-500 group-hover:text-emerald-950 mb-3 relative z-10 transition-colors"></i>
                        <p class="text-[10px] font-black text-gray-500 group-hover:text-emerald-950 uppercase tracking-widest relative z-10 transition-colors">Manage Users</p>
                    </a>
                    
                    <a href="{{ route('admin.area-parkir.index') }}" class="relative overflow-hidden p-6 bg-white/[0.03] border border-white/10 rounded-[2rem] group transition-all hover:-translate-y-1 hover:bg-blue-600">
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-150 transition-transform">
                             <i data-lucide="settings" class="w-12 h-12 text-white"></i>
                        </div>
                        <i data-lucide="settings" class="text-blue-500 group-hover:text-blue-950 mb-3 relative z-10 transition-colors"></i>
                        <p class="text-[10px] font-black text-gray-500 group-hover:text-blue-950 uppercase tracking-widest relative z-10 transition-colors">System Setup</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes scan {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(1000%); }
        }
        .animate-scan {
            animation: scan 8s linear infinite;
        }
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }
        body {
            background-color: #020617; /* Darker navy for better glow contrast */
        }
    </style>
</x-layouts.app>