<?php

namespace App\Imports;

use App\Models\Voter;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VoterImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Voter([
            'user_id' => $row['user_id'],
            'name' => $row['name'],
            'class' => $row['class'],
            'vocation' => $row['vocation'],
            'access_code' => isset($row['access_code']) && !empty($row['access_code']) 
            ? $row['access_code'] 
            : Str::upper(Str::random(6)), // Generate kode acak jika tidak ada
        ]);
    }
}
