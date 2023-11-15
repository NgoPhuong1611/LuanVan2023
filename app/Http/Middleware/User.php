<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class User extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session = session();
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!$session->get('isUserLogin')) {
            return redirect()->to('user/login'); // Chuyển hướng đến trang đăng nhập
        }

        return $next($request);
    }
}
