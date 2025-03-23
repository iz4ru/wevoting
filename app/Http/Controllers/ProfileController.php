<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function updateProfile(Request $request, $uuid)
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
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'required', // Harus memasukkan password sebelum update
        ], [
            'avatar.max' => '❌ Ukuran file terlalu besar! Maksimal 2MB.',
        ]);
    
        // Cek apakah password yang dimasukkan benar sebelum update data
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', '❌ Password salah! Perubahan tidak disimpan.');
        }

        // Jika ada gambar yang diunggah
        if ($request->hasFile('avatar')) {   
            try {
                 // Hapus avatar lama jika bukan default
                if ($user->avatar && $user->avatar !== 'default.jpg') {
                    Storage::disk('public')->delete('avatars/' . $user->avatar);
                }

                // Simpan file baru ke storage/app/public/images
                $filename = time() . '.' . $request->avatar->extension();
                $path = $request->file('avatar')->storeAs('avatars', $filename, 'public');

                // Simpan nama file ke database
                $user->avatar = $filename;
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->with('error', '❌ Gagal mengunggah gambar: ' . $e->getMessage());
            }
        }
    
        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();
    
        // Log aktivitas
        $activity = "Memperbarui profilnya";
        $this->logActivity($activity);
    
        return back()->with('success', '✅ Profil berhasil diperbarui!');
    }
    
}
