<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Admin
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
        if ($request->session()->has('admin_email')) {
            return $next($request);
        }else{
            return redirect('admin');
        }        
    }
    protected $except = [
        'admin/user/',
        'admin/driver/',
//        'http://example.com/foo/bar',
//        'http://example.com/foo/*',
    ];
}
