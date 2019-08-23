<?php
namespace app\index\controller\tp;

use think\Controller;
use think\Request;
use Closure;

/**
 * 匿名函数、类的循环嵌套
 * 中间件主要用于拦截或过滤应用的HTTP请求，并进行必要的业务处理。
 * 中间件是一个闭包，而且返回一个闭包。中间件为过滤进入应用的HTTP请求提供了一套便利的机制，可以分为前置中间件和后置中间件。
 * 常用于验证用户是否经过认证，添加响应头（跨域），记录请求日志等。
 * index/middleware.php return [app\http\middleware\Check::class];
 */
class Middleware extends Controller
{
    
    public function initialize()
    { 
       
    }
    
    
    public function index(Request $request) {
        //一个中间件
        $middleware1 = function ($request, Closure $next) {
            echo 'middleware1' . '<br />';
            echo $request->get('m', 'm').'<br />';
            $response = $next($request);
            echo 'middleware11' . '<br />';

            return $response;
        };

        $middleware2 = function ($request, Closure $next) {
            echo 'middleware2' . '<br />';
            echo $request->get('m', 'm').'<br />';
            
            //终止执行，不影响外部中间件执行，内部不再执行
            if($request->get('m', 'm') != 10) return false;
            
            $response = $next($request);
            echo 'middleware22' . '<br />';

            return $response;
        };

        $app = function ($request) {
            echo $request->get('m', 'm').'<br />';
            return 'true';
        };

        
        $allMiddleware = [$middleware1, $middleware2];
        //执行是从内部开始，靠后先执行,翻转数组
        $allMiddleware = array_reverse($allMiddleware);
        $next = $app;
        foreach ($allMiddleware as $middleware) {
            $next = function ($request) use ($middleware, $next) {
                return $middleware($request, $next);
            };
        }
        
        $response = $next($request);
        echo $response;
        //middleware2
        //10
        //middleware1
        //10
        //10
        //middleware11
        //middleware22
        //true
    }
    
   
}


