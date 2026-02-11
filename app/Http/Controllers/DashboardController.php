<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Logic pusat untuk mengambil data dashboard.
     */
    private function getDashboardData(Request $request)
    {
        $user = Auth::user();
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        $totalKendaraan = Kendaraan::count();
        $totalAreaParkir = AreaParkir::count();
        $totalKapasitas = AreaParkir::sum('kapasitas');
        $totalTerisi = AreaParkir::sum('terisi');
        $kapasitasTersedia = max(0, $totalKapasitas - $totalTerisi);

        $totalTransaksi = Transaksi::whereBetween('waktu_masuk', [$start, $end])->count();
        $transaksiMasuk = Transaksi::whereBetween('waktu_masuk', [$start, $end])->where('status', 'masuk')->count();
        $transaksiKeluar = Transaksi::whereBetween('waktu_masuk', [$start, $end])->where('status', 'keluar')->count();
        $totalPendapatan = Transaksi::whereBetween('waktu_masuk', [$start, $end])->where('status', 'keluar')->sum('biaya_total');

        $transaksiTerbaru = Transaksi::with(['kendaraan', 'area'])
            ->whereBetween('waktu_masuk', [$start, $end])
            ->orderBy('waktu_masuk', 'desc')
            ->limit(10)->get();

        $statistikArea = AreaParkir::get()->map(function ($area) use ($start, $end) {
            $transaksis = Transaksi::where('id_area', $area->id)->whereBetween('waktu_masuk', [$start, $end]);
            $area->total_transaksi = $transaksis->count();
            $area->pendapatan_area = $transaksis->where('status', 'keluar')->sum('biaya_total');
            return $area;
        });

        $statistikPerPetugas = null;
        if (in_array(strtolower($user->role), ['admin', 'owner'])) {
            $statistikPerPetugas = User::where('role', 'petugas')->get()->map(function ($petugas) use ($start, $end) {
                $petugas->total_transaksi = Transaksi::where('id_user', $petugas->id)
                    ->whereBetween('waktu_masuk', [$start, $end])->count();
                return $petugas;
            });
        }

        return compact(
            'user', 'startDate', 'endDate', 'totalKendaraan', 'totalAreaParkir', 
            'totalKapasitas', 'totalTerisi', 'kapasitasTersedia', 'totalTransaksi', 
            'transaksiMasuk', 'transaksiKeluar', 'totalPendapatan', 'transaksiTerbaru', 
            'statistikArea', 'statistikPerPetugas'
        );
    }

    /**
     * Traffic Controller: Mengalihkan user ke pintu yang benar sesuai role.
     */
  public function index(Request $request)
{
    // Pastikan ini mengambil role dari user yang sedang login
    $role = strtolower(trim(Auth::user()->role));

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'petugas') {
        return redirect()->route('petugas.dashboard');
    } elseif ($role === 'owner') {
        return redirect()->route('owner.dashboard');
    }

    abort(403, "Role '$role' tidak terdaftar dalam sistem redirect.");
}

   public function adminDashboard(Request $request) {
    $data = $this->getDashboardData($request);

    // FITUR BARU: Deteksi Area Kritis (Terisi > 80%)
    $data['areaKritis'] = $data['statistikArea']->filter(function($area) {
        return ($area->terisi / ($area->kapasitas ?: 1)) >= 0.8;
    })->count();

    // FITUR BARU: Ambil log aktivitas terbaru khusus untuk Admin
    // (Misal: User baru atau transaksi besar)
    $data['logTerbaru'] = \App\Models\Transaksi::with(['user', 'area'])
        ->latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', $data);
}

    public function petugasDashboard(Request $request) {
        $data = $this->getDashboardData($request);
        return view('petugas.dashboard', $data);
    }

    public function ownerDashboard(Request $request) {
        $data = $this->getDashboardData($request);
        return view('owner.dashboard', $data);
    }

    public function cetakRekapTransaksi(Request $request) {
        // Logic PDF tetap sama
    }
}