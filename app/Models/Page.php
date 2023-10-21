<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active'
    ];

    //scope
    public function scopeFindSlug($query, $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
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
