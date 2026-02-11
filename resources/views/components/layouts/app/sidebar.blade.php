<?php
use Illuminate\Support\Facades\Auth;
use App\Models\AreaParkir;

$user = Auth::user();
$role = $user ? $user->role : null;
$areaParkir = AreaParkir::all();
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <style>
        /* Custom Scrollbar untuk Sidebar */
        .flux-sidebar-content::-webkit-scrollbar {
            width: 4px;
        }

        .flux-sidebar-content::-webkit-scrollbar-thumb {
            background: rgba(79, 70, 229, 0.2);
            border-radius: 10px;
        }

        .sidebar-item-custom:hover {
            background: rgba(79, 70, 229, 0.08) !important;
            box-shadow: inset 0 0 15px rgba(79, 70, 229, 0.05);
        }
    </style>
</head>

<body class="min-h-screen bg-[#020617] text-white antialiased">
    <div class="flex min-h-screen w-full">

        <flux:sidebar sticky collapsible="mobile" class="border-e border-white/5 bg-[#0b1222]/95 backdrop-blur-xl">
            {{-- Header / Logo --}}
            <flux:sidebar.header class="py-6 px-4">
                <div class="flex items-center gap-2 group cursor-pointer">
                    <div class="p-2 bg-indigo-600 rounded-xl shadow-[0_0_20px_rgba(79,70,229,0.4)] transition-transform group-hover:scale-110">
                        <x-app-logo class="w-6 h-6" :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-black uppercase italic text-white leading-none tracking-tight">
                            Smart<span class="text-indigo-500">Park</span>
                        </span>
                        <span class="text-[8px] text-neutral-500 font-bold tracking-[0.3em] uppercase">Enterprise V2</span>
                    </div>
                </div>
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav class="px-3 space-y-4">
                @if(!$role)
                    <div class="text-[10px] text-red-500 px-4 italic bg-red-500/10 py-2 rounded-lg border border-red-500/20">
                        ⚠️ Role Not Detected
                    </div>
                @endif

                {{-- ADMIN SECTION --}}
                @if ($role === 'admin')
                    <flux:sidebar.group :heading="__('Core Systems')" class="space-y-1">
                        <flux:sidebar.item icon="squares-2x2" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="sidebar-item-custom rounded-xl font-bold text-xs uppercase tracking-widest">
                            {{ __('Dashboard') }}
                        </flux:sidebar.item>
                        <flux:sidebar.item icon="user-group" :href="route('admin.users.index')" :current="request()->routeIs('admin.users.*')" wire:navigate class="sidebar-item-custom rounded-xl font-bold text-xs uppercase tracking-widest">
                            Personnel
                        </flux:sidebar.item>
                    </flux:sidebar.group>

                    <flux:sidebar.group expandable expanded="{{ request()->is('admin/area-parkir*', 'admin/tarif-parkir*') ? 'true' : 'false' }}" heading="Parking Assets" icon="circle-stack" class="space-y-1">
                        <flux:sidebar.item icon="map-pin" :href="route('admin.area-parkir.index')" :current="request()->routeIs('admin.area-parkir.*')" wire:navigate class="text-xs font-bold uppercase tracking-wider opacity-80">
                            {{ __('Zone Layout') }}
                        </flux:sidebar.item>
                        <flux:sidebar.item icon="currency-dollar" :href="route('admin.tarif-parkir.index')" :current="request()->routeIs('admin.tarif-parkir.*')" wire:navigate class="text-xs font-bold uppercase tracking-wider opacity-80">
                            {{ __('Pricing Matrix') }}
                        </flux:sidebar.item>
                    </flux:sidebar.group>

                    <flux:sidebar.group :heading="__('Intelligence')" class="space-y-1">
                        <flux:sidebar.item icon="identification" :href="route('admin.kendaraan.index')" :current="request()->routeIs('admin.kendaraan.*')" wire:navigate class="sidebar-item-custom rounded-xl font-bold text-xs uppercase tracking-widest">
                            {{ __('Registry') }}
                        </flux:sidebar.item>
                        <flux:sidebar.item icon="shield-check" :href="route('admin.log-aktivitas.index')" :current="request()->routeIs('admin.log-aktivitas.*')" wire:navigate class="sidebar-item-custom rounded-xl font-bold text-xs uppercase tracking-widest">
                            {{ __('Audit Logs') }}
                        </flux:sidebar.item>
                    </flux:sidebar.group>
                @endif

                {{-- PETUGAS SECTION --}}
                @if ($role === 'petugas')
                    <flux:sidebar.group heading="Terminal Access" class="space-y-1">
                        <flux:sidebar.item icon="command-line" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="sidebar-item-custom rounded-xl font-bold text-xs uppercase tracking-widest">
                            {{ __('Control Center') }}
                        </flux:sidebar.item>
                    </flux:sidebar.group>

                    <flux:sidebar.group expandable expanded heading="Active Zones" icon="chart-bar-square" class="space-y-1">
                        @forelse ($areaParkir as $area)
                            <flux:sidebar.item icon="cube" :href="route('petugas.transaksi.index', ['area' => $area->id])" :current="request()->query('area') == $area->id" wire:navigate class="text-[11px] font-black uppercase tracking-widest py-3 transition-all hover:translate-x-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse inline-block shadow-[0_0_8px_#10b981]"></span>
                                {{ $area->nama_area }}
                            </flux:sidebar.item>
                        @empty
                            <div class="px-4 py-2 text-[10px] text-neutral-500 italic uppercase tracking-tighter">No Zones Active</div>
                        @endforelse
                    </flux:sidebar.group>
                @endif

                {{-- OWNER SECTION --}}
                @if ($role === 'owner')
                    <flux:sidebar.group heading="Executive View" class="space-y-1">
                        <flux:sidebar.item icon="presentation-chart-line" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate class="sidebar-item-custom rounded-xl font-bold text-xs uppercase tracking-widest">
                            {{ __('Analytics') }}
                        </flux:sidebar.item>
                    </flux:sidebar.group>
                @endif
            </flux:sidebar.nav>

            <flux:spacer />

            {{-- Footer Stats --}}
            <flux:sidebar.nav class="px-3 pb-4">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-indigo-600/10 border border-white/5 mb-4 backdrop-blur-sm">
                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-2">System Health</p>
                    <div class="flex items-center gap-2">
                        <div class="flex-1 h-1.5 bg-white/5 rounded-full overflow-hidden">
                            <div class="w-3/4 h-full bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
                        </div>
                        <span class="text-[9px] font-mono text-neutral-500 uppercase">Stable</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 px-4 opacity-50 hover:opacity-100 transition-opacity">
                    <flux:icon name="code-bracket" variant="micro" />
                    <span class="text-[9px] uppercase font-bold tracking-widest">Build v2.1.0-Alpha</span>
                </div>
            </flux:sidebar.nav>

            {{-- User Menu --}}
            <div class="p-4 border-t border-white/5 bg-[#080e1a]/50">
                <x-desktop-user-menu :name="auth()->user()->name" />
            </div>
        </flux:sidebar>

        {{-- Main Content --}}
        <div class="flex-1 min-w-0 flex flex-col">
            <main class="p-6 lg:p-10">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @fluxScripts
</body>
</html>