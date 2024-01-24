<?php

namespace App\Http\Middleware;

use App\Contracts\Services\RolesServiceContract;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function __construct(
        private readonly RolesServiceContract $rolesService
    )
    {

    }

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $this->rolesService->userIsAdmin($request->user()->id)) {
            return abort(403);
        }

        return $next($request);
    }
}
