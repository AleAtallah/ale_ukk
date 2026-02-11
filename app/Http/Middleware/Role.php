<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil role user, hapus spasi, dan kecilkan hurufnya
        $userRole = strtolower(trim(Auth::user()->role));
        
        // 3. Ambil daftar role yang diizinkan, kecilkan semua hurufnya
        $allowedRoles = array_map('strtolower', $roles);

        // 4. Bandingkan
        if (!in_array($userRole, $allowedRoles)) {
            // Kita kasih pesan error yang detail biar ketahuan salahnya dimana
            abort(403, "Akses Ditolak! Role Anda di database adalah: '" . Auth::user()->role . "'. Halaman ini butuh: " . implode(', ', $roles));
        }

        return $next($request);
    }
}