<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use Exception;
class Img extends Controller
{
    
    public function index()
    { 
      $url = '/static/upload/goods/2018/12-21/1_790_370.jpg';
      //$t = 1;
      for($t=1; $t<7; $t++){
          $url = '/static/upload/goods/2018/12-21/'.$t.'_790_370.jpg';
        $u1 = get_file_path($url, 100, 100, 1, $t);//3
        var_dump($u1);


        $u1 = get_file_path($url, 50, 50, 1, $t);
        var_dump($u1);


        $u1 = get_file_path($url, 100, 200, 1, $t);
        var_dump($u1);

       $u1 = get_file_path($url, 400, 400, 1, $t);
        var_dump($u1);


       $u1 = get_file_path($url, 800, 800, 1, $t);
        var_dump($u1);
      }
    }
   
 
}
