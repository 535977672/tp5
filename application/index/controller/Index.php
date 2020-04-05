<?php
namespace app\index\controller;

use think\Controller;
use app\open\server\AdServer;
use app\common\model\Users;
use app\common\model\Info;
use alipay\Tee;

class Index extends Controller
{
   
   
     public function index(){
         $t = new Tee();
         $rr = $t->tt();
        var_dump($rr);
    }
    
    public function app(){
        $rr = file_get_contents('php://input');
        file_put_contents($rr);
        echo 'SUCCESS';
    }
    
    

}
