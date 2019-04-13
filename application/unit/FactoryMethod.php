<?php

/**
 * Factory Method 工厂方法模式
 * 对比简单工厂模式的优点是，您可以将其子类用不同的方法来创建一个对象。
 */

namespace app\unit;


interface Logger
{
    public function log(string $message);
}


class StdoutLogger implements Logger
{
    public function log(string $message)
    {
        echo $message;
    }
}


class FileLogger implements Logger
{
    /**
     * @var string
     */
    private $filePath;
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }
    public function log(string $message)
    {
        file_put_contents($this->filePath, $message . PHP_EOL, FILE_APPEND);
    }
}

interface LoggerFactory
{
    public function createLogger(): Logger;
}

class StdoutLoggerFactory implements LoggerFactory
{
    public function createLogger(): Logger
    {
        return new StdoutLogger();
    }
}

class FileLoggerFactory implements LoggerFactory
{
    /**
     * @var string
     */
    private $filePath;
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }
    public function createLogger(): Logger
    {
        return new FileLogger($this->filePath);
    }
}

//测试
//function testCanCreateStdoutLogging()
//{
//    $loggerFactory = new StdoutLoggerFactory();
//    $logger = $loggerFactory->createLogger();
//}