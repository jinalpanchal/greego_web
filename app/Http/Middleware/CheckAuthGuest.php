<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthGuest {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $data = $request->session()->all();
        if (@$data['login_driver_id'] || @$data['login_user_id']) {
            return redirect()->route('account.account_dashboard','dashboard');
        } else {
            return $next($request);
        }
    }

}
