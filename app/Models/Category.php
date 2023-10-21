<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'parent_id'
    ];

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }



    public function scopeMain($query)
    {
        return $query->where('parent_id', null);
    }

    //global scope
    protected static function booted()
    {
        if (!auth()->check()) {
            static::addGlobalScope('active', function ($query) {
                $query->where('is_active', true);
            });
        }
    }
}
