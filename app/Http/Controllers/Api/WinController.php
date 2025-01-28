<?php

namespace App\Http\Controllers\Api;


use App\Action\Win\LuckyAction;
use App\Action\Win\LuckyHistoryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Win\WinRequest;
use App\Http\Resources\LuckyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WinController extends Controller
{
    public function lucky(LuckyAction $action, WinRequest $request): LuckyResource
    {
        return new LuckyResource($action->execute($request->dto()));
    }

    public function history(LuckyHistoryAction $action, WinRequest $request): AnonymousResourceCollection
    {
        return LuckyResource::collection($action->execute($request->dto()));
    }
}
