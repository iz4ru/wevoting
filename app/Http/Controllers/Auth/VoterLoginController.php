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
        $access_code = $request->input('access_code');
        $voter = Voter::where('access_code', $access_code)->first();
    
        if (!$voter) {
            return back()->with(['error' => '❌ Kode akses tidak valid!']);
        }
    
        // Cek apakah sesi pemilihan aktif
        $election = Election::first();
        if (!$election || !$election->is_active) {
            return back()->with(['error' => '❌ Sesi pemilihan belum dimulai, silahkan tunggu terlebih dahulu!']);
        }
    
        $hasVoted = VoteResult::where('id_voter', $voter->user_id)->exists();
    
        if ($hasVoted) {
            return back()->with(['error' => '❌ Maaf, Anda sudah memberikan suara!']);
        }
    
        Auth::guard('voters')->login($voter);
        return redirect()->route('voter.dashboard')->with('success', '✅ Selamat datang, silahkan untuk memilih kandidat!');
    }

    public function logout(Request $request)
    {
        Auth::guard('voters')->logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('voter.login')->with('success', '✅ Anda telah berhasil logout.');
    }
}
