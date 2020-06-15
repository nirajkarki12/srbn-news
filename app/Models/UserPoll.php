<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserPoll extends Model
{

   protected $table = 'user_polls';
   public $timestamps = false;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'polloption_id',
    ];

   /**
   * The user that belong to the polls.
   */
   public function user()
   {
      return $this->belongsTo(User::class, 'user_id');
   }

}

