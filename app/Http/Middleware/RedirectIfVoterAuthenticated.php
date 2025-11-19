<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfVoterAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, $guard = 'voters')
    {
        // Jika ada user admin yang login, jangan redirect
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // Cek jika sudah login sebagai voter
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();

            $voter = Voter::where([
                'user_id' => $user->user_id,
                'access_code' => $user->access_code,
            ])->first();

            if (!$voter || $voter->validation === 'sudah') {
                Auth::guard($guard)->logout();
                $request->session()->forget('access_code');
                return redirect()->route('voter.login')->with('error', '❌ Sesi telah berakhir atau Anda sudah memberikan suara!');
            }

            return redirect()->route('voter.dashboard');
        }

        return $next($request);
    }
}
