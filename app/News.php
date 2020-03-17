<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    public static $types = ['News' => 'News', 'Article' => 'Article'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_title', 'secondary_title', 'author_id', 'type', 'content', 'published', 'is_featured'
    ];

    public function staff(){
        return $this->belongsTo(Staff::class, 'author_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only include published news.
     *
     * @param Builder $query
     * @return void
     */
    public function scopePublished($query)
    {
        $query->wherePublished(True);
    }

    /**
     * Scope a query to only include published news.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeFeatured($query)
    {
        $query->whereIsFeatured(True);
    }
}
