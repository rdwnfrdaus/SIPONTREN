<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard (Akses untuk semua role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Settings (Akses untuk semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Khusus Admin & Pengurus/Ustadz
    Route::middleware('role:admin,pengurus')->group(function () {
        // Santri Management
        Route::resource('santri', SantriController::class);
        
        // Kelas Management
        Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas'])->except(['create', 'show']);
        
        // Kamar Management
        Route::resource('kamar', KamarController::class)->except(['create', 'show']);
        
        // Financial/Pembayaran Management
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::post('/pembayaran/generate', [PembayaranController::class, 'generate'])->name('pembayaran.generate');
        Route::post('/pembayaran/{pembayaran}/bayar', [PembayaranController::class, 'bayar'])->name('pembayaran.bayar');
        Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
    });

    // Rute Khusus Santri / Wali Santri
    Route::middleware('role:santri')->group(function () {
        Route::get('/my-profile', function () {
            $santri = Auth::user()->santri;
            if (!$santri) {
                abort(404, 'Profil Santri tidak ditemukan. Silakan hubungi Admin/Pengurus.');
            }
            $santri->load(['kelas', 'kamar', 'pembayarans' => function($q) {
                $q->orderBy('tahun', 'desc')->orderBy('bulan', 'desc');
            }]);
            return view('santri.show', compact('santri'));
        })->name('my.profile');
    });
});

require __DIR__.'/auth.php';
