<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteTranslation extends Model
{
    protected $fillable = ['quote_id', 'quote','author'];

    public function quote() {
        return $this->belongsTo(Quote::class);
    }
}
