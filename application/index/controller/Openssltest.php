<?php
namespace app\index\controller;
/**
 * openssl加解密
 */
use think\Controller;

class openssltest extends Controller
{
    private $fileCharset = "UTF-8";
    // 表单提交字符集编码
	public $postCharset = "UTF-8";
    
    //私钥值
	public $rsaPrivateKey;
    public $alipayrsaPublicKey;
    
    public $rsaPrivateKeyFilePath;
    public $rsaPublicKeyFilePath;
    
    public function initialize()
    { 
        $this->rsaPrivateKeyFilePath = dirname(__FILE__) . '/rsa_private_key.pem';
        $this->rsaPublicKeyFilePath = dirname(__FILE__) . '/rsa_public_key.pem';
    }
    
    public function index()
    { 
        //http://test.pcnfc.com/index/openssltest/index
        //查询openssl支持的对称加密算法
        $r = openssl_get_cipher_methods();
        //var_dump($r);
        /*
        array(185) {
          [0]=>
          string(11) "AES-128-CBC"
          [1]=>
          string(11) "AES-128-CFB"
          [2]=>
          string(12) "AES-128-CFB1"
          [3]=>
          string(12) "AES-128-CFB8"
          [4]=>
          string(11) "AES-128-CTR"
          [5]=>
          string(11) "AES-128-ECB"
          [6]=>
          string(11) "AES-128-OFB"
          [7]=>
          string(11) "AES-128-XTS"
          [8]=>
          string(11) "AES-192-CBC"
          [9]=>
          string(11) "AES-192-CFB"
          [10]=>
          string(12) "AES-192-CFB1"
          [11]=>
          string(12) "AES-192-CFB8"
          [12]=>
          string(11) "AES-192-CTR"
          [13]=>
          string(11) "AES-192-ECB"
          [14]=>
          string(11) "AES-192-OFB"
          [15]=>
          string(11) "AES-256-CBC"
          [16]=>
          string(11) "AES-256-CFB"
          [17]=>
          string(12) "AES-256-CFB1"
          [18]=>
          string(12) "AES-256-CFB8"
          [19]=>
          string(11) "AES-256-CTR"
          [20]=>
          string(11) "AES-256-ECB"
          [21]=>
          string(11) "AES-256-OFB"
          [22]=>
          string(11) "AES-256-XTS"
          [23]=>
          string(6) "BF-CBC"
          [24]=>
          string(6) "BF-CFB"
          [25]=>
          string(6) "BF-ECB"
          [26]=>
          string(6) "BF-OFB"
          [27]=>
          string(16) "CAMELLIA-128-CBC"
          [28]=>
          string(16) "CAMELLIA-128-CFB"
          [29]=>
          string(17) "CAMELLIA-128-CFB1"
          [30]=>
          string(17) "CAMELLIA-128-CFB8"
          [31]=>
          string(16) "CAMELLIA-128-ECB"
          [32]=>
          string(16) "CAMELLIA-128-OFB"
          [33]=>
          string(16) "CAMELLIA-192-CBC"
          [34]=>
          string(16) "CAMELLIA-192-CFB"
          [35]=>
          string(17) "CAMELLIA-192-CFB1"
          [36]=>
          string(17) "CAMELLIA-192-CFB8"
          [37]=>
          string(16) "CAMELLIA-192-ECB"
          [38]=>
          string(16) "CAMELLIA-192-OFB"
          [39]=>
          string(16) "CAMELLIA-256-CBC"
          [40]=>
          string(16) "CAMELLIA-256-CFB"
          [41]=>
          string(17) "CAMELLIA-256-CFB1"
          [42]=>
          string(17) "CAMELLIA-256-CFB8"
          [43]=>
          string(16) "CAMELLIA-256-ECB"
          [44]=>
          string(16) "CAMELLIA-256-OFB"
          [45]=>
          string(9) "CAST5-CBC"
          [46]=>
          string(9) "CAST5-CFB"
          [47]=>
          string(9) "CAST5-ECB"
          [48]=>
          string(9) "CAST5-OFB"
          [49]=>
          string(7) "DES-CBC"
          [50]=>
          string(7) "DES-CFB"
          [51]=>
          string(8) "DES-CFB1"
          [52]=>
          string(8) "DES-CFB8"
          [53]=>
          string(7) "DES-ECB"
          [54]=>
          string(7) "DES-EDE"
          [55]=>
          string(11) "DES-EDE-CBC"
          [56]=>
          string(11) "DES-EDE-CFB"
          [57]=>
          string(11) "DES-EDE-OFB"
          [58]=>
          string(8) "DES-EDE3"
          [59]=>
          string(12) "DES-EDE3-CBC"
          [60]=>
          string(12) "DES-EDE3-CFB"
          [61]=>
          string(13) "DES-EDE3-CFB1"
          [62]=>
          string(13) "DES-EDE3-CFB8"
          [63]=>
          string(12) "DES-EDE3-OFB"
          [64]=>
          string(7) "DES-OFB"
          [65]=>
          string(8) "DESX-CBC"
          [66]=>
          string(13) "GOST 28147-89"
          [67]=>
          string(8) "IDEA-CBC"
          [68]=>
          string(8) "IDEA-CFB"
          [69]=>
          string(8) "IDEA-ECB"
          [70]=>
          string(8) "IDEA-OFB"
          [71]=>
          string(10) "RC2-40-CBC"
          [72]=>
          string(10) "RC2-64-CBC"
          [73]=>
          string(7) "RC2-CBC"
          [74]=>
          string(7) "RC2-CFB"
          [75]=>
          string(7) "RC2-ECB"
          [76]=>
          string(7) "RC2-OFB"
          [77]=>
          string(3) "RC4"
          [78]=>
          string(6) "RC4-40"
          [79]=>
          string(12) "RC4-HMAC-MD5"
          [80]=>
          string(8) "SEED-CBC"
          [81]=>
          string(8) "SEED-CFB"
          [82]=>
          string(8) "SEED-ECB"
          [83]=>
          string(8) "SEED-OFB"
          [84]=>
          string(11) "aes-128-cbc"
          [85]=>
          string(11) "aes-128-ccm"
          [86]=>
          string(11) "aes-128-cfb"
          [87]=>
          string(12) "aes-128-cfb1"
          [88]=>
          string(12) "aes-128-cfb8"
          [89]=>
          string(11) "aes-128-ctr"
          [90]=>
          string(11) "aes-128-ecb"
          [91]=>
          string(11) "aes-128-gcm"
          [92]=>
          string(11) "aes-128-ofb"
          [93]=>
          string(11) "aes-128-xts"
          [94]=>
          string(11) "aes-192-cbc"
          [95]=>
          string(11) "aes-192-ccm"
          [96]=>
          string(11) "aes-192-cfb"
          [97]=>
          string(12) "aes-192-cfb1"
          [98]=>
          string(12) "aes-192-cfb8"
          [99]=>
          string(11) "aes-192-ctr"
          [100]=>
          string(11) "aes-192-ecb"
          [101]=>
          string(11) "aes-192-gcm"
          [102]=>
          string(11) "aes-192-ofb"
          [103]=>
          string(11) "aes-256-cbc"
          [104]=>
          string(11) "aes-256-ccm"
          [105]=>
          string(11) "aes-256-cfb"
          [106]=>
          string(12) "aes-256-cfb1"
          [107]=>
          string(12) "aes-256-cfb8"
          [108]=>
          string(11) "aes-256-ctr"
          [109]=>
          string(11) "aes-256-ecb"
          [110]=>
          string(11) "aes-256-gcm"
          [111]=>
          string(11) "aes-256-ofb"
          [112]=>
          string(11) "aes-256-xts"
          [113]=>
          string(6) "bf-cbc"
          [114]=>
          string(6) "bf-cfb"
          [115]=>
          string(6) "bf-ecb"
          [116]=>
          string(6) "bf-ofb"
          [117]=>
          string(16) "camellia-128-cbc"
          [118]=>
          string(16) "camellia-128-cfb"
          [119]=>
          string(17) "camellia-128-cfb1"
          [120]=>
          string(17) "camellia-128-cfb8"
          [121]=>
          string(16) "camellia-128-ecb"
          [122]=>
          string(16) "camellia-128-ofb"
          [123]=>
          string(16) "camellia-192-cbc"
          [124]=>
          string(16) "camellia-192-cfb"
          [125]=>
          string(17) "camellia-192-cfb1"
          [126]=>
          string(17) "camellia-192-cfb8"
          [127]=>
          string(16) "camellia-192-ecb"
          [128]=>
          string(16) "camellia-192-ofb"
          [129]=>
          string(16) "camellia-256-cbc"
          [130]=>
          string(16) "camellia-256-cfb"
          [131]=>
          string(17) "camellia-256-cfb1"
          [132]=>
          string(17) "camellia-256-cfb8"
          [133]=>
          string(16) "camellia-256-ecb"
          [134]=>
          string(16) "camellia-256-ofb"
          [135]=>
          string(9) "cast5-cbc"
          [136]=>
          string(9) "cast5-cfb"
          [137]=>
          string(9) "cast5-ecb"
          [138]=>
          string(9) "cast5-ofb"
          [139]=>
          string(7) "des-cbc"
          [140]=>
          string(7) "des-cfb"
          [141]=>
          string(8) "des-cfb1"
          [142]=>
          string(8) "des-cfb8"
          [143]=>
          string(7) "des-ecb"
          [144]=>
          string(7) "des-ede"
          [145]=>
          string(11) "des-ede-cbc"
          [146]=>
          string(11) "des-ede-cfb"
          [147]=>
          string(11) "des-ede-ofb"
          [148]=>
          string(8) "des-ede3"
          [149]=>
          string(12) "des-ede3-cbc"
          [150]=>
          string(12) "des-ede3-cfb"
          [151]=>
          string(13) "des-ede3-cfb1"
          [152]=>
          string(13) "des-ede3-cfb8"
          [153]=>
          string(12) "des-ede3-ofb"
          [154]=>
          string(7) "des-ofb"
          [155]=>
          string(8) "desx-cbc"
          [156]=>
          string(6) "gost89"
          [157]=>
          string(10) "gost89-cnt"
          [158]=>
          string(13) "id-aes128-CCM"
          [159]=>
          string(13) "id-aes128-GCM"
          [160]=>
          string(14) "id-aes128-wrap"
          [161]=>
          string(13) "id-aes192-CCM"
          [162]=>
          string(13) "id-aes192-GCM"
          [163]=>
          string(14) "id-aes192-wrap"
          [164]=>
          string(13) "id-aes256-CCM"
          [165]=>
          string(13) "id-aes256-GCM"
          [166]=>
          string(14) "id-aes256-wrap"
          [167]=>
          string(24) "id-smime-alg-CMS3DESwrap"
          [168]=>
          string(8) "idea-cbc"
          [169]=>
          string(8) "idea-cfb"
          [170]=>
          string(8) "idea-ecb"
          [171]=>
          string(8) "idea-ofb"
          [172]=>
          string(10) "rc2-40-cbc"
          [173]=>
          string(10) "rc2-64-cbc"
          [174]=>
          string(7) "rc2-cbc"
          [175]=>
          string(7) "rc2-cfb"
          [176]=>
          string(7) "rc2-ecb"
          [177]=>
          string(7) "rc2-ofb"
          [178]=>
          string(3) "rc4"
          [179]=>
          string(6) "rc4-40"
          [180]=>
          string(12) "rc4-hmac-md5"
          [181]=>
          string(8) "seed-cbc"
          [182]=>
          string(8) "seed-cfb"
          [183]=>
          string(8) "seed-ecb"
          [184]=>
          string(8) "seed-ofb"
        }
         */
        
        //签名算法
        $r = openssl_get_md_methods();
        var_dump($r);
        /*
        array(30) {
          [0]=>
          string(3) "DSA"
          [1]=>
          string(7) "DSA-SHA"
          [2]=>
          string(17) "GOST 28147-89 MAC"
          [3]=>
          string(15) "GOST R 34.11-94"
          [4]=>
          string(3) "MD4"
          [5]=>
          string(3) "MD5"
          [6]=>
          string(4) "MDC2"
          [7]=>
          string(9) "RIPEMD160"
          [8]=>
          string(3) "SHA"
          [9]=>
          string(4) "SHA1"
          [10]=>
          string(6) "SHA224"
          [11]=>
          string(6) "SHA256"
          [12]=>
          string(6) "SHA384"
          [13]=>
          string(6) "SHA512"
          [14]=>
          string(13) "dsaEncryption"
          [15]=>
          string(10) "dsaWithSHA"
          [16]=>
          string(15) "ecdsa-with-SHA1"
          [17]=>
          string(8) "gost-mac"
          [18]=>
          string(3) "md4"
          [19]=>
          string(3) "md5"
          [20]=>
          string(9) "md_gost94"
          [21]=>
          string(4) "mdc2"
          [22]=>
          string(9) "ripemd160"
          [23]=>
          string(3) "sha"
          [24]=>
          string(4) "sha1"
          [25]=>
          string(6) "sha224"
          [26]=>
          string(6) "sha256"
          [27]=>
          string(6) "sha384"
          [28]=>
          string(6) "sha512"
          [29]=>
          string(9) "whirlpool"
        }
         */        
        
    }
    
