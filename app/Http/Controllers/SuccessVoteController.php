<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessVoteController extends Controller
{
    public function index()
    {
        return view('users.success');
    }
}
