<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Contracts\Services\RolesServiceContract;
use App\Models\Article;
use App\Models\User;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            $rolesService = app(RolesServiceContract::class);
            return $rolesService->userIsAdmin($user->id);
        });
    }
}
