<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    const SCIENCE = 1;
    const POLITICS = 2;
    const TECHNOLOGY = 3;
    const SPORTS = 4;
    const ECONOMY = 5;
    const MEDIA = 6;
    const WORLD = 7;

    public function news(){
        return $this->hasMany(News::class)->published();
    }

    public function cover(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
