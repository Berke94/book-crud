<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kullanıcının admin olup olmadığını kontrol et
        if (!$request->user() || !$request->user()->is_admin) {
            // Eğer kullanıcı admin değilse, anasayfaya yönlendir
            return redirect('/');
        }

        return $next($request);
    }
}
