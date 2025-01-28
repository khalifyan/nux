<?php

namespace App\Http\Controllers\Api;


use App\Action\UniqueLink\DeactivateLinkAction;
use App\Action\UniqueLink\UniqueLinkGenerateAction;
use App\Action\UniqueLink\UniqueLinkViewAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UniqueLink\UniqueLinkGenerateRequest;
use App\Http\Resources\UniqueLinkResource;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    public function view(UniqueLinkViewAction $action, string $link): UniqueLinkResource
    {
        return new UniqueLinkResource($action->execute($link));
    }

    public function generate(UniqueLinkGenerateAction $action, UniqueLinkGenerateRequest $request): UniqueLinkResource
    {
       return new UniqueLinkResource($action->execute($request->dto()));
    }

    public function deactivate(DeactivateLinkAction $action, string $link): Response
    {
        $action->execute($link);

        return response()->noContent();
    }
}
