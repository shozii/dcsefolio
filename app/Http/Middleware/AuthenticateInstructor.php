<?php

namespace App\Http\Middleware;

use Closure;

//Auth Facade
use Auth;

class AuthenticateInstructor
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
        //If request does not comes from logged in instructor
       //then he shall be redirected to Instructor Login page
       if (! Auth::guard('web_instructor')->check()) {
           return redirect('/instructor_login');
       }
        return $next($request);
    }
}
