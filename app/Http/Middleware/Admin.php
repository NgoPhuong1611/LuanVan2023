<?php

namespace App\Http\Middleware;
use Closure;

class Admin
{
    /**
     * Xử lý một request đến.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->get('isAdminLogin')) {
            return redirect()->to(route('admin-login'));
        }

        return $next($request);
    }
}
