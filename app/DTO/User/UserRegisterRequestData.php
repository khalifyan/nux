<?php
namespace App\DTO\User;

class UserRegisterRequestData
{
    public function __construct(
        public string $username,
        public string $phoneNumber,
    ) { }
}
