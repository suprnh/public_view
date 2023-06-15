<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class IfLoggedIn
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
        $ck = Session::get('is_admin_logged_in');
		if($ck == "yes")
		{
			$response = $next($request);
			return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
			->header('Pragma','no-cache')
			->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
		}
        else
		{
			return redirect()->route('admin-login')->with('errmsg','!!! UnAuthorized Access !!!');
		}
    }
}
