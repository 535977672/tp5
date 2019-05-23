<?php
namespace app\index\controller;

use think\Controller;
use app\open\server\AdServer;
use app\common\model\Users;
use app\common\model\Info;

class Index extends Controller
{
   
   
     public function api(){
        $t = time();
        $params = [
            'appid'=>18325048987,
            'appsecret'=>'2dc95bfa34d40f20b94296f3c291c645',
            'timestamp'=>$t,
            'version' => 'v1',
            'controller' => 'token',
            'action' => 'token'
        ];
        ksort($params);
        $params['key'] = '2dc95bfa34d40f20b94296f3c291c645';
        $s = strtolower(md5(urldecode(http_build_query($params))));
         
        $data = [
            'appid'=>18325048987,
            'appsecret'=>'2dc95bfa34d40f20b94296f3c291c645',
            'timestamp'=>$t,
            'sign' => $s,
        ];
        //$url = 'http://api-h5.gebodata.com/v1/token/token';
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
        
        echo  'Basic '.base64_encode('94:18325048987:'.$rr['data']['access_token']);
    }
    
    public function apis(){
        $t = time();
        $params = [
            'appid'=>18325048987,
            'appsecret'=>'2dc95bfa34d40f20b94296f3c291c645',
            'timestamp'=>$t,
            'version' => 'v1',
            'controller' => 'token',
            'action' => 'token'
        ];
        ksort($params);
        $params['key'] = '2dc95bfa34d40f20b94296f3c291c645';
        $s = strtolower(md5(urldecode(http_build_query($params))));
         
        $data = [
            'appid'=>18325048987,
            'appsecret'=>'2dc95bfa34d40f20b94296f3c291c645',
            'timestamp'=>$t,
            'sign' => $s,
        ];
        $url = 'http://api-h5.gebodata.com/v1/token/token';
         //$url = 'http://test.nfc.com/v1/token/token';
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
        
        echo  'Basic '.base64_encode('94:18325048987:'.$rr['data']['access_token']);
    }
    
    
   public function hcb(){
        $t = time();
        $params = [
            'name'=>18325048987,
            'password'=>'2dc95bfa34d40f20b94296f3c291c645',
        ];
       //$url = 'http://api-h5.gebodata.com/hcb/h5/users/login';$id=133;
        $url = 'http://test.nfc.com/hcb/app/users/login';$id=94;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $header = array('Content-Type: application/x-www-form-urlencoded','accept: application/json', 'version: v1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, null, '&'));
        $ret = curl_exec($ch);

        //echo $functionName . " : Request Info : url: " . $url . " ,send data: " . $data . "  \n";
        //echo $functionName . " : Respnse Info : " . $ret . "  \n";
        curl_close($ch);var_dump($ret);
        $rr = json_decode($ret, true);
        var_dump($rr);
        
        echo  'Banaer '.base64_encode(time() .':T03:13:'.$id.':'.$rr['data']['access_token']);
        echo '<br/>';
        echo  'Banaer '.time() .':'.$id.':T03:13:'.$rr['data']['access_token'];
    }
    
    public function hcbs(){
        $t = time();
        $params = [
            'name'=>18325048987,
            'password'=>'2dc95bfa34d40f20b94296f3c291c645',
        ];
       $url = 'http://api-h5.gebodata.com/hcb/app/users/login';$id=133;
        // $url = 'http://test.nfc.com/hcb/h5/users/login';$id=94;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $header = array('Content-Type: application/x-www-form-urlencoded','accept: application/json', 'version: v1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, null, '&'));
        $ret = curl_exec($ch);

        //echo $functionName . " : Request Info : url: " . $url . " ,send data: " . $data . "  \n";
        //echo $functionName . " : Respnse Info : " . $ret . "  \n";
        curl_close($ch);
        $rr = json_decode($ret, true);
        var_dump($rr);
        
        echo  'Banaer '.base64_encode(time() .':T03:13:'.$id.':'.$rr['data']['access_token']);
        echo '<br/>';
        echo  'Banaer '.time() .':'.$id.':T03:13:'.$rr['data']['access_token'];
    }
    
    
    
    public function hcbs2(){
        $t = time();
        $params = [
            'name'=>13641677914,
            'password'=>'b8a1099b57fb53d28fba7d5717e317ea',
        ];
       $url = 'http://api-h5.gebodata.com/hcb/app/users/login';$id=140;
        // $url = 'http://test.nfc.com/hcb/h5/users/login';$id=94;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $header = array('Content-Type: application/x-www-form-urlencoded','accept: application/json', 'version: v1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, null, '&'));
        $ret = curl_exec($ch);

        //echo $functionName . " : Request Info : url: " . $url . " ,send data: " . $data . "  \n";
        //echo $functionName . " : Respnse Info : " . $ret . "  \n";
        curl_close($ch);
        $rr = json_decode($ret, true);
        var_dump($rr);
        
        echo  'Banaer '.base64_encode(time() .':T03:13:'.$id.':'.$rr['data']['access_token']);
        echo '<br/>';
        echo  'Banaer '.time() .':'.$id.':T03:13:'.$rr['data']['access_token'];
    }
    
    
    
    
    public function hcbapps(){
        $t = time();
        $params = [
            'name'=>19942268205,
            'password'=>'b8a1099b57fb53d28fba7d5717e317ea',
        ];
       $url = 'http://api-h5.gebodata.com/hcb/app/users/login';$id=7;
        // $url = 'http://test.nfc.com/hcb/h5/users/login';$id=94;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $header = array('Content-Type: application/x-www-form-urlencoded','accept: application/json', 'version: v1');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, null, '&'));
        $ret = curl_exec($ch);

        //echo $functionName . " : Request Info : url: " . $url . " ,send data: " . $data . "  \n";
        //echo $functionName . " : Respnse Info : " . $ret . "  \n";
        curl_close($ch);
        $rr = json_decode($ret, true);
        var_dump($rr);
        
        echo  'Banaer '.base64_encode(time() .':'.$id.':'.$rr['data']['access_token']);
        echo '<br/>';
        echo  'Banaer '.time() .':'.$id.':'.$rr['data']['access_token'];
    }
}
