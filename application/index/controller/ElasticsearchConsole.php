<?php

/**
 * 
 * 添加命令配置
 * 添加需要执行的命令类名
 * application\command.php
 * return ['app\console\command\ElasticsearchConsole'];
 * 
 * 命令执行实现
 * 命令类的实现
 * 继承think\console\command类
 * 实现 configure() execute()方法
 * 
 * 项目think目录 命令行 php think ES searchCount
 */

namespace app\console\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use Elasticsearch\ClientBuilder;

class ElasticsearchConsole extends Command {
    private $client = null;
    private $_index = 'my_test';
    private $_type = 'my_type';
    
    public function __construct()
    {
        parent::__construct();
        $hosts = ['192.168.5.107:9200'];
        //elasticsearch.yml
        //network.host: 0.0.0.0
        //discovery.seed_hosts: ["192.168.5.107", "127.0.0.1", "[::1]"]
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
        if(strtoupper(substr(PHP_OS,0,3))!=='WIN'){  
            $this->is_linux = true;
        }else{
            $this->is_linux = false;
        }
    }
    
    //$name设置指令名称
    //$description设置描述
    protected function configure()
    {
        $this->setName('ES')
            ->addArgument('action', Argument::OPTIONAL, "方法名", '')
            ->addArgument('n', Argument::OPTIONAL, "n", '0')
            ->addArgument('j', Argument::OPTIONAL, "j", '0')
            ->setDescription('ElasticsearchConsole Description');
    }

    protected function execute(Input $input, Output $output)
    {
        $action = trim($input->getArgument('action'));
        if(!$action){
            echo '执行方法错误';
            return false;
        }
        if(!in_array($action, ['indexMore', 'count', 'delete'])){
            echo "执行方法错误 可选参方法 indexMore searchCount";
            return false;
        }

        if($action == 'indexMore'){
            $n = intval($input->getArgument('n'));
            $j = intval($input->getArgument('j'));
            $this->$action($n, $j);
        }else{
            $this->$action();
        }
    }
    
    //批量（bulk）索引文档 
    //action 批量操作的行为
    //create	当文档不存在时创建之。
    //index	    创建新文档或替换已有文档。
    //update	局部更新文档。
    //delete	删除一个文档。
    public function indexMore($n=0, $j=0) {
        if($this->is_linux){
            for($i = 0; $i < 3; $i++){
                $pid = pcntl_fork();
                if (!$pid) {
                    $this->index($n, $j);
                }
            }
        }else{
            $this->index($n, $j);
        }
    }
    
    public function index($n, $j) {
        
        for ($k = 0; $k < $n; $k++) {
            $params = [];
            $params['body'] = [];

            for ($i = 0; $i < $j; $i++) {
                $params['body'][] = [
                    'index' => [
                        '_index' => $this->_index,
                        '_type' => $this->_type,
                        //'_id' => $id
                    ]
                ];
                $s = $this->getRandStr(10);
                $params['body'][] = [
                    'p1' => $this->getRandStr(10),
                    'p2' => $this->getRandStr(10,2),
                    'p3' => $this->getRandStr(2, 3),
                    'p4' => $this->getRandStr(2, 3),
                    'p5' => time(),
                    'p6' => $this->getRandStr(10),
                    'p7' => $s,
                    'p8' => $s,
                    'p9' => $s,
                    'p10' => $s,
                    'p11' => $s,
                    'p12' => $s,
                    'p13' => $s,
                    'p14' => $s,
                    'p15' => $s,
                    'p16' => $s,
                    'p17' => $s,
                    'p18' => $s,
                    'p19' => $s,
                    'p20' => $s,
                    ];
            }
            //$ts = microtime(true);
            $this->client->bulk($params);
            //echo microtime(true)-$ts.PHP_EOL;
        }
    }
    
    /**
     * 查询
     */
    public function count() {
        $ts = microtime(true);
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
        ];

        $response = $this->client->count($params);
        echo microtime(true)-$ts.PHP_EOL;
        dump($response);   
    }
    
    //删除一个索引
    public function delete() {
        $deleteParams = [
            'index' => $this->_index,
        ];
        $response = $this->client->indices()->delete($deleteParams);
        dump($response);
    }
    
    public function getRandStr($length = 10, $type = 1){
        if ($type == 1) {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST0123456789';
        } else if ($type == 2) {
            $chars = 'abcdefghijklmnopqrstuvwxyz';
        } else if ($type == 3) {
            $chars = '0123456789';
        }
        $len = strlen($chars);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $len - 1)];
        }
        return $str;
    }
}
