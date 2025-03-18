<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {   
        $x['users'] = User::all();
        $x['subtitle'] = 'Admin Profile';
        
        return view('admin.profile', $x);
    }

    public function logActivity($activity)
    {
        $user = Auth::user();
        $username = $user->username;
        $role = null;

        if ($user->role === 'admin') {
            $role = 'Admin';
        } elseif ($user->role === 'panitia') {
            $role = 'Admin';
        }

        $log = new Log([
            'username' => $username,
            'activity' => $activity,
            'role' => $role,
        ]);

        $log->save();
    }

    public function showAdminProfile()
    {
        $x['user'] = Auth::user(); // Ambil data user yang sedang login
        $x['subtitle'] = 'Update User';
        return view('admin.profile', $x);
    }

    public function updateAdmin(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Pastikan hanya user yang sedang login yang bisa mengupdate dirinya sendiri
        if ($user->id !== Auth::id()) {
            return back()->with('error', '❌ Anda tidak memiliki izin untuk mengedit pengguna ini.');
        }

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'current_password' => 'required', // Harus memasukkan password sebelum update
        ]);

        // Cek apakah password yang dimasukkan benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', '❌ Password salah! Perubahan tidak disimpan.');
        }

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();

        $activity = "Memperbarui profilnya";
        $this->logActivity($activity);

        return back()->with('success', '✅ Profil berhasil diperbarui!');
    }
}
