<?php
//运行Worker
//可以直接包含Job类文件，也可以使用php的自动加载机制，指定好Job Class所在路径并能实现自动加载
//包含Resque的默认Worker： bin/resque
date_default_timezone_set('GMT');
require_once dirname(__FILE__) .'/MyJob.php';//或者自动加载
require_once dirname(__FILE__).'/../../../../vendor/chrisboulton/php-resque/resque.php';//直接命令命令
Resque::setBackend('127.0.0.1:6379');//连接redis