    /*
     * 加密：openssl_encrypt($data, $method, $passwd, $options, $iv);

        参数说明：

        $data: 加密明文

        $method: 加密方法

        $passwd: 加密密钥

        $options: 数据格式选项（可选）

        $iv: 加密初始化向量（可选）

        解密：openssl_decrypt($data, $method, $passwd, $options, $iv);

        参数说明：

        $data: 解密密文

        $method: 解密加密方法

        $passwd: 解密密钥

        $options: 数据格式选项（可选）

        $iv: 解密初始化向量（可选）
     * 
     * 生成公钥、私钥对
     * 生成原始RSA私钥文件rsa_private_key.pem 
     * openssl genrsa -out rsa_private_key.pem 1024
     * 
     * 将原始的RSA私钥转换为pkcs8模式
     * openssl pkcs8 -topk8 -inform PEM -in rsa_private_key.pem -outform PEM -nocrypt -out private_key.pem
     * 
     * 生成RSA公钥 rsa_public_key.pem
     * openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem
     */
    
    /**
     * 使用私钥加密、公钥解密
     * http://test.pcnfc.com/index/openssltest/m1
     */
    public function m1() {
        $data = [
            [
                'time' => time(),
                'id' => 1231,
                'name' => 'mffeo',
                'sex' => '男'
            ],
            [
                'time' => time(),
                'id' => 1232,
                'name' => 'hhfh',
                'sex' => '女'
            ]
        ];
        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

        // 生成密钥资源id
        $private_key = dirname(__FILE__) . '/rsa_private_key.pem';
        $public_key = dirname(__FILE__) . '/rsa_public_key.pem';
        
        //openssl_get_privatekey() 解析 key 供其他函数使用 false/resource
        $pi_key = openssl_pkey_get_private(file_get_contents($private_key));
        $pu_key = openssl_pkey_get_public(file_get_contents($public_key));

        // 私钥加密  使用私钥加密数据
        $encrypted = '';
        //$data 长度限制
        //PHP使用openssl进行Rsa加密，如果要加密的明文太长则会出错，
        //解决方法：加密的时候117个字符加密一次，
        //然后把所有的密文拼接成一个密文；
        //解密的时候需要128个字符解密一下，然后拼接成数据。
        
        //str_split — 将字符串转换为数组
        foreach(str_split($data, 117) as $chunk){
            if(!openssl_private_encrypt($chunk, $encrypteds, $pi_key)){
                echo  openssl_error_string();//从openSSL库返回最后一个错误
            }
            $encrypted .= $encrypteds;
        }

        // 转码，这里的$encrypted就是私钥加密的字符串
        $encrypted = base64_encode($encrypted);

        // 公钥解密，$decrypted即为公钥解密后私钥加密前的明文
        $decrypted = '';
        $encrypted = base64_decode($encrypted);
        
        foreach(str_split($encrypted, 128) as $chunk){
            if(!openssl_public_decrypt($chunk, $decrypteds, $pu_key)){
                echo  openssl_error_string();
            }
            $decrypted .= $decrypteds;
        }

        $d = json_decode($decrypted, true);
        var_dump($d);
    }
    
