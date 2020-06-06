<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = ['horoscope_id','nepali','english','type','rating','prediction_date'];

    public function horoscope() {
        return $this->belongsTo(Horoscope::class);
    }

}
