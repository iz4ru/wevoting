<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use App\Models\Voter;
use App\Models\VoteResult;
use Illuminate\Support\Str;
use App\Exports\VoterExport;
use App\Imports\VoterImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class VoterController extends Controller
{
    public function index(Request $request)
    {
        $query = Voter::query();

        // Filter berdasarkan kelas jika ada
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        // Filter berdasarkan jurusan jika ada
        if ($request->filled('vocation')) {
            $query->where('vocation', $request->vocation);
        }

        // Ambil data setelah filter diterapkan
        $x['voters'] = $query->get();

        // Ambil daftar unik kelas dan jurusan dari database
        $x['classes'] = Voter::select('class')->distinct()->pluck('class');
        $x['vocations'] = Voter::select('vocation')->distinct()->pluck('vocation');

        $x['subtitle'] = 'Data Users Voting';

        return view('admin.voter.index', $x);
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

    public function showImportVoter()
    {
        $x['subtitle'] = 'Import Voter';

        if (Auth::user()->role == 'panitia') {
            abort(403, 'Unauthorized');
        }

        return view('admin.voter.import', $x);
    }

    public function importVoter(Request $request)
    {
        $activity = 'Import data pemilih';
        $this->logActivity($activity);

        if ($request->file('file')->getSize() > 1000000) {
            return back()->with('error', '❌ File terlalu besar, maksimal 1MB!');
        }

        if ($request->file('file')->getClientOriginalExtension() != 'xlsx' && $request->file('file')->getClientOriginalExtension() != 'xls' && $request->file('file')->getClientOriginalExtension() != 'csv') {
            return back()->with('error', '❌ File harus berformat xlsx, xls, atau csv!');
        }

        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Simpan file ke storage public
        $filename = time() . '_' . $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('voters', $filename, 'public');

        // Ambil path lengkap dari penyimpanan
        $fullPath = Storage::disk('public')->path($path);

        // Impor file dari penyimpanan
        Excel::import(new VoterImport(), $fullPath);

        return redirect()->route('voter')->with('success', '✅ Data pemilih berhasil diimpor!');
    }

    public function exportVoter()
    {
        $activity = 'Export data pemilih';
        $this->logActivity($activity);

        return Excel::download(new VoterExport(), 'voters_' . now()->format('d-M-Y_H-i') . '.xlsx');

        return redirect()->route('voter')->with('success', '✅ Data pemilih berhasil diekspor!');
    }

    public function exportVoterPDF(Request $request)
    {
        $activity = 'Export PDF data pemilih';
        $this->logActivity($activity);

        $query = Voter::query();

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('vocation')) {
            $query->where('vocation', $request->vocation);
        }

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $data = $query->get();

        $pdf = Pdf::loadView('admin.voter.pdf', ['data' => $data]);

        return $pdf->stream('voter.pdf');
    }

    public function createVoter()
    {
        $x['subtitle'] = 'Create Voter';

        if (Auth::user()->role == 'panitia') {
            abort(403, 'Unauthorized');
        }

        return view('admin.voter.create', $x);
    }

    public function storeVoter(Request $request)
    {
        // dd($request->all());

        $activity = 'Membuat data pemilih baru';
        $this->logActivity($activity);

        if (Voter::where('user_id', $request->user_id)->exists()) {
            return back()->with('error', '❌ Pemilih dengan nomor identitas ini sudah terdaftar, silahkan memakai yang lain!');
        }

        if (Str::length((string) $request->user_id) > 10) {
            return back()->with('error', '❌ Nomor identitas terlalu panjang!');
        }

        $validatedData = $request->validate(
            [
                'user_id' => 'required|numeric|digits_between:1,10|unique:voters,user_id',
                'name' => 'required|string|max:255',
                'class' => 'required|string|max:255',
                'vocation' => 'required|string|max:255',
            ],
            [
                'user_id.required' => '❌ Nomor identitas tidak boleh kosong!',
                'user_id.integer' => '❌ Nomor identitas harus berupa angka!',
                'user_id.unique' => '❌ Nomor identitas sudah terdaftar, silahkan memakai yang lain!',
                'user_id.digits_between' => '❌ Nomor identitas terlalu panjang!',
                'name.required' => '❌ Nama tidak boleh kosong!',
                'name.string' => '❌ Nama harus berupa teks!',
                'name.max' => '❌ Nama terlalu panjang!',
                'class.required' => '❌ Kelas tidak boleh kosong!',
                'class.string' => '❌ Kelas harus berupa teks!',
                'class.max' => '❌ Kelas terlalu panjang!',
                'vocation.required' => '❌ Jurusan tidak boleh kosong!',
                'vocation.string' => '❌ Jurusan harus berupa teks!',
                'vocation.max' => '❌ Jurusan terlalu panjang!',
            ],
        );

        Voter::create([
            'user_id' => $validatedData['user_id'],
            'name' => $validatedData['name'],
            'class' => $validatedData['class'],
            'vocation' => $validatedData['vocation'],
            'access_code' => Str::upper(Str::random(6)),
        ]);

        return redirect()->route('voter')->with('success', '✅ User berhasil ditambahkan!');
    }

    public function showVoter($uuid)
    {
        $x['voter'] = Voter::where('uuid', $uuid)->firstOrFail();
        $x['subtitle'] = 'Update Voter';

        if (Auth::user()->role == 'panitia') {
            abort(403, 'Unauthorized');
        }

        return view('admin.voter.update', $x);
    }

    public function updateVoter(Request $request, $uuid)
    {
        $voter = Voter::where('uuid', $uuid)->firstOrFail();

        $existingVoter = Voter::where('user_id', $request->user_id)->where('name', $request->name)->where('class', $request->class)->where('uuid', '!=', $uuid)->exists();

        if ($existingVoter) {
            return redirect()->route('voter')->with('success', '✅ Data pemilih sudah ada, tidak ada perubahan yang dilakukan!');
        }

        $activity = 'Mengubah data pemilih';
        $this->logActivity($activity);

        if (Voter::where('user_id', $request->user_id)->where('uuid', '!=', $uuid)->exists()) {
            return back()->with('error', '❌ Nomor identitas ini sudah dipakai oleh pemilih lain!');
        }

        if (Str::length((string) $request->user_id) > 10) {
            return back()->with('error', '❌ Nomor identitas terlalu panjang!');
        }

        $validatedData = $request->validate(
            [
                'user_id' => 'required|numeric|digits_between:1,10|unique:voters,user_id,' . $voter->uuid . ',uuid',
                'name' => 'required|string|max:255',
                'class' => 'required|string|max:255',
                'vocation' => 'required|string|max:255',
            ],
            [
                'user_id.required' => '❌ Nomor identitas tidak boleh kosong!',
                'user_id.integer' => '❌ Nomor identitas harus berupa angka!',
                'user_id.unique' => '❌ Nomor identitas sudah terdaftar, silahkan memakai yang lain!',
                'user_id.digits_between' => '❌ Nomor identitas terlalu panjang!',
                'name.required' => '❌ Nama tidak boleh kosong!',
                'name.string' => '❌ Nama harus berupa teks!',
                'name.max' => '❌ Nama terlalu panjang!',
                'class.required' => '❌ Kelas tidak boleh kosong!',
                'class.string' => '❌ Kelas harus berupa teks!',
                'class.max' => '❌ Kelas terlalu panjang!',
                'vocation.required' => '❌ Jurusan tidak boleh kosong!',
                'vocation.string' => '❌ Jurusan harus berupa teks!',
                'vocation.max' => '❌ Jurusan terlalu panjang!',
            ],
        );

        $voter->user_id = $validatedData['user_id'];
        $voter->name = $validatedData['name'];
        $voter->class = $validatedData['class'];
        $voter->vocation = $validatedData['vocation'];
        $voter->save();

        return redirect()->route('voter')->with('success', '✅ Data pemilih berhasil diubah!');
    }

    public function deleteVoter($uuid)
    {
        $activity = 'Delete data pemilih';
        $this->logActivity($activity);

        $voter = Voter::where('uuid', $uuid)->firstOrFail();
        VoteResult::where('id_voter', $voter->user_id)->delete();
        $voter->delete();

        return redirect()->route('voter')->with('success', '✅ Data berhasil dihapus!');
    }

    public function truncateVoter(Request $request)
    {
        // Hitung jumlah admin yang tersisa
        $voterCount = Voter::count();

        $user = Auth::user();

        $request->validate([
            'password_confirmation' => 'required',
        ]);

        // Cek apakah password_confirmation dikirim
        if (!$request->filled('password_confirmation')) {
            return back()->with('error', '❌ Konfirmasi password wajib diisi!');
        }

        // Debugging: Cek apakah password_confirmation terkirim dan cocok
        if (!Hash::check($request->password_confirmation, Auth::user()->password)) {
            return back()->with('error', '❌ Password konfirmasi tidak cocok!');
        }

        // Cek apakah admin yang tersisa hanya satu
        if ($voterCount < 1) {
            return back()->with('error', '❌ Tidak bisa menghapus data pemilih, karena tidak ada data yang ditemukan!');
        }

        $activity = 'Truncate data pemilih';
        $this->logActivity($activity);

        VoteResult::truncate();
        Voter::truncate();

        return redirect()->back()->with('success', '✅ Semua user berhasil dihapus!');
    }

    public function loadByValidation(Request $request)
    {
        $data = Voter::where('validation', $request->validation)->get();
    }

    public function showSearchPage()
    {
        return view('search-code');
    }

    public function searchVoterByUserID(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
        ]);

        $userId = $request->input('user_id');

        // Search voter by exact user_id match
        $voter = Voter::where('user_id', $userId)->select('uuid', 'user_id', 'name', 'class', 'vocation', 'access_code')->first();

        if ($voter) {
            return response()->json([
                'success' => true,
                'voter' => $voter,
            ]);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data tidak ditemukan. Pastikan NIS/NO ID/NIP yang Anda masukkan benar.',
                ],
                404,
            );
        }
    }
}
