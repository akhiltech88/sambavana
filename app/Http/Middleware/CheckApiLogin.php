<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiLogin
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
       if ( $request->header('access_token') ) {
            $user = User::whereApiToken($request->header('access_token'))
                    ->get();
            if ( !($user->isEmpty()) ) {
                return $next($request);
            }
        }
        $response = array(
            'success' => false,
            'code' => 401,
            'message' => 'You are not authorised to access this page',
            'data' => ''
        );
        return response($response, 200);
    }
}
