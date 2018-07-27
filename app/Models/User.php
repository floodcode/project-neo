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

    /**
     * Returns true if user has specified role
     *
     * @param int $role
     * @return bool
     */
    public function hasRole(int $role)
    {
        if (!is_int($this->role)) {
            return $false;
        }

        return $this->role <= $role;
    }

    public function hasRoleName(string $roleName)
    {
        $roleMap = [];
        $roles = Roles::getRoles();
        foreach ($roles as $code => $name) {
            $roleMap[$name] = $code;
        }

        if (!array_key_exists($roleName, $roleMap)) {
            return false;
        }

        return $this->hasRole($roleMap[$roleName]);
    }
}
