<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    const SCIENCE = 1;
    const POLITICS = 2;
    const TECHNOLOGY = 3;
    const SPORTS = 4;
    const ECONOMY = 5;
    const MEDIA = 6;
    const WORLD = 7;


    public function news(){
        return $this->hasOne(News::class);
    }
}
