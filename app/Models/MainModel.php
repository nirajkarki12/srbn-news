<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainModel extends Model
{

    public function lang() {
        return request('lang')?:'en';
    }
}