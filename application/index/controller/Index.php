<?php
namespace app\index\controller;

use think\Controller;
use app\open\server\AdServer;
use app\common\model\Users;
use app\common\model\Info;

class Index extends Controller
{
   
     public function jsons(){
         $fd = '["fdfdf\/dgfgdf\/fgfdgfd.png","fdfdf\/dgfgdf\/fgfdgfd.png","fdfdf\/dgfgdf\/fgfdgfd.png"]';
         //$fd = "['fdfdf\/dgfgdf\/fgfdgfd.png','fdfdf\/dgfgdf\/fgfdgfd.png','fdfdf\/dgfgdf\/fgfdgfd.png']";
        $r = json_decode($fd, true);
        var_dump($r);
        
        
    }
    
    public function t(){
        $t = time();
        $params = [
            'appid'=>18325048987,
            'appsecret'=>'ba9ff6b3af0f1e693a6a4c4949fb419d',
            'timestamp'=>$t,
            'version' => 'v1',
            'controller' => 'token',
            'action' => 'token'
        ];
        ksort($params);
        $params['key'] = 'ba9ff6b3af0f1e693a6a4c4949fb419d';
        echo strtolower(md5(urldecode(http_build_query($params)))).' '.$t;
        
        
        /*
  {
  "status": 200,
  "message": "success",
  "data": {
    "access_token": "VoDzrj7mx1Gla8Ps2C9g3iyQE75d4WBp",
    "expires_time": 1548571978,
    "client": {
      "uid": "64",
      "appid": "18325048987",
      "appsecret": "ba9ff6b3af0f1e693a6a4c4949fb419d",
      "timestamp": "1545979845",
      "sign": "934236c0d92087cfe05185e2e304312c",
      "controller": "token",
      "action": "token"
    }
  }
}
         */
    }
    
     public function t2(){
        $r = base64_encode('64:18325048987:VoDzrj7mx1Gla8Ps2C9g3iyQE75d4WBp');
        echo 'Basic '.$r;//Basic NjQ6MTgzMjUwNDg5ODc6Vm9EenJqN214MUdsYThQczJDOWczaXlRRTc1ZDRXQnA=
        
        
    }
    
     public function t3(){
        $t = time();
        $params = [
            'appid'=>18325048987,
            'appsecret'=>'ba9ff6b3af0f1e693a6a4c4949fb419d',
            'timestamp'=>$t,
            'version' => 'v1',
            'controller' => 'token',
            'action' => 'token'
        ];
        ksort($params);
        $params['key'] = 'ba9ff6b3af0f1e693a6a4c4949fb419d';
        $s = strtolower(md5(urldecode(http_build_query($params))));
         
        $data = [
            'appid'=>18325048987,
            'appsecret'=>'ba9ff6b3af0f1e693a6a4c4949fb419d',
            'timestamp'=>$t,
            'sign' => $s,
        ];
       // $url = 'http://api-h5.gebodata.com/v1/token/token';
         $url = 'http://test.nfc.com/v1/token/token';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $header = array('Content-Type: application/x-www-form-urlencoded','accept: application/json', 'version: v1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, null, '&'));
        $ret = curl_exec($ch);

        //echo $functionName . " : Request Info : url: " . $url . " ,send data: " . $data . "  \n";
        //echo $functionName . " : Respnse Info : " . $ret . "  \n";
        curl_close($ch);
        $rr = json_decode($ret, true);
        var_dump($rr);
        
        echo  'Basic '.base64_encode('65:18325048987:'.$rr['data']['access_token']);
    }
    
    
   
}
