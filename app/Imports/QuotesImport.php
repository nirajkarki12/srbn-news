<?php

namespace App\Imports;

use App\Models\Quote;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuotesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) {

        $quote = new Quote([
            'quote' => $row['quote'],
            'author' => $row['author'],
            'type'  => $row['type'],
            'status' => 1,
            ]);

        return $quote;
    }
}
