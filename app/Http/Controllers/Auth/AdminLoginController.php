<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function index() {
        $adminExists = User::where('role', 'admin')->exists();
        return view('admin.auth.login', compact('adminExists'));
    }

    public function registerFirstAdmin() {
            $adminExists = User::where('role', 'admin')->exists();

            if ($adminExists) {
                return redirect()->route('admin.login')->with('error', '❌ Admin sudah terdaftar! Silakan login dengan akun yang ada.');
        }
            return view('admin.auth.register');
        }

        public function storeFirstAdmin(Request $request) {
            
        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', '❌ Password dan konfirmasi password tidak cocok!');
        } elseif (strlen($request->password) < 8) {
            return back()->with('error', '❌ Password minimal 8 karakter!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);


        $adminExists = User::where('role', 'admin')->exists();
        if ($adminExists) {
            return redirect()->route('admin.login' ?: 'login')->with('error', '⚠️ Admin ini sudah ada!');
        }

        // Generate username dari name
        $baseUsername = Str::slug($request->name, '');
        $username = $baseUsername;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '-' . $counter;
            $counter++;
        }

        // Simpan admin pertama
        User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.login')->with('success', '✅ Akun admin berhasil dibuat! Silahkan login dengan akun yang baru saja dibuat.');
    }


    public function login_action(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', '✅ Login berhasil, Selamat datang kembali '.Auth::user()->name.' !');
        }

        return back()->with([
            'error' => '❌ Login gagal! Periksa kembali email dan password Anda. Pastikan akun Anda sudah terdaftar',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken(); 

        return redirect()->route('admin.login')->with('success', '✅ Logout berhasil, sampai jumpa kembali !');
        return view('admin.auth.login');
    }
}
