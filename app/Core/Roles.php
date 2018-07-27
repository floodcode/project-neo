<?php

namespace App\Core;

class Roles
{
    /**
     * All available user roles
     */
    protected static $roles = [
        1 => 'master',
        2 => 'admin',
        3 => 'moderator',
        4 => 'poster',
        5 => 'user'
    ];

    const ROLE_MASTER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_MODERATOR = 3;
    const ROLE_POSTER = 4;
    const ROLE_USER = 5;

    public static function getRoles(): array
    {
        return self::$roles;
    }
}