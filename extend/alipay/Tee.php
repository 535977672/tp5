<?php
namespace alipay;

require_once '../lib/alipay/aop/AopClient.php';

require_once '../lib/alipay/aop/request/AlipayTradeWapPayRequest.php';
use AopClient;
use AlipayTradeWapPayRequest;

class Tee
{

    public function tt(){
        $c = new AopClient;
        $c->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $c->appId = "2016073000123483";
        $c->rsaPrivateKey = 'MIIEpAIBAAKCAQEAk2pqkp7Ye4ejIJNpG5OEFySSbcHPPUWbQuhY7a1buCYY3TFlWgmTADtibZbK48FM/QpmRMWktSZZrS6wHeuJdMoeYx49b3FbzyWsJqswYybwGJvEGSvABgsutGujlF0OetWWs/U1DsHTCSkhKMkVVPOpHwLhRPypARtAkEGD/YgxWAKqO1rz9Oz4tKGhXMX+Vzp2eHTQe/o63BAsfogmuAJlSz/xL62KkB4Dvw+Kx0q3z0JYf60ssrxw8wJGSXVBt2VUor8evJo3EtrMY4XlW5/yiYnECMNI5vaI9aNmxzF6pUcSkAXTBP4CJhnMBIRkM7GgU1ZjgPY4+i555O2C7wIDAQABAoIBAHiYLLjnY3ei3Usv7GNXyU5ZZ8SMMSoRwFL62o0NLaQ23k5NM3l1raEZ84ptOmsZXg7/K+yEtxpOVjw7nm3LmrZFBpjVSzLYzF9olS1JDBuA5hdrjf99b+hBy6JjD/22JrtL8a4kIZSB8U9kKzE/VskZT7gD1h9mhidWkPmx7vU+7HfulEfviER7MUUrJzbSbIC7/ty6l4LhijtclOoA5Nw9IRuR7fsos5vuDibhMqgZHrw8An0Qg1o8zl/EqIKGC40NpIH7ymcKEMByACIG2mQs8mCeIihWl7xkmX7GNrVn0KHQ2xJsAXIohoG5jr/ahnIbZKwoHD5jym5M+HksNSECgYEA4lPkvB2wSgkvbSomeE1jCDouMsKW5Fk1tjF0Bx5gznFq0PIA6GPt354KPR6joX8oPiWrs8c4p8Z6KgClstslM00jk3y0iSFLO+qCG6sFN8mmoIAUf+jIO8Xsq04rXC4nfCfIFr2i18Vd/R3NXG5iYzGwW3HnvcPkOrifPKYxTR8CgYEApr4LTBblivb4C1iIcUgRLJ5v+2A3WzVtjlwundrJAHV0IOaqhB+IHLhqmnfWY+zcwviCnlrrHiNlBYgjPxNY2L54z9fK6ckIBEBgD2JaVURHZeI+X82ZddRnUS/2awGPeSMJbe/ytCElieni9Gja9yT/I/bTOHOd7J3wVGEKQDECgYEAw1fvg6IIR054Pbt0qr74a+BzgWJMhFivMEqsv3wrx+NCc4d82xds92XbpncsejZbEJDJCwk3UC/RvzEB00asbAP3YdPvqrAu1E8K70CD52vHwp3pk6DiOh0RsaVtbUl00Qcw/te8lomGHvK7Dj1D9COt+K9uem56LWiuH9W9lbcCgYA7UbLNL/wbcv8NckKgImZRvE/UWwd2gExob+z5pYMKkb5tkgIpnNocdZMfPvDbfcGP7z7wvSGWCDuBO0xmvShHe4OZVYjPoQAkGw7Rikjeurq3yUQtawRkQds7q9d7fAOhsdBB9zId2Qj0xmtCTidP8y59ierc02zkZ8+/BQLTkQKBgQCTOboac9bQpV+70rh3ZyzbSqW/l/k2/Iw1ke/pYKqs7zauNreSd1i/KKAzgIh8BM/RR0obejIUNhPsryQbaf2t7iUTlOZTyAUfgEtA5TdCVv99AqgHJToKIq2doy+oVxR5WwFH5ihiKlLYK8PLsIkLOcb12H8EwfPHvkt1sx7AhQ==' ;
        $c->format = "json";
        $c->charset= "utf-8";
        $c->signType= "RSA2";
        $c->return_url = "https://www.amief.club/index/app";
        $c->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApZ9Oxf0YSVKg8hcj9r8LtPvr1U1PV5EVd7Yv7WOpU3Pm0vzZ0Lref+OtbVupSXbf72o1tM16m0ioTAeHCMAZ+8iRXFqKzet+FrMqBGr2La+eIAKE3H0WamfHgg8ujB8VOfi1kU8Fy08w3eELvBuQ7CMPddvylwUVZQ+ifFGQBZPGYS5SGM5vLKdKUBgIlwyOEcvUqDH3l8y3hFE9gKR3p3XK/3GjRlgrmFfVc4ConIU3pkm7S1XNTiaqyz1d3OLeToUfVASpWp+V1r0WtyM7stJtv1I00bJnZr6aZEp2drB5Ma8PX4xvVaDIGpzHOWfcEz/aZQ4HXA/wXk85OWYGXQIDAQAB';
    //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
        $request = new AlipayTradeWapPayRequest();
    //SDK已经封装掉了公共参数，这里只需要传入业务参数
    //此次只是参数展示，未进行字符串转义，实际情况下请转义
        $request->setBizContent = "{" .
            "    \"subject\":\"乐透\"," .
            "    \"out_trade_no\":\"1000102\"," .
            "    \"total_amount\":\"0.01\"," .
            "    \"quit_url\":\"https://opendocs.alipay.com/apis/api_1/alipay.trade.wap.pay\"" . //用户付款中途退出返回商户网站的地址
            "    \"product_code\":\"QUICK_WAP_WAY\"" .
            "    \"passback_params\":\"111_212\"" .  //公用回传参数，如果请求时传递了该参数，则返回给商户时会回传该参数。支付宝只会在同步返回（包括跳转回商户网站）和异步通知时将该参数原样返回。本参数必须进行UrlEncode之后才可以发送给支付宝。
            " }";
        $response= $c->execute($request);
        return $response;

    }


}