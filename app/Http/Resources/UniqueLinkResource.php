<?php
namespace App\Http\Resources;

use App\Models\UniqueLink;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UniqueLink
 */
class UniqueLinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'link' => $this->link,
            'user' => $this->user->username,
            'user_id' => $this->user_id,
        ];
    }
}