    /**
     * 使用公钥加密、私钥解密
     * http://test.pcnfc.com/index/openssltest/m2
     */
    public function m2() {
        $data = [
            [
                'time' => time(),
                'id' => 1231,
                'name' => 'mffeo',
                'sex' => '男'
            ],
            [
                'time' => time(),
                'id' => 1232,
                'name' => 'hhfh',
                'sex' => '女'
            ]
        ];
        $data = json_encode($data);
        
        // 生成密钥资源id
        $private_key = dirname(__FILE__) . '/rsa_private_key.pem';
        $public_key = dirname(__FILE__) . '/rsa_public_key.pem';
        $pi_key = openssl_pkey_get_private(file_get_contents($private_key));
        $pu_key = openssl_pkey_get_public(file_get_contents($public_key));
        

        // 公钥加密
        $encrypted = '';
        foreach(str_split($data, 117) as $chunk){
            openssl_public_encrypt($chunk, $encrypteds, $pu_key);
            $encrypted .= $encrypteds;
        }
        

        // 转码，这里的$encrypted就是公钥加密的字符串
        $encrypted = base64_encode($encrypted);

        // 私钥解密，$decrypted即为解密后公钥加密前的明文
        $decrypted = '';
        $encrypted = base64_decode($encrypted);
        foreach(str_split($encrypted, 128) as $chunk){
            openssl_private_decrypt($chunk, $decrypteds, $pi_key);
            $decrypted .= $decrypteds;
        }
        
        $d = json_decode($decrypted, true);
        var_dump($d);
    }
    
