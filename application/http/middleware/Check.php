<?php

namespace app\http\middleware;

class Check
{
    //\Closure匿名函数类
    public function handle($request, \Closure $next)
    {
        if ($request->param('name') == 'think') {
            //return redirect('index/think');
        }
        return $next($request);
    }
}
