<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Movie extends Model
{
	use Notifiable;

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'title', 'description', 'release_at',
	];

   /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

}

