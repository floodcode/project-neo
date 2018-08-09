<?php

namespace App\Models\Traits;

use App\Core\Roles;
use App\Models\User;

trait HasUser
{
    /**
     * Defines role starting from which user has full access over entities with given type
     */
    protected function getSupperRole(): int
    {
        return Roles::ROLE_MASTER;
    }

    /**
     * Defines role which can modify given entity created by other users
     */
    protected function getAccessRole(): int
    {
        return Roles::ROLE_ADMIN;
    }

    /**
     * Defines role which entities can't be modified by user with access role.
     * Entities of users with higher role will be protected too.
     */
    protected function getProtectedRole(): int
    {
        return Roles::ROLE_ADMIN;
    }

    final public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    final public function hasAccess(?User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        if ($user->role <= $this->getSupperRole()) {
            return true;
        }

        $entityUser = $this->user;
        if ($entityUser->id == $user->id) {
            return true;
        }

        if ($entityUser->role <= $this->getProtectedRole()) {
            return false;
        }

        return $user->hasRole($this->getAccessRole());
    }
}