<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    public function index()
    {
        $x['positions'] = Position::all();
        $x['subtitle'] ='Data Posisi';
        return view('admin.position.index', $x);
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

    public function createPosition()
    {
        $x['subtitle'] ='Form Insert Posisi';
        return view('admin.position.create',$x);
    }

    public function storePosition(Request $request)
    {
        $activity = "Membuat data posisi";
        $this->logActivity($activity);   

        if (Position::where('position_name', $request->position_name)->exists()) {
            return back()->with('error', '❌ Data posisi ini sudah terdaftar, silahkan memakai nama posisi yang lain!');
        }

        $request->validate([
            'position_name'=>'required|unique:positions,position_name',
        ]);

        $position=new Position();
        $position->position_name = $request->position_name;
        $position->save();

    return redirect()->route('position')->with('success','✅ Data berhasil ditambahkan!');
    }

    public function showPosition($id)
    {
        $x['subtitle'] ='Form Update Posisi';
        $x['position'] = Position::findOrFail($id);
        return view('admin.position.update',$x);
    }

    public function updatePosition(Request $request, $id)
    {
        // Find the position first
        $position = Position::findOrFail($id);
        
        // Check if there's an existing position with the same name (excluding this one)
        $existingPosition = Position::where('position_name', $request->position_name)
            ->where('id', '!=', $id)
            ->exists();
    
        if ($existingPosition) {
            return back()->with('error', '❌ Data posisi ini sudah terdaftar, silahkan memakai nama posisi yang lain!');
        }
        
        // Log the activity
        $activity = "Update data posisi";
        $this->logActivity($activity);   
    
        // Validate the request
        $request->validate([
            'position_name' => 'required',
        ]);
    
        // Update and save
        $position->position_name = $request->position_name;
        $position->save();
    
        return redirect()->route('position')->with('success', '✅ Data berhasil diupdate!');
    }

    public function deletePosition($id)
    {
        $activity = "Delete data posisi";
        $this->logActivity($activity);   

        $position=Position::findOrFail($id);
        $position->delete();
        return redirect()->route('position')->with('success','✅ Data berhasil dihapus!');
    }
}
