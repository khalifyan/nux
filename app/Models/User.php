<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $username
 * @property int $phone_number
 * @property UniqueLink $links
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Model
{
    protected $fillable = ['username', 'phone_number'];

    public function links(): HasMany
    {
        return $this->hasMany(UniqueLink::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(LuckyHistory::class);
    }
}
