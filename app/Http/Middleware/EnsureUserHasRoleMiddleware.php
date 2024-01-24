<?php

namespace App\Http\Middleware;

use App\Contracts\Services\RolesServiceContract;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRoleMiddleware
{
    public function __construct(
        private readonly RolesServiceContract $rolesService
    )
    {

    }

    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || ! $this->rolesService->useHasRole($request->user()->id, $role)) {
            return abort(403);
        }

        return $next($request);
    }
}
