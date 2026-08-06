<?php

namespace App\Http\Middleware;

use App\Repositories\UserActivityRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->user()) {
            UserActivityRepository::store($request->user()->id, last($request->segments()));
        }

        return $response;
    }
}
