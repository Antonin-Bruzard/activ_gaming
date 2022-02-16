<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
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
            'slug',
            'image_id'
        ];

/*    protected $hidden =
        [
            'created_at',
            'updated_at',
            'deleted_at'
        ];*/

    /**
     * Get category by slug. Not by ID.
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
        } elseif (isset($this->attributes['slug']) && $value != $this->attributes['slug']) {
            $this->attributes['slug'] = Str::slug($value);
        } else {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    public function articles() {
        return $this->hasMany('App\Models\Article', 'category_id')->withTrashed();
    }

    public function articlesPublished() {
        return $this->hasMany('App\Models\Article', 'category_id')->whereNotNull('published')->orWhere('published', '<=', Carbon::now());
    }

    public function articlesUnpublished() {
        return $this->hasMany('App\Models\Article', 'category_id')->whereNull('published')->orWhere('published', '>', Carbon::now());
    }

    public function articlesDeleted() {
        return $this->hasMany('App\Models\Article', 'category_id')->onlyTrashed();
    }

    public function thumbnail() {
        return $this->hasOne('App\Models\File', 'id', 'image_id');
    }
}
