<?php

namespace App\Models;


class Horoscope extends MainModel
{
    protected $fillable = ['name_nepali', 'name_english', 'image_nepali', 'image_english', 'order', 'info_nepali','info_english'];
    
    public function setImageNepaliAttribute($image) {
        $this->attributes['image_nepali'] = \URL::to('storage/horoscopes/'.$image);
    }

    public function setImageEnglishAttribute($image) {
        $this->attributes['image_english'] = \URL::to('storage/horoscopes/'.$image);
    }

    public function prediction() {
        return $this->hasMany(Prediction::class);
    }

    public function user() {
        return $this->belongsToMany(User::class);
    }
}
