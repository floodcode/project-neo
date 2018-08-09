<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Core\Roles;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleName(): string
    {
        $roles = Roles::getRoles();
        return $roles[$this->role][Roles::FIELD_DISPLAY] ?? $roles[Roles::ROLE_USER][Roles::FIELD_DISPLAY];
    }

    /**
     * Returns true if user has specified role or higher
     *
     * @param int $role
     * @return bool
     */
    public function hasRole(int $role)
    {
        if (!is_int($this->role)) {
            return false;
        }

        return $this->role <= $role;
    }

    /**
     * Returns true if user has exact specified role
     *
     * @param int $role
     * @return bool
     */
    public function hasExactRole(int $role)
    {
        if (!is_int($this->role)) {
            return false;
        }

        return $this->role == $role;
    }

    public function hasRoleName(string $roleName)
    {
        $roleMap = [];
        $roles = Roles::getRoles();
        foreach ($roles as $code => $fields) {
            $roleMap[$fields[Roles::FIELD_NAME]] = $code;
        }

        if (!array_key_exists($roleName, $roleMap)) {
            return false;
        }

        return $this->hasRole($roleMap[$roleName]);
    }
}
