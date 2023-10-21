<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RyanChandler\Comments\Concerns\HasComments;

class Post extends Model
{
    use HasFactory,HasComments;

    protected  $fillable = [
        'title',
        'slug',
        'link',
        'thumbnail',
        'content',
        'published_at',
        'is_featured',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'view_count'
    ];


    //appends
    protected $appends = ['url','short_content'];



    //accessor
    public function getUrlAttribute()
    {
        return route('post.details', $this->slug);
    }

    //short_content
    public function getShortContentAttribute()
    {
        return substr(strip_tags($this->content), 0, 100).'...';
    }

    //category many to many relationship
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    //tags many to many relationship
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }


    //scope
    public function scopeFindSlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
    }



    //scope
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    //scope
    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }



    //global scope
    protected static function booted()
    {
        if (!auth()->check()) {
            static::addGlobalScope('published', function ($query) {
                $query->whereNull('published_at')->orWhere('published_at', '<=', now());
            });
            static::addGlobalScope('active', function ($query) {
                $query->where('is_active', true);
            });
        }

    }

    //static function
    //category
    public static function category($categories)
    {

        $markup = '';

        foreach ($categories as $key => $category) {
            //key even  then add different class for styling purpose
            if($key % 2 == 0){
                $markup .= '<a href="'.route('category', $category->slug).'" tabindex="0"><span class="post-cat text-info text-uppercase">'.$category->name.'</a>';
            }else{
                $markup .= '<a href="'.route('category', $category->slug).'" tabindex="0"><span class="post-cat text-warning text-uppercase">'.$category->name.'</a>';
            }
        }

        return $markup;



    }

}
