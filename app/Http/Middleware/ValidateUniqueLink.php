<?php

namespace App\Http\Middleware;

use App\Models\UniqueLink;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ValidateUniqueLink
{

    /**
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $link = $request->route('link');

        $uniqueLink =  UniqueLink::query()->where('link', $link)->first();

        if (!$uniqueLink || !$uniqueLink->isValid()) {
            return response()->json(['error' => 'Link is invalid or expired'], 403);
        }

        $request->attributes->set('uniqueLink', $uniqueLink);

        return $next($request);
    }
}
