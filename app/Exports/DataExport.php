<?php

namespace App\Exports;

use App\Models\Voter;
use App\Models\Candidate;
use App\Models\VoteResult;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DataExport implements FromView
{
    public function view(): View
    {
        $totalUsers = Voter::count();
        $votedUsers = Voter::where('validation', 'sudah')->count();

        if ($totalUsers > 0) {
            $votedPercentage = round(($votedUsers / $totalUsers) * 100, 2);
            $notVotedPercentage = round((($totalUsers - $votedUsers) / $totalUsers) * 100, 2);
        } else {
            $votedPercentage = 0;
            $notVotedPercentage = 0;
        }

        return view('admin.export_data', [
            'timestamp' => now()->format('d M Y H:i'), // Tambahkan timestamp
            'voter' => Voter::all(),
            'candidate' => Candidate::all(),
            'voteResults' => VoteResult::all(),
            'voterNotVoted' => Voter::where('validation', 'belum')->get(),
            'totalUsers' => Voter::count(),
            'votedUsers' => Voter::where('validation', 'sudah')->count(),
            'votedPercentage' => $votedPercentage,
            'notVotedPercentage' => $notVotedPercentage,
        ]);
    }
}
