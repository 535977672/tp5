<?php

set_time_limit(0);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
$n = 1;
for($i = 0; $i < $n; $i++){
    
    //ignore_user_abort(true);//关掉浏览器，PHP脚本也可以继续执行.
    
    
    $url = [
        'https://blog.csdn.net/u012467744/article/details/88733890',
        'https://blog.csdn.net/u012467744/article/details/88688534',
        'https://blog.csdn.net/u012467744/article/details/87784182',
        'https://blog.csdn.net/u012467744/article/details/87782316',
        'https://blog.csdn.net/u012467744/article/details/87837771',
        'https://blog.csdn.net/u012467744/article/details/87837755',
        'https://blog.csdn.net/u012467744/article/details/87837765',
        'https://blog.csdn.net/u012467744/article/details/88746402'
        ];
    doCurlGetRequest($url[array_rand($url)]);
    $t = mt_rand(5,20);
    sleep($t);
    
    echo '<script language=JavaScript> location.replace(location.href);</script>';
    
    //echo str_repeat(' ', 1024);
    //echo $i.'-'.date('H:i:s').'<br>';
    //ob_flush();//冲刷出（送出）输出缓冲区中的内容
    //flush();//刷新输出缓冲

}
//ob_end_flush();//冲刷出（送出）输出缓冲区内容并关闭缓冲 销毁缓冲区

/**
 * 封闭curl的调用接口，get的请求方式。
 */
function doCurlGetRequest($url,$requestString = '',$timeout = 5){
    if(empty($url)|| empty($timeout)){
       return false;
    }
    if(is_array($requestString)){
        $requestString = http_build_query($requestString);
    }
    if($requestString){
        $url = $url.'?'.$requestString;//拼装GET请求和数据部分
    }
    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
    
    curl_setopt($con, CURLOPT_SSL_VERIFYPEER, 0);
    
    $ip = get_rand_ip();
    
    curl_setopt($con, CURLOPT_HTTPHEADER, array("X-FORWARDED-FOR:$ip", "CLIENT-IP:$ip")); //构造IP
    curl_setopt($con, CURLOPT_USERAGENT, get_rand_agent()); //模拟常用浏览器的useragent
    
    curl_setopt($con, CURLOPT_TIMEOUT, (int)$timeout);//允许 cURL 函数执行的最长秒数。
    $output = curl_exec($con);
    curl_close($con);
    return $output;
}

function get_rand_ip(){
  $arr_1 = array("218","218","66","66","218","218","60","60","202","204","66","66","66","59","61","60","222","221","66","59","60","60","66","218","218","62","63","64","66","66","122","211");
  $randarr= mt_rand(0,count($arr_1)-1);
  $ip1id = $arr_1[$randarr];
  $ip2id=  round(rand(600000,  2550000)  /  10000);
  $ip3id=  round(rand(600000,  2550000)  /  10000);
  $ip4id=  round(rand(600000,  2550000)  /  10000);
  return  $ip1id . "." . $ip2id . "." . $ip3id . "." . $ip4id;
}

function get_rand_agent(){
    $agentarry=[
        //PC端的UserAgent
        "safari 5.1 – MAC"=>"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11",
        "safari 5.1 – Windows"=>"Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50",
        "Firefox 38esr"=>"Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0",
        "IE 11"=>"Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; .NET4.0C; .NET4.0E; .NET CLR 2.0.50727; .NET CLR 3.0.30729; .NET CLR 3.5.30729; InfoPath.3; rv:11.0) like Gecko",
        "IE 9.0"=>"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0",
        "IE 8.0"=>"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)",
        "IE 7.0"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)",
        "IE 6.0"=>"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)",
        "Firefox 4.0.1 – MAC"=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
        "Firefox 4.0.1 – Windows"=>"Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
        "Opera 11.11 – MAC"=>"Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; en) Presto/2.8.131 Version/11.11",
        "Opera 11.11 – Windows"=>"Opera/9.80 (Windows NT 6.1; U; en) Presto/2.8.131 Version/11.11",
        "Chrome 17.0 – MAC"=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",
        "傲游（Maxthon）"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Maxthon 2.0)",
        "腾讯TT"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; TencentTraveler 4.0)",
        "世界之窗（The World） 2.x"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
        "世界之窗（The World） 3.x"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; The World)",
        "360浏览器"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)",
        "搜狗浏览器 1.x"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SE 2.X MetaSr 1.0; SE 2.X MetaSr 1.0; .NET CLR 2.0.50727; SE 2.X MetaSr 1.0)",
        "Avant"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Avant Browser)",
        "Green Browser"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",
        //移动端口
        "safari iOS 4.33 – iPhone"=>"Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5",
        "safari iOS 4.33 – iPod Touch"=>"Mozilla/5.0 (iPod; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5",
        "safari iOS 4.33 – iPad"=>"Mozilla/5.0 (iPad; U; CPU OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5",
        "Android N1"=>"Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
        "Android QQ浏览器 For android"=>"MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22; CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
        "Android Opera Mobile"=>"Opera/9.80 (Android 2.3.4; Linux; Opera Mobi/build-1107180945; U; en-GB) Presto/2.8.149 Version/11.10",
        "Android Pad Moto Xoom"=>"Mozilla/5.0 (Linux; U; Android 3.0; en-us; Xoom Build/HRI39) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13",
        "BlackBerry"=>"Mozilla/5.0 (BlackBerry; U; BlackBerry 9800; en) AppleWebKit/534.1+ (KHTML, like Gecko) Version/6.0.0.337 Mobile Safari/534.1+",
        "WebOS HP Touchpad"=>"Mozilla/5.0 (hp-tablet; Linux; hpwOS/3.0.0; U; en-US) AppleWebKit/534.6 (KHTML, like Gecko) wOSBrowser/233.70 Safari/534.6 TouchPad/1.0",
        "UC标准"=>"NOKIA5700/ UCWEB7.0.2.37/28/999",
        "UCOpenwave"=>"Openwave/ UCWEB7.0.2.37/28/999",
        "UC Opera"=>"Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/999",
        "微信内置浏览器"=>"Mozilla/5.0 (Linux; Android 6.0; 1503-M02 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/37.0.0.0 Mobile MQQBrowser/6.2 TBS/036558 Safari/537.36 MicroMessenger/6.3.25.861 NetType/WIFI Language/zh_CN",
    ];
    return $agentarry[array_rand($agentarry)];
}

