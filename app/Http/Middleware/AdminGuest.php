<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminGuest
{
  public function handle($request, Closure $next)
{
    if ($request->session()->has('admin_user')) {
        return redirect()->route('admin.dashboard');
    }

    return $next($request);
}

}
