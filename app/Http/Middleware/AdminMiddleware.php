<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin_Model;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!session()->has('auth_token')) {
            return redirect()->route('admin.home');
        }


        $admin = Admin_Model::where('auth_token', session('auth_token'))->first();


        if (!$admin) {
            return redirect()->route('admin.home');
        }


        return $next($request);

    }


}
