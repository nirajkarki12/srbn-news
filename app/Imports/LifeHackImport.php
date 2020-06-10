<?php

namespace App\Imports;

use App\Models\LifeHack;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class LifeHackImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $lifehack = new LifeHack([
            'content'   => $row['content_english']
        ]);

        if($lifehack->save() && $row['content_nepali']) {
            $lifehack->translation()->create([
                'content' => $row['content_nepali']
            ]);
        }

        return $lifehack;

    }
}
