<?php
namespace app\index\controller;
/**
 * oauth2-server-php 库的使用
 * https://www.kefong.com/post/6.html
 * 
 * Client Credentials 基于APP密钥的授权模式
 * 
 * 官方文档
 * http://bshaffer.github.io/oauth2-server-php-docs/
 */
use think\Controller;
use OAuth2;
//require_once(dirname(__FILE__) . '/../../../vendor/bshaffer/oauth2-server-php/src/OAuth2/Autoloader.php');

class oauth2test2_1 extends Controller
{
    private $dsn = 'mysql:dbname=test;host=127.0.0.1';
    private $username = 'root';
    private $password = 'root';
    private $server = null;

    public function initialize()
    { 
        OAuth2\Autoloader::register();
        $storage = new OAuth2\Storage\Pdo(array('dsn' => $this->dsn, 'username' => $this->username, 'password' => $this->password));
        //通过存储对象或对象数组存储的oauth2服务器类
        $this->server = new OAuth2\Server($storage, ['allow_implicit' => true, 'access_lifetime' => 3600 * 24 * 7 * 3]);
        

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        //客户端证书  
        // create test clients in memory
        $clients = array('12' => array('client_secret' => '1223243234'));
        // create a storage object
        $storage2 = new OAuth2\Storage\Memory(array('client_credentials' => $clients));
        //Default:true:除了授权HTTP头之外，是否在POST主体中查找凭据 whether to look for credentials in the POST body in addition to the Authorize HTTP Header
        $this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage2, array('allow_credentials_in_request_body' => true)));
        // using HTTP Basic Authentication false 即TestClient:TestSecret在header中
        //$ curl -u TestClient:TestSecret https://api.mysite.com/token -d 'grant_type=client_credentials'
        //using POST Body true
        //$ curl https://api.mysite.com/token -d 'grant_type=client_credentials&client_id=TestClient&client_secret=TestSecret'
        //{"access_token":"03807cb390319329bdf6c777d4dfae9c0d3b3c35","expires_in":3600,"token_type":"bearer","scope":null}
        
    }
    
    /**
     * redirect_uri
     * 
     */
    public function redirectUri() {
        var_dump($_POST);
        var_dump($_GET);
    }
    
    /**
     * 数据库oauth_clients 字段 grant_types 为client_credentials
     * 
     * Token控制器
     * 获取令牌：access_token post
     * curl "http://test.pcnfc.com/index/oauth2test2_1/accessToken" -d "grant_type=client_credentials&client_id=12&client_secret=1223243234"
     * {"access_token":"748399d21bb46acf8748d30dd6c538cf427f268e","expires_in":1814400,"token_type":"Bearer","scope":"dgfhjgfhg"}
     */
    public function accessToken(){
        $this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
    }
    
    /**
     * 资源控制器
     * http://test.pcnfc.com/index/oauth2test2_1/resource?access_token=748399d21bb46acf8748d30dd6c538cf427f268e
     */
    public function resource(){
        // 校验token值
        if (!$this->server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
            $this->server->getResponse()->send();//{"error":"invalid_token","error_description":"The access token provided is invalid"}
            exit;
        }else{
           echo 11; 
           $token = $this->server->getAccessTokenData(OAuth2\Request::createFromGlobals());
           var_dump($token);
           //array(5) { ["access_token"]=> string(40) "748399d21bb46acf8748d30dd6c538cf427f268e" ["client_id"]=> string(2) "12" ["user_id"]=> NULL ["expires"]=> int(1550473553) ["scope"]=> string(9) "dgfhjgfhg" }
        }
    }
}


