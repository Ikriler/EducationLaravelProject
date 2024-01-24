<?php

namespace App\Contracts\Repositories;

interface RolesRepositoryContract
{
    public function hasRole(int $userId, string $role): bool;
}
