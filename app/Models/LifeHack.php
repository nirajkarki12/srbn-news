<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LifeHack extends MainModel
{
    protected $fillable = ['content','image'];

    public function translation() {
        return $this->hasOne(LifeHackTranslation::class);
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/lifehacks/'.$image);
    }

    public static function boot() {
        parent::boot();
        
        static::deleting(function($lifehack){
            $lifehack->likes()->delete();
        });
    }


}
