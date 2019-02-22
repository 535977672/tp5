<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use Exception;
class s extends Controller
{
    
    public function index()
    { 
        
        var_dump(get_magic_quotes_gpc());
        
        
        
        $re = "wewewqe.wqewqe'eqewqeqw";
        var_dump($re);
        echo $re;
        
        $re = addslashes($re);
        var_dump($re);
        echo $re;
        
        $re = stripslashes($re);
        var_dump($re);
        echo $re;
       //bool(false) string(23) "wewewqe.wqewqe'eqewqeqw" wewewqe.wqewqe'eqewqeqwstring(24) "wewewqe.wqewqe\'eqewqeqw" wewewqe.wqewqe\'eqewqeqwstring(23) "wewewqe.wqewqe'eqewqeqw" wewewqe.wqewqe'eqewqeqw
    }
    
  
}
