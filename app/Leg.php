<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leg extends Model
{
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function products()
    {
        return $this->morphMany('App\Product', 'options');
    }
}
