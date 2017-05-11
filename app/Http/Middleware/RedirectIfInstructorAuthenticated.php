<?php

namespace App\Http\Middleware;

use Closure;
//Auth Facade
use Auth;

class RedirectIfInstructorAuthenticated
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
       //If request comes from logged in user, he will
      //be redirect to home page.
      //if (Auth::guard()->check()) {
        //  return redirect('/home');
      //}

      //If request comes from logged in instructor, he will
      //be redirected to instructor's home page.
      if (Auth::guard('web_instructor')->check()) {
          return redirect('/instructor_home');
      }
        return $next($request);
    }
}
