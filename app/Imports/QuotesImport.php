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
    public function model(array $row)
    {
        $quote = new Quote([
            'quote' => $row['quote_english'],
            'author' => $row['author_english'],
            'status'   => 1
        ]);

        if($quote->save() && $row['quote_nepali'] && $row['author_nepali']) {
            $quote->translation()->create([
                'quote' => $row['quote_nepali'],
                'author' => $row['author_nepali']
            ]);
        }

        return $quote;

    }

}