    //参考支付宝支付文档
    public function m3(){
        $cont = 'fddddd大姐夫第三方士大夫解释多了复合大师反间谍法sfsg分开发的烦恼都是妇女节的说法年时间里fdxgd';
        $charset = 'utf-8';
        $num = 10;
        for ($i = 0; $i < strlen($cont); $i += $num) {
			$res = $this->subCNchar($cont, $i, $num, $charset);
			if (!empty ($res)) {
				$arrr[] = $res;
			}
		}
        var_dump($arrr);

        //array(6) {
        //  [0]=>
        //  string(27) "f,d,d,d,d,d,大,姐,夫,第"
        //  [1]=>
        //  string(39) "三,方,士,大,夫,解,释,多,了,复"
        //  [2]=>
        //  string(33) "合,大,师,反,间,谍,法,s,f,s"
        //  [3]=>
        //  string(37) "g,分,开,发,的,烦,恼,都,是,妇"
        //  [4]=>
        //  string(37) "女,节,的,说,法,年,时,间,里,f"
        //  [5]=>
        //  string(7) "d,x,g,d"
        //}        
    }
    
    function subCNchar($str, $start = 0, $length, $charset = "gbk") {
		if (strlen($str) <= $length) {
			return $str;
		}
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);//汉字不分离, 每个字一个数组
        //array_slice — 从数组中取出一段
        //join/implode — 将一个一维数组的值转化为字符串
		$slice = join(",", array_slice($match[0], $start, $length));
		return $slice;
	}
    
    /**
	public function rsaEncrypt($data, $rsaPublicKeyPem, $charset) {
		//读取公钥文件
		$pubKey = file_get_contents($rsaPublicKeyPem);
		//转换为openssl格式密钥
		$res = openssl_get_publickey($pubKey);
		$blocks = $this->splitCN($data, 0, 30, $charset);
		$chrtext  = null;
		$encodes  = array();
		foreach ($blocks as $n => $block) {
			if (!openssl_public_encrypt($block, $chrtext , $res)) {
				echo "<br/>" . openssl_error_string() . "<br/>";
			}
			$encodes[] = $chrtext ;
		}
		$chrtext = implode(",", $encodes);

		return $chrtext;
	}

	public function rsaDecrypt($data, $rsaPrivateKeyPem, $charset) {
		//读取私钥文件
		$priKey = file_get_contents($rsaPrivateKeyPem);
		//转换为openssl格式密钥
		$res = openssl_get_privatekey($priKey);
		$decodes = explode(',', $data);
		$strnull = "";
		$dcyCont = "";
		foreach ($decodes as $n => $decode) {
			if (!openssl_private_decrypt($decode, $dcyCont, $res)) {
				echo "<br/>" . openssl_error_string() . "<br/>";
			}
			$strnull .= $dcyCont;
		}
		return $strnull;
	}

	function splitCN($cont, $n = 0, $subnum, $charset) {
		//$len = strlen($cont) / 3;
		$arrr = array();
		for ($i = $n; $i < strlen($cont); $i += $subnum) {
			$res = $this->subCNchar($cont, $i, $subnum, $charset);
			if (!empty ($res)) {
				$arrr[] = $res;
			}
		}

		return $arrr;
	}

	function subCNchar($str, $start = 0, $length, $charset = "gbk") {
		if (strlen($str) <= $length) {
			return $str;
		}
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("", array_slice($match[0], $start, $length));
		return $slice;
	}
     */
    
    
    /**
     * http://test.pcnfc.com/index/openssltest/m4
     */
    public function m4(){
        $params = [
                'time' => time(),
                'id' => 1231,
                'name' => 'mffeo',
                'sex' => '男'
            ];
        
        $content = $this->getSignContent($params);
        //var_dump($content);//string(42) "id=1231&name=mffeo&sex=男&time=1548817516" 
        
        $r1 = $this->sign($content, "RSA");//每次结果不一样
        //var_dump($r1);//string(172) "L9BZFT9DGemsnqkziQyh45lZ907vpEZYHmvRMh83sQlFT...
        
        $r2 = $this->sign($content, "RSA2");//每次结果不一样
        //var_dump($r2);//string(172) "rl/XQntaRSuJNg+lXSSUlh/oMOHw1lh30NsF
        
        $r3 = $this->verify($content, $r1, $this->rsaPublicKeyFilePath, "RSA");
        //var_dump($r3);//bool(true)
        
        $r4 = $this->verify($content, $r2, $this->rsaPublicKeyFilePath, "RSA2");
        //var_dump($r4);//bool(true)
        
    }
    
    protected function getSignContent($params) {
		ksort($params);

		$stringToBeSigned = "";
		$i = 0;
		foreach ($params as $k => $v) {
			if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {

				// 转换成目标字符集
				$v = $this->characet($v, $this->postCharset);

				if ($i == 0) {
					$stringToBeSigned .= "$k" . "=" . "$v";
				} else {
					$stringToBeSigned .= "&" . "$k" . "=" . "$v";
				}
				$i++;
			}
		}

		unset ($k, $v);
		return $stringToBeSigned;
	}
    
    /**
	 * 转换字符集编码
	 * @param $data
	 * @param $targetCharset
	 * @return string
	 */
	function characet($data, $targetCharset) {
		
		if (!empty($data)) {
			$fileType = $this->fileCharset;
			if (strcasecmp($fileType, $targetCharset) != 0) {
                //转换字符的编码
				$data = mb_convert_encoding($data, $targetCharset, $fileType);
				//				$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
			}
		}


		return $data;
	}

	/**
	 * 校验$value是否非空
	 *  if not set ,return true;
	 *    if is null , return true;
	 **/
	protected function checkEmpty($value) {
		if (!isset($value))
			return true;
		if ($value === null)
			return true;
		if (trim($value) === "")
			return true;

		return false;
	}
    
    protected function sign($data, $signType = "RSA") {
		if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
			$priKey=$this->rsaPrivateKey;
            //wordwrap — 打断字符串为指定数量的字串
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
		}else {
			$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
			$res = openssl_get_privatekey($priKey);//openssl_pkey_get_private($priKey)
		}

		($res) or die('您使用的私钥格式错误，请检查RSA私钥配置'); 

		if ("RSA2" == $signType) {
            
            //openssl_sign ( string $data , string &$signature , mixed $priv_key_id [, mixed $signature_alg = OPENSSL_ALGO_SHA1 ] ) : bool
            //openssl_get_md_methods()  OPENSSL_ALGO_SHA256
            //define ('OPENSSL_ALGO_SHA1', 1);
            //define ('OPENSSL_ALGO_MD5', 2);
            //define ('OPENSSL_ALGO_MD4', 3);
            //define ('OPENSSL_ALGO_DSS1', 5);
            //define ('OPENSSL_ALGO_SHA224', 6);
            //define ('OPENSSL_ALGO_SHA256', 7);
            //define ('OPENSSL_ALGO_SHA384', 8);
            //define ('OPENSSL_ALGO_SHA512', 9);
            //define ('OPENSSL_ALGO_RMD160', 10);            
			openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
		} else {
			openssl_sign($data, $sign, $res);
		}

		if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            //释放资源 从内存中释放和指定的 key_identifier相关联的密钥
			openssl_free_key($res);
		}
        //有特殊字符
		$sign = base64_encode($sign);
		return $sign;
	}
    
    function verify($data, $sign, $rsaPublicKeyFilePath, $signType = 'RSA') {

		if($this->checkEmpty($rsaPublicKeyFilePath)){

			$pubKey= $this->alipayrsaPublicKey;
			$res = "-----BEGIN PUBLIC KEY-----\n" .
				wordwrap($pubKey, 64, "\n", true) .
				"\n-----END PUBLIC KEY-----";
		}else {
			//读取公钥文件
			$pubKey = file_get_contents($rsaPublicKeyFilePath);
			//转换为openssl格式密钥
			$res = openssl_get_publickey($pubKey);
		}

		($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');  

		//调用openssl内置方法验签，返回bool值

		if ("RSA2" == $signType) {
            //验证签名
			$result = (bool)openssl_verify($data, base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
		} else {
			$result = (bool)openssl_verify($data, base64_decode($sign), $res);
		}

		if(!$this->checkEmpty($rsaPublicKeyFilePath)) {
			//释放资源
			openssl_free_key($res);
		}

		return $result;
	}
}


