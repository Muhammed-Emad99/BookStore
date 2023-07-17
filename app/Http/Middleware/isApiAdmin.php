<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isApiAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset($request->access_token) && $request->access_token != null){
            $user = User::where('access_token',$request->access_token)->where('is_admin',1)->first();
            return $next($request);
        }else{
            return response()->json(['error' =>'not allowed to access this link']);
        }
    }
}
