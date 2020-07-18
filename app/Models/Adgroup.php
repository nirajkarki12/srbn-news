<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Adgroup extends Model
{
    use Notifiable;

    protected $fillable = ['title', 'show_after', 'publish_date', 'expiry_date'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'publish_date' => 'datetime:Y-m-d H:i',
        'expiry_date' => 'datetime:Y-m-d H:i',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    /**
     * The bookmarks that belong to the user.
     */
    public function ads()
    {
        return $this->hasMany(Ad::class, 'adgroup_id');
    }
}
