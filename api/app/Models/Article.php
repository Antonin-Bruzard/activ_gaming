<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use SoftDeletes;
    /**
     * @var array
     * Allow fields to be edited.
     */
    protected $fillable =
        [
            'title',
            'description',
            'content',
            'user_id',
            'category_id',
            'slug',
            'img_id',
            'img_large_id',
            'published',
        ];

    /**
     * Get articles by slug. Not by ID.
     */
    public function getRouteKey()
    {
        return $this->slug;
    }

    /**
     * @param $value Slug
     * Define a slug, if is empty.
     */
    public function setSlugAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['slug'] = Str::slug($this->title);
        } elseif ($value != $this->attributes['slug']) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function banner() {
        return $this->hasOne('App\Models\File', 'id', 'img_large_id');
    }

    public function thumbnail() {
        return $this->hasOne('App\Models\File', 'id', 'img_id');
    }

    public function author() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
