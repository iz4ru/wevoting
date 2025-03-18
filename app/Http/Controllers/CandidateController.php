<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index() 
    {
        // $hasilVoteModel = new HasilVoteM();
        // $x['suaraPerCalon'] = $hasilVoteModel->countVotesByCalon();
        $x['subtitle'] ='Data Paslon';
        $x['calon'] = Candidate::all();
        return view('admin.candidate.index',$x);
    }
}
