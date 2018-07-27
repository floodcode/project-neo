<?php

namespace App\Http\Middleware;

use App\Core\Roles;
use Closure;

class UserRole
{
    /**
     * Role name to role code mapping
     */
    protected $roleNameMap = [];

    public function __construct()
    {
        $roles = Roles::getRoles();
        foreach ($roles as $roleCode => $roleName)
        {
            $this->roleNameMap[$roleName] = $roleCode;
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $roleName
     * @return mixed
     */
    public function handle($request, Closure $next, string $roleName)
    {
        $user = $request->user();
        if (!$user) {
            return redirect(route('login'));
        }

        if (!$user->hasRoleName($roleName)) {
            return abort(404);
        }


        if (!array_key_exists($roleName, $this->roleNameMap)) {
            return abort(404);
        }

        $roleCode = $this->roleNameMap[$roleName];
        if (!$user->hasRole($roleCode)) {
            return abort(404);
        }

        return $next($request);
    }
}
