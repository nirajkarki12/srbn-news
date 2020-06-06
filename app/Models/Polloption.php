<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Poll;
use App\Models\User;
use App\Models\PolloptionTranslation;

class Polloption extends Model
{
   use Notifiable;

   protected $table = 'poll_options';

	/**
	 * The polls that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
       'value', 'total', 'poll_id',
	];

   /**
     * The polls that should be cast to native types.
     *
     * @var array
     */
   protected $casts = [
     'created_at' => 'datetime:Y-m-d H:i',
     'updated_at' => 'datetime:Y-m-d H:i',
   ];

   /**
   * The option that belong to the polls.
   */
   public function poll()
   {
      return $this->belongsTo(Poll::class, 'poll_id');
   }

    public function translation() {
        return $this->hasOne(PolloptionTranslation::class)->select('polloption_id', 'id','value');
    }

   /**
   * The users that belong to the polls.
   */
   public function userPolls()
   {
      return $this->belongsToMany(User::class, 'user_polls');
   }

}

