<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $vet = $request->route('vet');

        if($vet==null){
            return response()->json(['message'=>'The VetProfile cannot be found'], 404);
        }

        if($vet->user_id != auth()->user()->id) {
            return response()->json(['message'=>'You are not the owner of this VetProfile.'],401);
        }
        return $next($request);
    }
}
