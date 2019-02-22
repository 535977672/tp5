<?php
//linux 任务执行
//命令行运行用的.ini不一样 在/etc/php/7.0/cli/php.ini   extension=redis.so
//php MyJob2.php
//虚拟机3万条数据redis写入 7秒 ，文件写入数据库运行33秒 ， 比phpreque快很多
$conn = new PDO("mysql:host=127.0.0.1;dbname=test", 'root', '11111111',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
while($jobs2 = $redis->rPop('job2')){
    $jobs2s = json_decode($jobs2, TRUE);
    $stmt = $conn->prepare("INSERT INTO `user` (`id`, `time`, `timec`) VALUES (?, ?, ?)");
    $stmt->execute(array(null, $jobs2s['time'], time()));
}
