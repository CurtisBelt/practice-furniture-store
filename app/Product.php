<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $with = [
        'fabrics:id,name,description',
        'legs:id,name,description'
    ];

    public function path()
    {
        return "/api/products/{$this->id}";
    }

    public function fabrics()
    {
        return $this->morphedByMany('App\Fabric', 'optionable', 'options');
    }

    public function legs()
    {
        return $this->morphedByMany('App\Leg', 'optionable', 'options');
    }
}
