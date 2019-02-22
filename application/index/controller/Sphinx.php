<?php
namespace app\index\controller;
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
use think\Controller;
//require_once 'E:\sphinx\api\sphinxapi.php';//不要加载.dll
require 'sphinxapi.php';


/**
 * 该扩展提供了针对Sphinx搜索客户端开发库的绑定. 
 * Sphinx是一个独立的搜索引擎系统，其目的是为其他相关程序和应用提供快速的、规模可扩展的全文搜索功能. 
 * Sphinx有着良好的设计，可以很方便的与SQL数据库结合，并使用脚本语言调用. 
 */
class Sphinx extends Controller
{
    
    public function initialize()
    { 
       
    }
    
    
    public function index() {
        
        
        $s = new SphinxClient();
        $s->setServer("localhost", 9312);
        $s->setMatchMode(SPH_MATCH_ANY);
        $s->setMaxQueryTime(3);

        $result = $s->query("蘑菇", "*");

        var_dump($result);
    }
    
   
}


