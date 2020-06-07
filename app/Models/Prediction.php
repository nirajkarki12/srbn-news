<?php

namespace App\Models;


class Prediction extends MainModel
{
    protected $fillable = ['horoscope_id','nepali','english','type','rating','prediction_date'];


    protected $appends = ['text'];

    protected $hidden = ['nepali','english','prediction_date','created_at','updated_at'];

    public function horoscope() {
        return $this->belongsTo(Horoscope::class);
    }

    public function getTextAttribute() {
        if($this->lang() == 'ne') return $this->nepali;
        return $this->english;
    }



}
