<?php
namespace App\Http\Requests\User;

use App\DTO\User\UserRegisterRequestData;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'phone_number' => 'required|integer',
        ];
    }

    public function dto(): UserRegisterRequestData
    {
        return new UserRegisterRequestData(
            $this->input('username'),
            $this->input('phone_number'),
        );
    }
}
