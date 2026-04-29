<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    protected $fillable = [
        'resource_id',
        'identifier',
        'cat_name',
        'rating',
        'check_interval',
        'last_sync_at',
    ];

    protected $casts = [
        'resource_id' => 'integer',
        'rating' => 'decimal:2',
        'check_interval' => 'integer',
        'last_sync_at' => 'datetime',
    ];

    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
