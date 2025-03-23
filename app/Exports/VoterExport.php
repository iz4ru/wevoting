<?php

namespace App\Exports;

use App\Models\Voter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class VoterExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.voter.table_preview', [
            'voters' => Voter::all()
        ]);
    }
}