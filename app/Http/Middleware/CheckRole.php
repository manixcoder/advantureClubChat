<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Comapny;
use App\Employee;
use Session;
use DB;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->users_role == 1) {
            /*die('hello');*/
            $odata = Auth::user();            
            if ($odata) {
                Session::put('user_id',$odata->id);
                Session::put('userRole',Auth::user()->users_role);
            }else {
                Session::put('user_id',1);
            }  
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->users_role == 2){
            $odata = Auth::user();
            if ($odata) {
                Session::put('user_id', $odata->id);
                Session::put('userRole', Auth::user()->users_role);
            }
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->users_role == 3) {
            $odata = Auth::user();
            if ($odata) {
                Session::put('user_id', $odata->id);
                Session::put('userRole', Auth::user()->users_role);
            }
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
