<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Santri;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with('santri.kelas');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('santri', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pembayarans = $query->latest()->paginate(15)->withQueryString();

        return view('pembayaran.index', compact('pembayarans'));
    }

    // Generate Tagihan Bulanan Massal
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2050',
            'jumlah_tagihan' => 'required|numeric|min:0',
        ]);

        $activeSantris = Santri::where('status', 'aktif')->get();
        $generatedCount = 0;

        foreach ($activeSantris as $santri) {
            // Cek apakah sudah ada tagihan untuk bulan & tahun ini
            $exists = Pembayaran::where('santri_id', $santri->id)
                ->where('bulan', $request->bulan)
                ->where('tahun', $request->tahun)
                ->exists();

            if (!$exists) {
                Pembayaran::create([
                    'santri_id' => $santri->id,
                    'bulan' => $request->bulan,
                    'tahun' => $request->tahun,
                    'jumlah_tagihan' => $request->jumlah_tagihan,
                    'jumlah_bayar' => 0,
                    'status' => 'belum_lunas',
                ]);
                $generatedCount++;
            }
        }

        return redirect()->route('pembayaran.index')
            ->with('success', "Berhasil generate {$generatedCount} tagihan baru.");
    }

    // Input Pembayaran
    public function bayar(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'jumlah_bayar' => 'required|numeric|min:1|max:' . ($pembayaran->jumlah_tagihan - $pembayaran->jumlah_bayar),
            'keterangan' => 'nullable|string',
        ]);

        $newJumlahBayar = $pembayaran->jumlah_bayar + $request->jumlah_bayar;
        $status = ($newJumlahBayar >= $pembayaran->jumlah_tagihan) ? 'lunas' : 'belum_lunas';

        $pembayaran->update([
            'jumlah_bayar' => $newJumlahBayar,
            'tanggal_bayar' => now(),
            'status' => $status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}
