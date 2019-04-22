<?php
namespace app\index\controller;

use think\Controller;
use \PDO;
class Mycat extends Controller
{
    public function index()
    { 
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
        $conn = new PDO("mysql:host=127.0.0.1:8066;dbname=mycat", 'root', 'root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        
        $n = 1000000;
        for($i = 0; $i < $n; $i++){
            $v = $i+1;
            $sql = "INSERT INTO `cai` (`num` , `n`) VALUES ($v, $v)";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }    
        echo '<script language=JavaScript> location.replace(location.href);</script>';
    }
    
    public function index2()
    { 
       echo 'qwqw';
    }
   
}