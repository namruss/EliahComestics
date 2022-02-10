<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Route;

class checkCustomerLogin
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
       // if user logined
       if (Auth::check())
       {
           $user = Auth::user();
           if ($user->user_status == 1 )
           {
               return $next($request);
           }
           else
           {
               Auth::logout();
               return redirect()->route('customer.login')->with('error','You are not authorized to access');
           }
       }
     if (Route::currentRouteName()=='wishlist.add') {
        return response()->json([
            'message_alert' => 'You must be logged in to add your favorite product!',
            'title'=>'error'
        ]);
     }
       return redirect()->route('customer.login')->with('error','You must be login');
    }
}
