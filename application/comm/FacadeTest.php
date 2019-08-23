<?php
namespace app\comm;

class FacadeTest {
    
    protected $str = 'hello';

    public function index() {
        echo $this->str.'<br/>';
    }
    
    public static function index2($name = '', $code = '') {
        echo '22'.'<br/>';
    }
}