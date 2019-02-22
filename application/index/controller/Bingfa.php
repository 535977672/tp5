<?php
namespace app\index\controller;
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
use think\Controller;
use think\Db;

/**
 * ab.exe 压力测试
 * 1、  进入CMD，转到apache的bin目录下。
 * 2、  执行命令ab.exe  -n 访问的问次数–c 多少人访问（并发量） 访问的地址如：
 *  ab.exe –n 1000 –c 100 http://test.pcnfc.com/index/bingfa/index.html
 * 
 * apache在windows下默认的最大并发访问量为150。我们可以设置conf\extra下的httpd-mpm.conf文件来修改它的最大并发数
 */
class Bingfa extends Controller
{
    
    public function initialize()
    { 
       
    }
    
    
    public function index() {
        $time = time();
        Db::name('bingfa')->insert(['name'=>'thinkphp' . $time, 'time' => $time]);
    }
    
   
}


