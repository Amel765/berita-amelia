<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category_id',
        'user_id',
        'status',
        'published_at'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    // Relationships
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }
}