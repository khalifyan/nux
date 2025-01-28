<?php

namespace App\Http\Controllers\Api;


use App\Action\User\UserRegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function register(UserRegisterAction $action, UserRegisterRequest $request): UserResource
    {
        return new UserResource($action->execute($request->dto()));
    }
}
