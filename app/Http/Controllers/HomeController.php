<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Voter;
use App\Models\Candidate;
use App\Models\VoteResult;
use App\Exports\DataExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        $votesByCandidate = VoteResult::select('id_candidate', DB::raw('count(*) as total_votes'))
            ->groupBy('id_candidate')
            ->get();

        $x['candidates'] = [];
        $x['voteCounts'] = [];

        foreach ($votesByCandidate as $votes)
        {
            $candidate = Candidate::find($votes->id_candidate);

            if ($candidate) {
                $x['candidates'][] = $candidate->name;
                $x['voteCounts'][] = $votes->total_votes;
            }
        }

        # Percentage Calculation

        $x['totalUsers'] = Voter::count();
        $x['votedUsers'] = Voter::where('validation', 'sudah')->count();

        if ($x['totalUsers'] > 0)
        {
            $x['votedPercentage'] = $x['totalUsers'] > 0 ? round(($x['votedUsers'] / $x['totalUsers']) * 100, 2) : 0;
            $x['notVotedPercentage'] = $x['totalUsers'] > 0 ? round((($x['totalUsers'] - $x['votedUsers']) / $x['totalUsers']) * 100, 2) : 0;
        } else
        {
            $x['votedPercentage'] = 0;
            $x['notVotedPercentage'] = 0;
        }

        $voteResult = new VoteResult();
        $x['subtitle'] = 'Dashboard';
        $x['votesByCandidate'] = $voteResult->countVotesByCandidate();
        $x['candidate'] = Candidate::get();
        $x['voteResults'] = VoteResult::get();
        $x['voter'] = Voter::get();
        $x['voterNotVoted'] = Voter::where('validation', 'belum')->get();
        
        return view('admin.dashboard', $x);
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

    public function exportData()
    {
        $activity = 'Export data dasbor';
        $this->logActivity($activity);
    
        return Excel::download(new DataExport(), 'dashboard_' . now()->format('d-M-Y_H-i') . '.xlsx');
    }    

    public function dashboardUpdate(Request $request)
    {
        // Set header untuk SSE
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        while (true) {
            $voteResults = VoteResult::get();
            $voter = Voter::get();
            $voterNotVoted = Voter::where('validation', 'belum')->count();

            $data = [
                'voteResults' => count($voteResults),
                'voter' => count($voter),
                'voterNotVoted' => $voterNotVoted,
            ];

            echo "data: " . json_encode($data) . "\n\n";
            ob_flush();
            flush();

            sleep(2); // Contoh: data diperbarui setiap 5 detik
        }
    }
}
