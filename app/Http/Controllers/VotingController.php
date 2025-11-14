<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Voter;
use App\Models\Election;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\VoteResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function index()
    {
        $x['voters'] = Voter::first();
        $x['candidates'] = Candidate::get();
        return view('users.dashboard', $x);
    }

    public function logActivity($activity)
    {
        $user = Auth::user();
        $username = $user->username;
        $role = null;

        if ($user->role === 'admin') {
            $role = 'Admin';
        } elseif ($user->role === 'panitia') {
            $role = 'Admin';
        }

        $log = new Log([
            'username' => $username,
            'activity' => $activity,
            'role' => $role,
        ]);

        $log->save();
    }

    public function startElectionSession()
    {
        // Cek apakah ada election, jika tidak ada maka buat baru
        $election = Election::first();

        if (!$election) {
            $election = Election::create([
                'is_active' => 1, // Sesi pemilihan langsung aktif saat dibuat
            ]);
        } else {
            $election->is_active = 1;
            $election->save();
        }

        $activity = 'Memulai sesi pemilihan';
        $this->logActivity($activity);

        return back()->with('success', '🗳️✅ Sesi pemilihan telah dimulai.');
    }

    public function stopElectionSession()
    {
        // Cek apakah ada election
        $election = Election::first();

        if (!$election) {
            return back()->with('error', '❌ Tidak ada sesi pemilihan yang aktif.');
        }

        $election->is_active = 0;
        $election->save();

        $activity = 'Mematikan sesi pemilihan';
        $this->logActivity($activity);

        return back()->with('success', '🗳️⛔ Sesi pemilihan telah ditutup.');
    }

    public function previewCandidate($id)
    {
        $x['subtitle'] = 'Detail Kandidat';
        $candidate = Candidate::findOrFail($id);
        $positions = Position::all();
        return view('users.preview', compact('candidate', 'positions'), $x);
    }

    public function vote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Cek apakah sesi pemilihan aktif
        $election = Election::first();
        if (!$election || !$election->is_active) {
            return back()->with(['error' => '❌ Sesi pemilihan belum dimulai, silahkan tunggu terlebih dahulu!']);
        }

        $user = Auth::guard('voters')->user();

        if (!$user) {
            return redirect()->route('voter.login')->with('error', '❌ Sesi telah berakhir, silahkan login kembali!');
        }

        $voter = Voter::where([
            'user_id' => $user->user_id,
            'access_code' => $user->access_code,
        ])->first();

        if (!$voter) {
            Auth::guard('voters')->logout();
            $request->session()->forget('access_code');
            return redirect()->route('voter.login')->with('error', '❌ Anda tidak terdaftar sebagai pemilih!');
        }

        // Double check jika sudah vote
        if (VoteResult::where('id_voter', $voter->user_id)->exists() || $voter->validation === 'sudah') {
            Auth::guard('voters')->logout();
            $request->session()->forget('access_code');
            return redirect()->route('voter.login')->with('error', '❌ Anda sudah memberikan suara sebelumnya!');
        }

        // Gunakan database transaction untuk konsistensi data
        DB::transaction(function () use ($voter, $request) {
            $voter->validation = 'sudah';
            $voter->save();

            VoteResult::create([
                'id_voter' => $voter->user_id,
                'id_candidate' => $request->input('candidate_id'),
            ]);
        });

        // Logout dari semua device
        Auth::guard('voters')->logout();
        $request->session()->forget('access_code');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vote.success')->with('success', '✅ Terima kasih sudah memberikan suara!');
    }
}
