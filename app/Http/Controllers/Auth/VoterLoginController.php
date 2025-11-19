<?php

namespace App\Http\Controllers\Auth;

use App\Models\Voter;
use App\Models\Election;
use App\Models\VoteResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VoterLoginController extends Controller
{
    public function index()
    {
        return view('users.auth.login');
    }

    public function login_action(Request $request)
    {
        $validated = $request->validate(
            [
                'user_id' => 'required|integer',
                'access_code' => 'required|string',
            ],
            [
                'user_id.required' => '❌ NIS / NO ID / NIP Awal wajib diisi!',
                'user_id.integer' => '❌ NIS / NO ID / NIP Awal harus berupa angka!',
                'access_code.required' => '❌ Kode akses wajib diisi!',
                'access_code.string' => '❌ Kode akses harus berupa teks!',
            ],
        );

        $voter = Voter::where([
            'user_id' => $validated['user_id'],
            'access_code' => $validated['access_code'],
        ])->first();

        if (!$voter) {
            return back()
                ->withInput()
                ->with(['error' => '❌ ID atau kode akses tidak valid!']);
        }

        $election = Election::first();
        if (!$election || !$election->is_active) {
            return back()->with(['error' => '❌ Sesi pemilihan belum dimulai, silahkan tunggu terlebih dahulu!']);
        }

        if (VoteResult::where('id_voter', $voter->user_id)->exists()) {
            return back()->with(['error' => '❌ Maaf, Anda sudah memberikan suara!']);
        }

        // ===== TAMBAHKAN INI: Force logout admin jika ada =====
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        // ======================================================

        Auth::guard('voters')->login($voter);
        return redirect()->route('voter.dashboard')->with('success', '✅ Selamat datang, silahkan untuk memilih kandidat!');
    }

    public function logout(Request $request)
    {
        Auth::guard('voters')->logout();

        $request->session()->regenerateToken();

        return redirect()->route('voter.login')->with('success', '✅ Anda telah berhasil logout.');
    }
}
