<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LifeHackTranslation extends Model
{
    protected $fillable = ['life_hack_id','content'];

    public function lifeHack() {
        return $this->belongsTo(LifeHack::class);
    }
}
