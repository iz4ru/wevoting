<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidateVoterSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // ===== TAMBAHKAN INI: Cek jika admin login, logout voter =====
        if (Auth::guard('web')->check()) {
            if (Auth::guard('voters')->check()) {
                Auth::guard('voters')->logout();
            }
            return redirect()->route('dashboard')
                ->with('info', 'ℹ️ Anda sudah login sebagai admin.');
        }
        // ==============================================================

        if (Auth::guard('voters')->check()) {
            $user = Auth::guard('voters')->user();

            $voter = Voter::where([
                'user_id' => $user->user_id,
                'access_code' => $user->access_code,
            ])->first();

            if (!$voter || $voter->validation === 'sudah') {
                Auth::guard('voters')->logout();
                $request->session()->regenerateToken();
                
                return redirect()->route('voter.login')
                    ->with('error', '❌ Sesi telah berakhir atau Anda sudah memberikan suara!');
            }
        }

        return $next($request);
    }
}
