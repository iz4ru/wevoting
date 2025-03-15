<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        $x['subtitle']='Log';
        $userRole = Auth::user()->role;

        if ($userRole === 'admin') {
            $x['logs'] = Log::all();
        } else {
            $x['logs'] = Log::where('userid','panitia')->get();
        }
        return view('admin.log.index',$x);
    }
}
