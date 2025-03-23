<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoteResult extends Model
{
    use HasFactory;
    protected $table = 'vote_results';
    protected $fillable = [
        'id_voter',
        'id_candidate'
    ];

    public function candidate() 
    {
        return $this->belongsTo(Candidate::class, 'id_candidate');
    }

    public function countVotesByCandidate()
    {
        return DB::table('vote_results')
        ->select('id_candidate', DB::raw('count(*) as total_votes'))
        ->groupBy('id_candidate')
        ->get()
        ->map(function($item){
            return [
                'id_candidate' => $item->id_candidate,
                'total_votes' => $item->total_votes,
            ];
        });
    }
}
