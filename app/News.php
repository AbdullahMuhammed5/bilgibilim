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
     * Override deleting behavior for parent
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function($news)
        {
            $news->related()->delete();
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_title', 'secondary_title', 'author_id', 'type', 'content', 'published'
    ];

    public function staff(){
        return $this->belongsTo(Staff::class, 'author_id');
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function files(){
        return $this->morphMany(File::class, 'fileble');
    }

    public function related(){
        return $this->hasMany(Related::class, 'news_id');
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
}
