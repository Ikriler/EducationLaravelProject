<?php

namespace App\Repositories;

use App\Contracts\Repositories\RolesRepositoryContract;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class RolesRepository implements RolesRepositoryContract
{
    public function __construct(
        private readonly Role $role
    )
    {

    }

    public function hasRole(int $userId, string $role): bool
    {
        return $this->getModel()
            ->whereHas('users', fn (Builder $query) => $query->where('id', $userId))
            ->where('name', $role)
            ->exists()
        ;
    }

    private function getModel(): Role
    {
        return $this->role;
    }
}

