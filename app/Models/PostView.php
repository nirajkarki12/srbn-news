<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class PostView extends Model
{
   
   /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'post_id', 'session_id', 'ip', 'user_agent',
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
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function post()
	{
	    return $this->belongsTo(Post::class, 'post_id');
	}

	public static function createViewLog(Post $post) {
      $view = new PostView();
      $view->post_id = $post->id;
      $view->session_id = request()->getSession()->getId();
      $view->ip = request()->ip();
      $view->user_agent = request()->header('User-Agent');
      $view->save();
  }
}
