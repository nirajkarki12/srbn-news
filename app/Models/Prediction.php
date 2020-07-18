<?php

namespace App\Models;


class Prediction extends MainModel
{
    protected $fillable = ['horoscope_id','data','type','rating','start_date', 'end_date'];

    public function horoscope() {
        return $this->belongsTo(Horoscope::class, 'horoscope_id');
    }

}
