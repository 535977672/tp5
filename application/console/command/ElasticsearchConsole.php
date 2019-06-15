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
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }
    
    //$name设置指令名称
    //$description设置描述
    protected function configure()
    {
        $this->setName('ES')
            ->addArgument('action', Argument::OPTIONAL, "方法名", '')
            ->setDescription('ElasticsearchConsole Description');
    }

    protected function execute(Input $input, Output $output)
    {
        $action = trim($input->getArgument('action'));
        if(!$action){
            echo '执行方法错误';
            return false;
        }
        if(!in_array($action, ['indexMore', 'searchCount'])){
            echo "执行方法错误 可选参方法 indexMore searchCount";
            return false;
        }

        $this->$action();
    }
    
    //批量（bulk）索引文档 
    //action 批量操作的行为
    //create	当文档不存在时创建之。
    //index	    创建新文档或替换已有文档。
    //update	局部更新文档。
    //delete	删除一个文档。
    public function indexMore() {
        
        for($i = 0; $i < 1; $i++){
            //$pid = pcntl_fork();
            //if (!$pid) {
                $this->index(2);
            //}
        }
    }
    
    public function index($n) {
        $params['body'] = [];
        
        for ($i = 0; $i <= $n; $i++) {
            $id = $this->getRandStr(20,3);
            $params['body'][] = [
                'index' => [
                    '_index' => $this->_index,
                    '_type' => $this->_type,
                    //'_id' => $id
                ]
            ];
            $params['body'][] = [
                'pid' => $id,
                'n' => 123,
                ];
        }
       
        $this->client->bulk($params);
    }
    
    /**
     * 查询
     */
    public function searchCount() {
        $params = [
            'index' => $this->_index,
            'type' => $this->_type,
        ];

        $response = $this->client->count($params);
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
