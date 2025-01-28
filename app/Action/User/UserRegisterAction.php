<?php

namespace App\Action\User;

use App\Action\UniqueLink\UniqueLinkGenerateAction;
use App\DTO\UniqueLink\UniqueLinkGenerateRequestData;
use App\DTO\User\UserRegisterRequestData;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;

readonly class UserRegisterAction
{
    public function __construct(
        private UserRepository $userRepository,
        private UniqueLinkGenerateAction $uniqueLinkGenerateAction,
    ) { }

    public function execute(UserRegisterRequestData $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = $this->userRepository->create([
                'username' => $data->username,
                'phone_number' => $data->phoneNumber
            ]);

            $this->uniqueLinkGenerateAction->execute(new UniqueLinkGenerateRequestData($user->id));

            return $user;
        });
    }
}
