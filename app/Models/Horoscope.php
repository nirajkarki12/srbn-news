<?php

namespace App\Models;


class Horoscope extends MainModel
{
    protected $fillable = ['name', 'image', 'order', 'info', 'lang'];

    protected $appends = ['is_selected'];

    public function getIsSelectedAttribute(){
        if(!$this->user()) return false;
        return $this->users->contains($this->user()->id);
    }

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/horoscopes/'.$image);
    }

    public function prediction() {
        return $this->hasMany(Prediction::class);
    }

    public function users() {
        return $this->belongsToMany(User::class,'horoscope_user');
    }
}
