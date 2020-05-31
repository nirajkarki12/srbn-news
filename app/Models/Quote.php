<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Quote extends Model
{
	use Notifiable;

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'quote', 'author', 'status',
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

   /**
   * The likes that belong to the quote.
   */
   public function likes()
   {
      return $this->belongsToMany(User::class, 'quote_likes');
   }

}

