<?php

namespace App\Models\Traits;

use App\Models\User;

trait UserAccess
{
    abstract protected function getAccessRole(): int;

    public function hasAccess(User $user = null): bool
    {
        if ($user === null) {
            return false;
        }

        return $this->user_id == $user->id || $user->hasRole($this->accessRole);
    }
}