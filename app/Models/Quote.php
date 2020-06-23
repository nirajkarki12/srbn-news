<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Quote extends MainModel
{
	use Notifiable;

	/**
	 * The categories that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'quote', 'author', 'status','type'
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

    public function bookmarks() {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($quote){
            $quote->bookmarks()->delete();
        });
    }


   public function translation() {
       return $this->hasOne(QuoteTranslation::class)->select('quote_id','quote','author');
   }

}

