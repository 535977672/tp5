<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Log;
Log::init(['path' => '../runtime/wxpay_logs/']);
class Logt extends Controller
{
    
    public function index()
    { 
        
        Log::write('tyu44444444444fddddddddddddddyfdfdtuy');
  
        Log::write('wx支付日志');
      
    }
    
  
}
