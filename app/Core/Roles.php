<?php

namespace App\Core;

class Roles
{
    const FIELD_NAME = 'role_name';
    const FIELD_DISPLAY = 'role_display';

    const ROLE_MASTER       = 1;
    const ROLE_ADMIN        = 2;
    const ROLE_MODERATOR    = 3;
    const ROLE_POSTER       = 4;
    const ROLE_USER         = 5;
    const ROLE_BANNED       = 10;

    /**
     * Get all available user roles
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_MASTER =>    [self::FIELD_NAME => 'master',      self::FIELD_DISPLAY => __('title.role.master')],
            self::ROLE_ADMIN =>     [self::FIELD_NAME => 'admin',       self::FIELD_DISPLAY => __('title.role.admin')],
            self::ROLE_MODERATOR => [self::FIELD_NAME => 'moderator',   self::FIELD_DISPLAY => __('title.role.moderator')],
            self::ROLE_POSTER =>    [self::FIELD_NAME => 'poster',      self::FIELD_DISPLAY => __('title.role.poster')],
            self::ROLE_USER =>      [self::FIELD_NAME => 'user',        self::FIELD_DISPLAY => __('title.role.user')],
            self::ROLE_BANNED =>    [self::FIELD_NAME => 'banned',      self::FIELD_DISPLAY => __('title.role.banned')]
        ];
    }
}