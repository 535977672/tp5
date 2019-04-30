<?php

/**
 * 脚本测试
 * 
 * 添加命令配置
 * 添加需要执行的命令类名
 * application\command.php
 * return ['app\console\command\TestConsole'];
 * 
 * 命令执行实现
 * 命令类的实现
 * 继承think\console\command类
 * 实现 configure() execute()方法
 * 
 * 项目think目录 命令行 php think TestConsole name code --sex 12 --year 2020
 */

namespace app\console\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class TestConsole extends Command {
    
    //$name设置指令名称
    //$description设置描述
    protected function configure()
    {
        $this->setName('TestConsoleName')
            
            //添加参数 
            //addArgument($name, $mode = null, $description = '', $default = null)名称、类型、描述、默认
            ->addArgument('name', Argument::OPTIONAL, "your name", 'name')
            ->addArgument('code', Argument::OPTIONAL, "your code", 'code')
            
            //添加选项、配置 --sex
            //addOption($name, $shortcut = null, $mode = null, $description = '', $default = null)选项名称、别名、类型、描述、默认
            ->addOption('sex', null, Option::VALUE_REQUIRED, 'option sex', 'sex')
            ->addOption('year', null, Option::VALUE_REQUIRED, 'option year', '2000')
            
            ->setDescription('TestConsole Description');
    }

    protected function execute(Input $input, Output $output)
    {
        //参数
        $params = $input->getArguments();//获取所有的参数
        var_dump($params);
        
        //根据名称获取参数
        $name = trim($input->getArgument('name'));
        $code = trim($input->getArgument('code'));
        $output->writeln("Hello," . $name . $code . '!');
        
        
        //选项
        $options = $input->getOptions();
        var_dump($options);
        
        $sex = trim($input->getOption('sex'));
        $output->writeln("Option sex: " . $sex);
        
        
        
        $output->writeln("TestConsole writeln");//输出信息并换行
        $output->newLine(2);//输出空行
        $output->write('TestConsole write');//输出信息
    }
}
