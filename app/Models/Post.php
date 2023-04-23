<?php

namespace App\Models;

use App\Models\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'active',
        'user_id',
        'category_id',
        'image',
        'title',
        'body',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new UserIdScope);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
