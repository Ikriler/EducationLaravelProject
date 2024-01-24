<?php

namespace App\Policies;

use App\Contracts\Services\RolesServiceContract;
use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function __construct(
        private readonly RolesServiceContract $rolesService
    )
    {

    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->rolesService->userIsAdmin($user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->rolesService->userIsAdmin($user->id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        return $this->rolesService->userIsAdmin($user->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        return $this->rolesService->userIsAdmin($user->id);
    }

}
