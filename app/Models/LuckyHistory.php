<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $result
 * @property string $win_amount
 * @property int $random_number
 * @property User $user
 */
class LuckyHistory extends Model
{
    protected $table = 'lucky_history';
    protected $fillable = ['user_id', 'random_number', 'result', 'win_amount'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
