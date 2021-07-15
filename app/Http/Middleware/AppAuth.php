<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;
use \App\Models\AppKey;
use Closure;

class AppAuth
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
        $fetchHeader = $request->header('Access-Control-Request-Headers');
        $header = str_replace('Lumen-App ', '', $fetchHeader);

        $appKey = AppKey::where('app_code',$header)->first();
        if (!$appKey) {
            return Response([
                'status' => 'error',
                'message' => "couldn't find your application key",
            ], 401);
        }
        return $next($request);
    }
}
