<?php

namespace App\Contracts\Services;

interface RolesServiceContract
{
    public function useHasRole(int $userId, string $role): bool;

    public function userIsAdmin(int $userId): bool;
}

