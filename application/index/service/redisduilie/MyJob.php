<?php
//PHP-resque是由三个角色组成的：Job、Queue、Worker；
//其中Job负责处理对应事件的逻辑，
//Queue(队列)用于接收队列消息，
//Worker常驻内存，循环POP队列中的服务。

//Job负责处理对应事件的逻辑
//Worker抛出队列服务的时候，会自动根据服务的名称去执行这个类
//需要在worker里面自动加载这个类
class MyJob
{
    public static $conn = null;

    public function __construct() {
        if (!self::$conn){
            self::$conn = new PDO("mysql:host=127.0.0.1;dbname=test", 'root', '11111111',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        }
    }

    //必须
	public function perform()
	{
		//sleep(3);
		//fwrite(STDOUT, 'Hello!');//打印显示
		//fwrite(STDOUT, $this->args['time']);//打印显示
        
        $stmt = self::$conn->prepare("INSERT INTO `user` (`id`, `time`, `timec`) VALUES (?, ?, ?)");
        $stmt->execute(array(null, $this->args['time'], time()));
	}
    
    //可选
    public function setUp()
    {
        // ... Set up environment for this job
	fwrite(STDOUT, 'setUp!');//打印显示
    }
    
    //可选
    public function tearDown()
    {
        // ... Remove environment for this job
	fwrite(STDOUT, 'tearDown!');//打印显示
    }
}
