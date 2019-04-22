<?php
namespace app\index\controller;

use think\Controller;
use app\open\server\AdServer;
use app\common\model\Users;
use app\common\model\Info;

class Index extends Controller
{
 
    
    public function index(){
        echo str_repeat(' ', 1024);
		echo date('H:i:s').'<br>';
		echo 'haproxy tp5';
		ob_flush();//冲刷出（送出）输出缓冲区中的内容
		flush();//刷新输出缓冲
		sleep(2);
        
	}
    
   
}
