<?php
namespace app\index\controller;
/**
 * oauth2-server-php 库的使用
 * https://www.kefong.com/post/6.html
 * 
 * User Credentials 基于用户密码的授权模式
 * 
 * 官方文档
 * http://bshaffer.github.io/oauth2-server-php-docs/
 */
use think\Controller;
use OAuth2;
//require_once(dirname(__FILE__) . '/../../../vendor/bshaffer/oauth2-server-php/src/OAuth2/Autoloader.php');

class oauth2test2_2 extends Controller
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
        

        // create some users in memory
        //oauth_users表
        $users = array('ddsf' => array('password' => '1232551351', 'first_name' => 'erdgds', 'last_name' => 'gtfdh'));

        // create a storage object
        $storage2 = new OAuth2\Storage\Memory(array('user_credentials' => $users));

        // create the grant type
        $grantType = new OAuth2\GrantType\UserCredentials($storage2, array('allow_credentials_in_request_body' => true));
        
        $this->server->addGrantType($grantType);
        //$ curl -u TestClient:TestSecret https://api.mysite.com/token -d 'grant_type=password&username=bshaffer&password=brent123'
        //$ curl https://api.mysite.com/token -d 'grant_type=password&client_id=TestClient&username=bshaffer&password=1232551351
        
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
     * 数据库oauth_clients 字段 grant_types 为 password
     * oauth_users表
     * Token控制器
     * 获取令牌：access_token post
     * If your client is public (by default, this is true(allow_credentials_in_request_body) when no secret is associated with the client in storage), you can omit the client_secret value in the request:
     * curl "http://test.pcnfc.com/index/oauth2test2_2/accessToken" -d "grant_type=password&client_id=12&client_secret=1223243234&username=ddsf&password=1232551351"
     * {"access_token":"e29bb5fac9d20a513aa3b1a53e2b9d352177ef1b","expires_in":1814400,"token_type":"Bearer","scope":"dgfhjgfhg","refresh_token":"2b0ce756aa7a6a2f6fc6dfef308530ef63c0599e"}
     */
    public function accessToken(){
        $this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
    }
    
    /**
     * 资源控制器
     * http://test.pcnfc.com/index/oauth2test2_1/resource?access_token=e29bb5fac9d20a513aa3b1a53e2b9d352177ef1b
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
           //array(5) { ["access_token"]=> string(40) "e29bb5fac9d20a513aa3b1a53e2b9d352177ef1b" ["client_id"]=> string(2) "12" ["user_id"]=> string(4) "ddsf" ["expires"]=> int(1550475886) ["scope"]=> string(9) "dgfhjgfhg" }
        }
    }
}


