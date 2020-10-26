<?php

namespace App\Http\Middleware;

use Closure;
use Debugbar;
use Illuminate\Http\Request;

class CheckIp
{

    public $whiteIps = ['37.232.8.248','127.0.0.1','212.58.103.231','212.58.102.229','46.49.60.205'];

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if (!in_array($request->ip(), $this->whiteIps)) {

			Debugbar::disable();
             abort(403);
         }

        return $next($request);
    }
}
