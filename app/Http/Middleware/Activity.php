<?php

namespace App\Http\Middleware;

use Closure;

class Activity
{
    /**
     * 学习请求中间件，前置操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (time() < strtotime('2017-10-1')) {
            return redirect('activity0');
        }
        return $next($request);
    }

 
}
