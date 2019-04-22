<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
class Requests extends Controller
{
    /**
     * 1. 请求信息
     * 如果要获取当前的请求信息，可以使用\think\Request类，
     */
    public function indexPage() {
        $request = Request::instance(); //use think\Request;
        //$request = request();
        //dump($request);
        // 获取当前域名
        echo 'domain: ' . $request->domain() . '<br/>';
        // 获取当前入口文件
        echo 'file: ' . $request->baseFile() . '<br/>';
        // 获取当前URL地址 不含域名
        echo 'url: ' . $request->url() . '<br/>';
        // 获取包含域名的完整URL地址
        echo 'url with domain: ' . $request->url(true) . '<br/>';
        // 获取当前URL地址 不含QUERY_STRING
        echo 'url without query: ' . $request->baseUrl() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的PATH_INFO信息 不含后缀
        echo 'pathinfo: ' . $request->path() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';
        
        echo "当前模块名称是" . $request->module(). '<br/>';
        echo "当前控制器名称是" . $request->controller(). '<br/>';
        echo "当前操作名称是" . $request->action(). '<br/>';
        
        
        echo '请求方法：' . $request->method() . '<br/>';
        echo '资源类型：' . $request->type() . '<br/>';
        echo '访问ip地址：' . $request->ip() . '<br/>';
        echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br/>';
        echo '请求参数：';
        dump($request->param());
        echo '请求参数：仅包含name';
        dump($request->only(['name']));
        echo '请求参数：排除name';
        dump($request->except(['name']));
        
        
        echo '路由信息：';
        dump($request->route());
        echo '调度信息：';
        dump($request->dispatch());
    }
    
    /**
     * 2.输入变量
     * 可以通过Request对象完成全局输入变量的检测、获取和安全过滤，支持包括$_GET、$_POST、$_REQUEST、$_SERVER、$_SESSION、$_COOKIE、$_ENV等系统变量，以及文件上传信息。
     */
    public function vPage() {
        $request = Request::instance();
        
        var_dump($request->has('name', 'get'));
        var_dump(input('?get.id'));//input函数默认就采用PARAM变量读取方式。
        
        //param	获取当前请求的变量
        //get	获取 $_GET 变量
        //post	获取 $_POST 变量
        //put	获取 PUT 变量
        //delete	获取 DELETE 变量
        //session	获取 $_SESSION 变量
        //cookie	获取 $_COOKIE 变量
        //request	获取 $_REQUEST 变量
        //server	获取 $_SERVER 变量
        //env	获取 $_ENV 变量
        //route	获取 路由（包括PATHINFO） 变量
        //file	获取 $_FILES 变量  
        var_dump($request->param());
        var_dump($request->param('id'));
        
        
        var_dump($request->get());
        var_dump($request->get('id'));
        var_dump(input('get.id'));
        var_dump(input('get.name'));
        var_dump(input('get.'));
        
        //变量过滤
        var_dump($request->filter('htmlspecialchars'));
        var_dump($request->param('id', '', 'htmlspecialchars'));
        
        //获取部分变量
        var_dump($request->only(array('id')));
        var_dump($request->only(array('id'), 'get'));
        //排除部分变量
        var_dump($request->except(array('id'), 'get'));
        
        //变量修饰符input('变量类型.变量名/修饰符'); Request::instance()->变量类型('变量名/修饰符');
        //修饰符	作用
        //s	强制转换为字符串类型
        //d	强制转换为整型类型
        //b	强制转换为布尔类型
        //a	强制转换为数组类型
        //f	强制转换为浮点类型
        var_dump($request->get('id/s'));
        
        //获取请求类型
        if (Request::instance()->isGet()) echo "当前为 GET 请求";
        if (request()->isGet()) echo "当前为 GET 请求";
        
    }
}
