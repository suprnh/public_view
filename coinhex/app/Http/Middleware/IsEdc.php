<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class IsEdc
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
        /*
        $ck = Session::get('is_admin_logged_in');
        if($ck == "yes")
        {
            $user_id = Session::get('userid');
            if(what_my_role($user_id)=='edc'){
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
            }
        }
        else
        {
            return redirect()->route('admin-login')->with('errmsg','!!! UnAuthorized Access !!!');
        }
        */


        $user_id = Session::get('userid');
        $role = what_my_role($user_id);
        if($role=='edc'){
            $response = $next($request);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        } else if($role=='admin') {
            return redirect()->route('admin-dashboard');
        } else if($role=='web_manager'){
            return redirect()->route('webman-dashboard');
        } else {
            return redirect()->route('404');
            //return redirect()->route('home');
        }
        
    }
}
