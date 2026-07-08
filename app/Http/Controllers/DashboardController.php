<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $activeSantriCount = Santri::where('status', 'aktif')->count();
        $totalSantri = Santri::count();
        
        $totalPemasukanBulanIni = Pembayaran::where('status', 'lunas')
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jumlah_bayar');

        // Pendaftaran santri per bulan tahun ini untuk grafik
        $registrations = Santri::select(
                DB::raw('count(id) as count'),
                DB::raw('MONTH(tanggal_masuk) as month')
            )
            ->whereYear('tanggal_masuk', now()->year)
            ->groupBy(DB::raw('MONTH(tanggal_masuk)'))
            ->orderBy('month')
            ->get();

        // Siapkan data grafik 12 bulan (Januari = 1, Desember = 12)
        $chartData = array_fill(1, 12, 0);
        foreach ($registrations as $reg) {
            $chartData[$reg->month] = $reg->count;
        }

        // Hitung total tunggakan / belum lunas
        $totalTunggakan = Pembayaran::where('status', 'belum_lunas')
            ->sum(DB::raw('jumlah_tagihan - jumlah_bayar'));

        // Data aktivitas terbaru untuk dashboard menarik
        $recentRegistrations = Santri::with('kelas')
            ->orderBy('tanggal_masuk', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $recentPayments = Pembayaran::with('santri')
            ->where('status', 'lunas')
            ->orderBy('tanggal_bayar', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'activeSantriCount',
            'totalSantri',
            'totalPemasukanBulanIni',
            'chartData',
            'totalTunggakan',
            'recentRegistrations',
            'recentPayments'
        ));
    }
}

