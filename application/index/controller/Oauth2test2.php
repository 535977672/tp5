<?php
namespace app\index\controller;
/**
 * oauth2-server-php 库的使用
 * https://www.kefong.com/post/6.html
 * 
 * Authorization Code 授权码模式
 * 
 * grant_type

说明

authorization_code

标准的Server授权模式

password

基于用户密码的授权模式

client_credentials

基于APP密钥的授权模式

refresh_token

刷新accessToken
 * 
 * 官方文档
 * http://bshaffer.github.io/oauth2-server-php-docs/
 */
use think\Controller;
use OAuth2;
//require_once(dirname(__FILE__) . '/../../../vendor/bshaffer/oauth2-server-php/src/OAuth2/Autoloader.php');

class oauth2test2 extends Controller
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
        $this->server = new OAuth2\Server($storage, ['allow_implicit' => true, 'always_issue_new_refresh_token'=>false, 'refresh_token_lifetime'=>60*60*24*30]);

        //授权码 有效期只有30秒
        $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage)); //or any grant type you like!

        //Refresh Token
        //The Refresh Token grant type has the following configuration:
        //always_issue_new_refresh_token
        //whether to issue a new refresh token upon successful token request
        //Default: false
        
        //有效期
        //The Access Token return type has the following configuration:
        //refresh_token_lifetime
        //time before refresh token expires
        //Default: 1209600 (14 days)      
        $grantType = new OAuth2\GrantType\RefreshToken($storage);
        $this->server->addGrantType($grantType);
    }
    
    /*
        用户访问客户端，客户端将用户导向授权服务器时，将以下参数通过 GET query 传入：


        response_type：授权类型，必选项，值固定为：code


        client_id：客户端ID，必选项

        redirect_uri：重定向URI，可选项，不填写时默认预先注册的重定向URI

        scope：权限范围，可选项，以空格分隔

        state：CSRF令牌，可选项，但强烈建议使用，应将该值存储与用户会话中，以便在返回时验证

        用户选择是否给予客户端授权
        假设用户给予授权，授权服务器将用户导向客户端事先指定的 redirect_uri，并将以下参数通过 GET query 传入：


        code：授权码(Authorization code)

        state：请求中发送的 state，原样返回。客户端将此值与用户会话中的值进行对比，以确保授权码响应的是此客户端而非其他客户端程序
     */
    /**
     * 获取code
     * "http://test.pcnfc.com/index/oauth2test2/authorize?response_type=code&client_id=12&state=45rfrrete3432432"
     * 
     * 用这个Authorization Code来刚才建立的token.php获得TOKEN
     * 
     * 验证控制器是OAuth2的杀手锏，它允许你的平台帮助用户验证第三方应用
        它不像accessToken例子中直接返回一个Access Token
     *      */
    public function authorize() {
        $response = new OAuth2\Response();
        //在oauth_authorization_codes表生成数据
        //调起授权页面
        
        $this->server->handleAuthorizeRequest(OAuth2\Request::createFromGlobals(), $response, TRUE)->send();
        //get http://test.pcnfc.com/index/oauth2test2/redirecturi.html?code=2e7f53f3398a2510e7be91a38d863e3c79bb5608&state=45rfrreterw3432432
    
        //当你认证了一个用户并且分派了一个Token之后，你可能想知道彼时到底是哪个用户使用了这个Token
        //你可以使用handleAuthorizeRequest的可选参数user_id来完成，修改你的authorize.php文件

        //$userid = 1; // A value on your server that identifies the user
        //$this->server->handleAuthorizeRequest(OAuth2\Request::createFromGlobals(), $response, TRUE, $userid)->send();
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
     * 数据库oauth_clients 字段 grant_types 为 authorization_code
     * 
     * Token控制器
     * 获取令牌：access_token post
     * curl "http://test.pcnfc.com/index/oauth2test2/accessToken" -d "grant_type=authorization_code&client_id=12&client_secret=1223243234&code=2e7f53f3398a2510e7be91a38d863e3c79bb5608"
     * {"access_token":"31216cafa9ad1ea087de3ff5d5c7b180fafeee85","expires_in":3600,"token_type":"Bearer","scope":"dgfhjgfhg","refresh_token":"12bd7dc10bcdc092ff8c237434b2d8b87aadafd7"}
     */
    public function accessToken(){
        $this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
    }
    
    /**
     * 资源控制器
     * http://test.pcnfc.com/index/oauth2test2/resource?access_token=345110c9ed753aa73cd01e384a9a4d8c59cbd589
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
           //array(5) { ["access_token"]=> string(40) "31216cafa9ad1ea087de3ff5d5c7b180fafeee85" ["client_id"]=> string(2) "12" ["user_id"]=> NULL ["expires"]=> int(1548660666) ["scope"]=> string(9) "dgfhjgfhg" }
        }
    }
    
    /**
     * 刷新访问令牌
     * 数据库oauth_clients 字段 grant_types 为 refresh_token
     * curl -u TestClient:TestSecret "http://test.pcnfc.com/index/oauth2test2/refreshtoken" -d "grant_type=refresh_token&refresh_token=12bd7dc10bcdc092ff8c237434b2d8b87aadafd7"
     */
    public function refreshtoken(){
        $response = $this->server->handleTokenRequest(OAuth2\Request::createFromGlobals());
        $result = $response->getParameters();
        $result['statusCode'] =$response->getStatusCode();
        var_dump($result);
        //array(5) { ["access_token"]=> string(40) "ffcbde34c6e6da91fd45297ecc18ab59853924e8" ["expires_in"]=> int(3600) ["token_type"]=> string(6) "Bearer" ["scope"]=> string(9) "dgfhjgfhg" ["statusCode"]=> int(200) }
    }
}


