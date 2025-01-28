<?php
namespace App\Http\Resources;

use App\Models\LuckyHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin LuckyHistory
 */
class LuckyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'result' => $this->result,
            'random_number' => $this->random_number,
            'win_amount' => $this->win_amount,
            'user' => $this->user->username,
        ];
    }
}
