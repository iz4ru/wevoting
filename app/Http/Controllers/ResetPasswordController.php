<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function index() 
    {
        return view('admin.auth.forgot-password');
    }

    public function sendPasswordResetLink(Request $request) {
        $request->validate(['email' => 'required|email']);
     
        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::ResetLinkSent
            ? back()->with(['status' => '✅ Kami telah mengirimkan email reset password!'])
            : back()->withErrors(['email' => '❌ Email yang kamu masukkan tidak terdaftar.']);
    }

    public function resetPassword(string $token) {
        return view('admin.auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request) {

        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', '❌ Password dan konfirmasi password tidak cocok!');
        }

        if (strlen($request->password) < 8) {
            return back()->with('error', '❌ Password minimal 8 karakter!');
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', '❌ Masukkan email yang benar!');
        }

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        if ($status === Password::PasswordReset) {
            return redirect()->route('admin.login')->with('success', '✅ Password berhasil direset! Silakan login.');
        } else {
            return back()->with('error', '❌ Token reset password tidak valid atau email salah.');
        }
    }
}
