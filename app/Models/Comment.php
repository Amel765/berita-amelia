<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'news_id',
        'author_name',
        'author_email',
        'content',
        'status',
        'user_id'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Relationships
    public function news()
    {
        return $this->belongsTo(\App\Models\News::class);
    }
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}