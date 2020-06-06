<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Polloption;

class PolloptionTranslation extends Model
{
    protected $fillable = ['polloption_id', 'value'];

    public function post() {
        return $this->belongsTo(Polloption::class);
    }
}
