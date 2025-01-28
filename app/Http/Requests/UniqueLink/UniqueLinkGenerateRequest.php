<?php
namespace App\Http\Requests\UniqueLink;

use App\DTO\UniqueLink\UniqueLinkGenerateRequestData;
use Illuminate\Foundation\Http\FormRequest;

class UniqueLinkGenerateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function dto(): UniqueLinkGenerateRequestData
    {
        return new UniqueLinkGenerateRequestData(
            $this->input('user_id'),
        );
    }
}
