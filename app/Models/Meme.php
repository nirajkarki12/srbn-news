<?php

namespace App\Models;


class Meme extends MainModel
{
    protected $fillable = ['image','source'];

    protected $appends = ['is_liked'];


    public function getIsLikedAttribute() {

        if(!$this->user()) return false;

        return (bool) $this->likes()->where('user_id', $this->user()->id)->first();
    }

    public function setImageAttribute($image) {
        $this->attributes['image'] = \URL::to('storage/memes/'.$image);
    }

    public function likes() {
        return $this->morphMany(Like::class, 'likeable');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($meme){
            $meme->likes()->delete();
        });
    }
}
