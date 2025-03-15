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
        $x['users'] = User::get();
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

    public function showAdminProfile($id)
    {
        $x['user'] = User::findOrFail($id);
        $x['subtitle'] = 'Update User';
        return view('admin.management.update', $x);
    }

    public function updateAdmin(Request $request, $id)
    {
        $activity = "Mengupdate data user";
        $this->logActivity($activity);

        if (User::where('email', $request->email)->exists()) {
            return back()->with('error', '❌ Admin ini sudah terdaftar, silahkan memakai email yang lain!');
        }

        if (User::where('username', $request->username)->exists()) {
            return back()->with('error', '❌ Admin ini sudah terdaftar, silahkan memakai username yang lain!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required',
        ]);

        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->username = $request->username;
        $users->role = $request->role;
        $users->save();

        return redirect()->route('admin.mgmt')->with('success', '✅ User berhasil diupdate!');
    }

    public function deleteAdmin($id)
    {
        // Hitung jumlah admin yang tersisa
        $adminCount = User::where('role', 'admin')->count();

        // Cek apakah admin yang tersisa hanya satu
        if ($adminCount <= 1) {
            return back()->with('error', '❌ Tidak bisa menghapus user, karena hanya ada 1 admin yang tersisa!');
        }

        $x['user'] = User::findOrFail($id);

        $activity = "Delete data user";
        $this->logActivity($activity);
        
        $x['user']->delete();

        return redirect()->route('admin.mgmt')->with('success', '✅ User berhasil dihapus!');
    }

    public function formAdminPassword($id)
    {
        $x['subtitle'] ='Update Password Users';
        $x['user']=User::findOrFail($id);
        return view('admin.management.change_password',$x);
    }

    public function changeAdminPassword(Request $request, $id)
    {
        $activity = "Update Password user";
        $this->logActivity($activity);

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $users=User::findOrFail($id);
        $users->password =Hash::make($request->password);
        $users->save();

        return redirect()->route('admin.mgmt')->with('success','✅ Password user berhasil diupdate!');        
    }
}
