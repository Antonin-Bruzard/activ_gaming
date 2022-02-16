<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Traits\HasRoles;

class Authorization
{
    use HasRoles;

    public $request;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$authorizationsAsked)
    {

        /**
         * Prevent from non authenticate users.
         */
        if (!auth()->check()) {
            return response('Unauthorized', 401);
        }

        $user = auth()->user();

        if ($user->hasAllPermissions($authorizationsAsked)) {
            return $next($request);
        }

        if ($user->hasAllRoles($authorizationsAsked)) {
            return $next($request);
        }

        return response('Unauthorized', 401);

    }
}
