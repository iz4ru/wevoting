<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Candidate;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $x['subtitle'] = 'Detail Kandidat';
        $candidates = Candidate::all();
        $positions = Position::all();
        return view('index', compact('candidates', 'positions'), $x);
    }
}
