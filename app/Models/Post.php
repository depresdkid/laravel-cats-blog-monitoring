<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'blog_id',
        'identifier',
        'title',
        'content',
        'rating',
        'reactions',
    ];

    protected $casts = [
        'blog_id' => 'integer',
        'rating' => 'decimal:2',
        'reactions' => 'array',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
