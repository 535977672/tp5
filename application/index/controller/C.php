<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use Exception;
use think\facade\Cache;

class c extends Controller
{
    
    public function index()
    { 
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
        $re = Db::name('info')->field('id,title')->cache('user_data')->update(['id'=>68,'title'=>'thinkphp']);
        var_dump($re);
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
    }
    
    
     //失败
    public function index2()
    { 
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
    }
    //失败
     public function index3()
    { 
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
        $re = Db::name('info')->field('id,title')->update(['id'=>68,'title'=>'thi3232323']);
        var_dump($re);
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
    }
    
     
    public function index4()
    { 
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
        $re = Db::name('info')->field('id,title,contebt')->cache('user_data')->update(['id'=>68,'title'=>'thinkphpddddddddd']);
        var_dump($re);
        $re = Db::name('info')->field('id,title')->cache('user_data')->select();
        var_dump($re);
    }
    
    
    public function caches() {
        $handler = Cache::store('redis')->handler();
        //$handler = new \Redis();
        $handler->hSet('file1', 'dwew', 2323);
        $handler->hSet('file1', 'dfdf', 23423);
        $handler->hSet('file1', 'bgn', 676);
        $handler->hSet('file1', 'lio', 980);
        $handler->hSet('file1', '/rrtert/trytyrty/tytryrt/yrtuyyutyu/huh.uyiuyi', 980);
        
        
        $r = $handler->hGet('file1', 'lio');var_dump($r);
        
        $r = $handler->hDel('file1', 'lio');
        
        $r = $handler->hKeys('file1');
        var_dump($r);
    }
}
