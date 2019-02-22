<?php
namespace app\index\controller;
/**
 * OAuth2.0 与 oauth2-server 库的使用
 * https://www.jianshu.com/p/83b0f6d82d6c
 */
use think\Controller;
use app\index\service\oauth\repositories\ClientRepository;
use app\index\service\oauth\repositories\ScopeRepository;
use app\index\service\oauth\repositories\AccessTokenRepository;
use app\index\service\oauth\repositories\AuthCodeRepository;
use app\index\service\oauth\repositories\RefreshTokenRepository;
use app\index\service\oauth\repositories\UserRepository;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response as Responses;
use Zend\Diactoros\ServerRequest;


use Zend\Diactoros\Stream;//zendframework/zend-diactoros
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use app\index\service\oauth\entities\UserEntity;

class oauth2test extends Controller
{
    private static $clientRepository = null;
    private static $scopeRepository = null;
    private static $accessTokenRepository = null;
    private static $authCodeRepository = null;
    private static $refreshTokenRepository = null;
    private static $userRepository = null;
    private $privateKey = null;
    private $encryptionKey = null;
    private $server = null;


    public function initialize()
    { 
        //初始化 server
        // 初始化存储库
        self::$clientRepository = new ClientRepository(); // Interface: ClientRepositoryInterface
        self::$scopeRepository = new ScopeRepository(); // Interface: ScopeRepositoryInterface
        self::$accessTokenRepository = new AccessTokenRepository(); // Interface: AccessTokenRepositoryInterface
        self::$authCodeRepository = new AuthCodeRepository(); // Interface: AuthCodeRepositoryInterface
        self::$refreshTokenRepository = new RefreshTokenRepository(); // Interface: RefreshTokenRepositoryInterface
        self::$userRepository = new UserRepository(); //Interface: UserRepositoryInterface

        // 私钥与加密密钥
        $this->privateKey = dirname(__FILE__) . '/private.key';
        //$this->privateKey = new CryptKey('file://path/to/private.key', 'passphrase'); // 如果私钥文件有密码
        $this->encryptionKey = 'lxZFUEsBCJ2Yb14IF2ygAHI5N4+ZAUXXaSeeJm6+twsUmIen'; // 加密密钥字符串
        //$this->sencryptionKey = Key::loadFromAsciiSafeString($this->encryptionKey); //如果通过 generate-defuse-key 脚本生成的字符串，可使用此方法传入

        // 初始化 server
        $this->server = new \League\OAuth2\Server\AuthorizationServer(
            self::$clientRepository,
            self::$accessTokenRepository,
            self::$scopeRepository,
            $this->privateKey,
            $this->encryptionKey
        );
        
        //初始化授权码类型
        // 授权码授权类型初始化
        $grant = new \League\OAuth2\Server\Grant\AuthCodeGrant(
            self::$authCodeRepository,
            self::$refreshTokenRepository,
            new \DateInterval('PT10M') // 设置授权码过期时间为10分钟
        );
        $grant->setRefreshTokenTTL(new \DateInterval('P1M')); // 设置刷新令牌过期时间1个月

        // 将授权码授权类型添加进 server
        $this->server->enableGrantType(
            $grant,
            new \DateInterval('PT1H') // 设置访问令牌过期时间1小时
        );
       
    }
    
    public function authorize(ServerRequest $request, Responses $response) {
        try {
            // 验证 HTTP 请求，并返回 authRequest 对象
            $authRequest = $this->server->validateAuthorizationRequest($request); return 11;
            // 此时应将 authRequest 对象序列化后存在当前会话(session)中
            $_SESSION['authRequest'] = serialize($authRequest);
            // 然后将用户重定向至登录入口或在当前地址直接响应登录页面
            //return $response->getBody()->write(file_get_contents("authorize.html"));
            return $response->getBody()->write($this->fetch());

        } catch (OAuthServerException $exception) {
            // 可以捕获 OAuthServerException，将其转为 HTTP 响应
            return $exception->generateHttpResponse($response);

        } catch (\Exception $exception) {
            // 其他异常
            $body = new Stream(fopen('php://temp', 'r+'));
            $body->write($exception->getMessage());
            return $response->withStatus(500)->withBody($body);

        }
    }
    
    public function login(ServerRequestInterface $request, ResponseInterface $response){
        try {
            // 在会话(session)中取出 authRequest 对象
            $authRequest = unserialize($_SESSION['authRequest']);
            // 设置用户实体(userEntity)
            $authRequest->setUser(new UserEntity(1));
            // 设置权限范围
            $authRequest->setScopes(['basic']);
            // true = 批准，false = 拒绝
            $authRequest->setAuthorizationApproved(true);
            // 完成后重定向至客户端请求重定向地址
            return $this->server->completeAuthorizationRequest($authRequest, $response);
        } catch (OAuthServerException $exception) {
            // 可以捕获 OAuthServerException，将其转为 HTTP 响应
            return $exception->generateHttpResponse($response);
        } catch (\Exception $exception) {
            // 其他异常
            $body = new Stream(fopen('php://temp', 'r+'));
            $body->write($exception->getMessage());
            return $response->withStatus(500)->withBody($body);
        }
    }
    
    public function access_token(ServerRequestInterface $request, ResponseInterface $response){
        try {
            // 这里只需要这一行就可以，具体的判断在 Repositories 中
            return $this->server->respondToAccessTokenRequest($request, $response);
        } catch (\League\OAuth2\Server\Exception\OAuthServerException $exception) {
            return $exception->generateHttpResponse($response);
        } catch (\Exception $exception) {
            $body = new Stream(fopen('php://temp', 'r+'));
            $body->write($exception->getMessage());
            return $response->withStatus(500)->withBody($body);
        }
    }
    
    
}


