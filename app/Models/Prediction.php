<?php

namespace App\Models;


class Prediction extends MainModel
{
    protected $fillable = ['horoscope_id','data','type','rating','prediction_date'];

    public function horoscope() {
        return $this->belongsTo(Horoscope::class);
    }

}
