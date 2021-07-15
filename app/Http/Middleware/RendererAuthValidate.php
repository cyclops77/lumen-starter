<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;
use \App\Models\User;
use Closure;

class RendererAuthValidate
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
        $fetchHeader = $request->header('Authorization');
        $header = str_replace('Render-App ', '', $fetchHeader);
        $token = User::where('token_auth',$header)->first();
        if (!$token) {
            return Response([
                'status' => 'error',
                'message' => 'Please login again !',
            ], 401);
        }
        return $next($request);
    }
}
