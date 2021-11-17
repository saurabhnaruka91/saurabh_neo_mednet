<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class IsSalesManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id == Role::SALES_MANAGER || auth()->user()->role_id == Role::SUPER_ADMIN) {
            return $next($request);
        }
        return redirect('login')->with('error', "You don't have required access to view this page.");
    }
}
