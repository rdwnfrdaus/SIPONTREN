<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Kamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $query = Santri::with(['kelas', 'kamar', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $santris = $query->latest()->paginate(10)->withQueryString();

        return view('santri.index', compact('santris'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $kamars = Kamar::all();
        return view('santri.create', compact('kelas', 'kamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:santris,nis',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nama_ortu_wali' => 'required|string|max:255',
            'no_hp_wali' => 'required|string|max:20',
            'kelas_id' => 'nullable|exists:kelas,id',
            'kamar_id' => 'nullable|exists:kamars,id',
            'status' => 'required|in:aktif,lulus,pindah',
            'tanggal_masuk' => 'required|date',
            
            // Login Account (Optional)
            'create_account' => 'boolean',
            'email' => 'required_if:create_account,1|nullable|email|unique:users,email',
            'password' => 'required_if:create_account,1|nullable|min:8|confirmed',
        ]);

        $userId = null;
        if ($request->create_account) {
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'santri',
            ]);
            $userId = $user->id;
        }

        Santri::create([
            'user_id' => $userId,
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nama_ortu_wali' => $request->nama_ortu_wali,
            'no_hp_wali' => $request->no_hp_wali,
            'kelas_id' => $request->kelas_id,
            'kamar_id' => $request->kamar_id,
            'status' => $request->status,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect()->route('santri.index')->with('success', 'Santri berhasil didaftarkan.');
    }

    public function show(Santri $santri)
    {
        $santri->load(['kelas', 'kamar', 'pembayarans' => function($q) {
            $q->orderBy('tahun', 'desc')->orderBy('bulan', 'desc');
        }]);
        return view('santri.show', compact('santri'));
    }

    public function edit(Santri $santri)
    {
        $kelas = Kelas::all();
        $kamars = Kamar::all();
        return view('santri.edit', compact('santri', 'kelas', 'kamars'));
    }

    public function update(Request $request, Santri $santri)
    {
        $request->validate([
            'nis' => ['required', Rule::unique('santris')->ignore($santri->id)],
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nama_ortu_wali' => 'required|string|max:255',
            'no_hp_wali' => 'required|string|max:20',
            'kelas_id' => 'nullable|exists:kelas,id',
            'kamar_id' => 'nullable|exists:kamars,id',
            'status' => 'required|in:aktif,lulus,pindah',
            'tanggal_masuk' => 'required|date',
            
            // Edit linked user details
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($santri->user_id)],
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($santri->user_id) {
            $user = $santri->user;
            $userUpdate = [
                'name' => $request->nama_lengkap,
            ];
            if ($request->email) {
                $userUpdate['email'] = $request->email;
            }
            if ($request->password) {
                $userUpdate['password'] = Hash::make($request->password);
            }
            $user->update($userUpdate);
        } elseif ($request->email && $request->password) {
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'santri',
            ]);
            $santri->user_id = $user->id;
        }

        $santri->update([
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'nama_ortu_wali' => $request->nama_ortu_wali,
            'no_hp_wali' => $request->no_hp_wali,
            'kelas_id' => $request->kelas_id,
            'kamar_id' => $request->kamar_id,
            'status' => $request->status,
            'tanggal_masuk' => $request->tanggal_masuk,
            'user_id' => $santri->user_id,
        ]);

        return redirect()->route('santri.index')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(Santri $santri)
    {
        if ($santri->user_id) {
            User::destroy($santri->user_id);
        }
        $santri->delete();
        return redirect()->route('santri.index')->with('success', 'Data santri berhasil dihapus.');
    }
}
