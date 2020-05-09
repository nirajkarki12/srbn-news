<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Polloption;

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

   /**
   * The option that belong to the polls.
   */
   public function option()
   {
      return $this->belongsTo(Polloption::class, 'polloption_id');
   }

}

