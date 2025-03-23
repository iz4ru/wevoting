<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {   
        $x['users'] = User::where('id', '!=', Auth::id())->get(); // Filter user yang sedang login
        $x['subtitle'] = 'Admin User Data';
        
        return view('admin.management.index', $x);
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

    public function createAdmin()
    {
        $x['subtitle'] = 'Create User';
        return view('admin.management.create', $x);
    }

    public function storeAdmin(Request $request)
    {
        // dd($request->all());

        $activity = "Membuat user baru";
        $this->logActivity($activity);

        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', '❌ Admin ini sudah terdaftar, silahkan memakai email yang lain!');
        }

        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', '❌ Password dan konfirmasi password tidak cocok!');
        } elseif (strlen($request->password) < 8) {
            return back()->with('error', '❌ Password minimal 8 karakter!');
        }

        // Generate username dari name
        $baseUsername = Str::slug($request->name, '');
        $username = $baseUsername;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . '' . $counter;
            $counter++;
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'required',
        ], [
            'role.required' => '❌ Role wajib diisi!',
        ]);

        // Validasi data setelah username diperbaiki
        $validatedData['username'] = $username; // Gunakan username yang sudah diperbaiki

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $username,
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        return redirect()->route('admin.mgmt')->with('success', '✅ User berhasil ditambahkan!');
    }

    public function showAdminProfile($uuid)
    {
        $x['user'] = User::where('uuid', $uuid)->firstOrFail();
        $x['subtitle'] = 'Update User';
        return view('admin.management.update', $x);
    }

    public function updateAdmin(Request $request, $uuid)
    {

        $users = User::where('uuid', $uuid)->firstOrFail();

        // Cek apakah ada user lain dengan data yang sama persis
        $existingUser = User::where('name', $request->name)
            ->where('email', $request->email)
            ->where('username', $request->username)
            // ->where('role', $request->role)
            ->where('uuid', '!=', $uuid) // Pastikan tidak menghitung user yang sedang diupdate
            ->exists();

        if ($existingUser) {
            return redirect()->route('admin.mgmt')->with('success', '✅ Data user sudah ada, tidak ada perubahan yang dilakukan!');
        }
        
        $activity = "Mengupdate data user";
        $this->logActivity($activity);

        // Cek apakah email sudah digunakan oleh user lain
        if (User::where('email', $request->email)->where('uuid', '!=', $uuid)->exists()) {
            return back()->with('error', '❌ Email sudah dipakai oleh user lain!');
        }

        // Cek apakah username sudah digunakan oleh user lain
        if (User::where('username', $request->username)->where('uuid', '!=', $uuid)->exists()) {
            return back()->with('error', '❌ Username sudah dipakai oleh user lain!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255',
            // 'role' => 'required',
        ]);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->username = $request->username;
        // $users->role = $request->role;
        $users->save();

        return redirect()->route('admin.mgmt')->with('success', '✅ User berhasil diupdate!');
    }

    public function deleteAdmin(Request $request, $uuid)
    {
        // Hitung jumlah admin yang tersisa
        $adminCount = User::where('role', 'admin')->count();
    
        // Cek apakah admin yang tersisa hanya satu
        if ($adminCount <= 1) {
            return back()->with('error', '❌ Tidak bisa menghapus user, karena hanya ada 1 admin yang tersisa!');
        }
    
        $user = User::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'password_confirmation' => 'required',
        ]);
    
        // Cek apakah password_confirmation dikirim
        if (!$request->filled('password_confirmation')) {
            return back()->with('error', '❌ Konfirmasi password wajib diisi!');
        }
    
        // Debugging: Cek apakah password_confirmation terkirim dan cocok
        if (!Hash::check($request->password_confirmation, $user->password)) {
            return back()->with('error', '❌ Password konfirmasi tidak cocok!');
        }
    
        // Jika lolos semua pengecekan, hapus user
        $activity = "Delete data user";
        $this->logActivity($activity);
        
        $user->delete();
        
        return redirect()->route('admin.mgmt')->with('success', '✅ User berhasil dihapus!');
    }

    public function formAdminPassword($uuid)
    {
        $x['subtitle'] ='Update Password Users';
        $x['user']=User::where('uuid', $uuid)->firstOrFail();
        return view('admin.management.change_password',$x);
    }

    public function changeAdminPassword(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', '❌ Password baru dan konfirmasi password tidak cocok!');
        } elseif (strlen($request->password) < 8) {
            return back()->with('error', '❌ Password baru minimal 8 karakter!');
        }
        
        $activity = "Update Password user";
        $this->logActivity($activity);

        $request->validate([
            'password_current' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Cek apakah password_current dikirim
        if (!$request->filled('password_current')) {
            return back()->with('error', '❌ Konfirmasi password wajib diisi!');
        }
    
        // Debugging: Cek apakah password_current terkirim dan cocok
        if (!Hash::check($request->password_current, $user->password)) {
            return back()->with('error', '❌ Password tidak cocok!');
        }
            
        $user->password =Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.mgmt')->with('success','✅ Password user berhasil diupdate!');        
    }
}
