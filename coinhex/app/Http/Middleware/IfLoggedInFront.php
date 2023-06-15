<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use DB;

class IfLoggedInFront
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
		$frontend_userid = Session::get('frontend_userid');
		if($frontend_userid > 0){
			$users = DB::table('users')->where(array('ID' => trim($frontend_userid)))->first();
			if(empty($users)){
				Session::flush();
			}
		}
		
        $ck = Session::get('is_frontend_user_logged_in');
		if($ck == "yes")
		{
			$response = $next($request);
			return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
			->header('Pragma','no-cache')
			->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
		}
        else
		{
			return redirect()->route('login')->with('message','!!! UnAuthorized Access !!!');
		}
    }
}
