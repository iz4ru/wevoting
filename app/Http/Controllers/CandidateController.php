<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Position;
use App\Models\Candidate;
use App\Models\VoteResult;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $voteResult = new VoteResult();
        $x['votesByCandidate'] = $voteResult->countVotesByCandidate();
        $x['subtitle'] = 'Data Paslon';
        $x['candidates'] = Candidate::all();
        return view('admin.candidate.index', $x);
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

    public function createCandidate()
    {
        $x['subtitle'] = 'Form Create Candidate';
        $positions = Position::all();
        return view('admin.candidate.create', compact('positions'), $x);
    }

    public function storeCandidate(Request $request)
    {
        $activity = 'Membuat data kandidat baru';
        $this->logActivity($activity);

        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'work_program' => 'required|string',
                'vision' => 'required|string',
                'mission' => 'required|string',
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048', // Standardized to 2MB
                'video_link' => 'required|string',
                'id_position' => 'required|exists:positions,id',
            ],
            [
                'name.required' => '❌ Nama kandidat harus diisi',
                'work_program.required' => '❌ Program kerja harus diisi',
                'vision.required' => '❌ Visi harus diisi',
                'mission.required' => '❌ Misi harus diisi',
                'image.required' => '❌ Gambar kandidat harus diunggah',
                'image.image' => '❌ File harus berupa gambar',
                'image.mimes' => '❌ Format gambar harus PNG atau JPG',
                'image.max' => '❌ Ukuran gambar maksimal 2MB',
                'video_link.required' => '❌ Link video kampanye harus diisi',
                'id_position.required' => '❌ Posisi harus dipilih',
                'id_position.exists' => '❌ Posisi yang dipilih tidak valid',
            ],
        );

        // Konversi video YouTube
        if ($request->video_link) {
            $validated['video_link'] = preg_replace(
                '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                'https://www.youtube.com/embed/$1',
                $validated['video_link']
            );
        }

        if (Candidate::where('id_position', $request->id_position)->exists()) {
            return back()->with('error', '❌ Data posisi ini sudah terdaftar, silahkan memakai nama posisi yang lain!');
        }

        // Buat kandidat
        $candidate = new Candidate();
        $candidate->name = $validated['name'];
        $candidate->work_program = $validated['work_program'];
        $candidate->vision = $validated['vision'];
        $candidate->mission = $validated['mission'];
        $candidate->video_link = $validated['video_link'];
        $candidate->id_position = $validated['id_position'];

        // Jika ada gambar yang diunggah
        if ($request->hasFile('image')) {   
            try {
                // Simpan file baru ke storage/app/public/images
                $filename = time() . '.' . $request->image->extension();
                $path = $request->file('image')->storeAs('images', $filename, 'public');

                // Simpan nama file ke database
                $candidate->image = $filename;
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->with('error', '❌ Gagal mengunggah gambar: ' . $e->getMessage());
            }
        }

        // Simpan data kandidat ke database
        $candidate->save();

        return redirect()->route('candidate')->with('success', '✅ Data kandidat berhasil ditambahkan');
    }

    public function showCandidate($id)
    {   
        $x['subtitle'] ='Form Update Kandidat';
        $candidate = Candidate::findOrFail($id);
        $positions = Position::all();
        return view('admin.candidate.update',compact('candidate','positions'), $x);
    }

    public function updateCandidate(Request $request, $id)
    {
        $activity = 'Memperbarui data kandidat';
        $this->logActivity($activity);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'work_program' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Gambar opsional
            'video_link' => 'nullable|string',
            'id_position' => 'required|exists:positions,id',
        ], [
            'name.required' => '❌ Nama kandidat harus diisi',
            'work_program.required' => '❌ Program kerja harus diisi',
            'vision.required' => '❌ Visi harus diisi',
            'mission.required' => '❌ Misi harus diisi',
            'image.image' => '❌ File harus berupa gambar',
            'image.mimes' => '❌ Format gambar harus PNG atau JPG',
            'image.max' => '❌ Ukuran gambar maksimal 2MB',
            'id_position.required' => '❌ Posisi harus dipilih',
            'id_position.exists' => '❌ Posisi yang dipilih tidak valid',
        ]);

        $candidate = Candidate::findOrFail($id);

        // Konversi video YouTube
        if ($request->video_link) {
            $validated['video_link'] = preg_replace(
                '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                'https://www.youtube.com/embed/$1',
                $validated['video_link']
            );
        }
        
        // Periksa apakah id_position sudah digunakan oleh kandidat lain
        if (Candidate::where('id_position', $request->id_position)->where('id', '!=', $id)->exists()) {
            return back()->with('error', '❌ Data posisi ini sudah terdaftar oleh kandidat lain!');
        }

        $candidate->name = $validated['name'];
        $candidate->work_program = $validated['work_program'];
        $candidate->vision = $validated['vision'];
        $candidate->mission = $validated['mission'];
        $candidate->video_link = $validated['video_link'] ?? null;
        $candidate->id_position = $validated['id_position'];

        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            try {
                // Hapus gambar lama jika ada
                if ($candidate->image) {
                    Storage::disk('public')->delete('images/' . $candidate->image);
                }

                // Simpan file baru ke storage/app/public/images
                $filename = time() . '.' . $request->image->extension();
                $path = $request->file('image')->storeAs('images', $filename, 'public');
                
                // Simpan nama file baru ke database
                $candidate->image = $filename;
            } catch (\Exception $e) {
                return back()->withInput()->with('error', '❌ Gagal mengunggah gambar: ' . $e->getMessage());
            }
        }

        // Simpan perubahan ke database
        $candidate->save();

        return redirect()->route('candidate')->with('success', '✅ Data kandidat berhasil diperbarui');
    }

    public function deleteCandidate(Request $request, $id)
    {
        $activity = "Delete data kandidat";
        $this->logActivity($activity);

        $candidate = Candidate::find($id);

        $request->validate([
            'password_confirmation' => 'required',
        ]);

        if (!$request->filled('password_confirmation')) {
            return back()->with('error', '❌ Konfirmasi password wajib diisi!');
        }

        // Debugging: Cek apakah password_confirmation terkirim dan cocok
        if (!Hash::check($request->password_confirmation, Auth::user()->password)) {
            return back()->with('error', '❌ Password konfirmasi tidak cocok!');
        }

        if(VoteResult::where('id_candidate', $id)->exists()) {
            return back()->with('error', '❌ Kandidat ini sudah memiliki suara, tidak bisa dihapus!');
        }

        if ($candidate && $candidate->image) {
            Storage::disk('public')->delete('images/' . $candidate->image);
        }

        $candidate->delete();

        return back()->with('success','✅ Data kandidat berhasil dihapus!');
    }

    public function previewCandidate($id)
    {
        $x['subtitle'] = 'Detail Kandidat';
        $candidate = Candidate::findOrFail($id);
        $positions = Position::all();
        return view('admin.candidate.preview', compact('candidate', 'positions'), $x);
    }

}
