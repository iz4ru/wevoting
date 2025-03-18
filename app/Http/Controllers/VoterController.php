<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    public function index()
    {
        $x['user']=Voter::all();
        $x['subtitle'] ='Data Users Voting';
        return view('admin.voter.index',$x);
    }
}
