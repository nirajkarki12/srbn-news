<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Adgroup extends Model
{
    use Notifiable;

    protected $fillable = ['title','ads'];

}
