<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $expires_at
 * @property string $link
 * @property bool $is_active
 * @property User $user
 */
class UniqueLink extends Model
{
    protected $fillable = ['user_id', 'link', 'expires_at', 'is_active'];

    protected $hidden = ['pivot', 'created_at', 'updated_at'];
    public function isValid(): bool
    {
        return $this->is_active && now()->lessThanOrEqualTo($this->expires_at);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
