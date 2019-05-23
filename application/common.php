<?php


//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//捕获PHP的错误：Fatal Error、Parse Error等
//PHP脚本执行结束前最后一个调用的函数，比如脚本错误、die()、exit、异常、正常结束都会调用
//多通过这个函数就可以在脚本结束前判断这次执行是否有错误产生
//register_shutdown_function("shutdownerror");
        
function shutdownerror() {

    $_error = error_get_last();//error_get_last()；这个函数可以拿到本次执行产生的所有错误

    var_dump($_error);
    
    //if ($_error && in_array($_error['type'], array(1, 4, 16, 64, 256, 4096, E_ALL))) {
        echo '致命错误:' . $_error['message'] . '</br>';
        echo '文件:' . $_error['file'] . '</br>';
        echo '在第' . $_error['line'] . '行</br>';
    //}
}

//set_exception_handler('back');
//设置默认的异常处理程序，用在没有用try/catch块来捕获的异常，也就是说不管你抛出的异常有没有人捕获，
//如果没有人捕获就会进入到该方法中，并且在回调函数调用后异常会中止。

///set_error_handler()
//不能处理以下级别的错误：E_ERROR、 E_PARSE、 E_CORE_ERROR、 E_CORE_WARNING、 E_COMPILE_ERROR、 E_COMPILE_WARNING