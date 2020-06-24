<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public $timestamps = false;

    protected $fillable = ['image', 'adgroup_id'];

    public function adGroup() {
        return $this->belongsTo(Adgroup::class);
    }

}
