<?php
namespace App\Http\Requests\Win;

use App\DTO\Win\WinRequestData;
use Illuminate\Foundation\Http\FormRequest;

class WinRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function dto(): WinRequestData
    {
        return new WinRequestData(
            $this->input('user_id'),
        );
    }
}
