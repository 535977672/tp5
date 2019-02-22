<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use Exception;
class t extends Controller
{
    
    public function index()
    {   
        Db::startTrans();
        try {
            $this->index1();
            $this->index2();
            $this->index3();
            Db::commit();
           return  'success';
       } catch (\Exception $exc) {
           Db::rollback();
           return false;
       }
    }
    
    
    public function index1()
    {   
       Db::startTrans();
       
       try {

           $data = ['title' => 'bar', 'content' => 'foo'];
           $re = Db::name('info')->insert($data);
           if(!$re){
               throw new Exception('error 1', 200);
           }
           
           Db::commit();
           return  'success 1';
       } catch (\Exception $exc) {
           Db::rollback();
           echo $exc->getcode() . $exc->getMessage();
           return false;
       }
    }
    
    
    public function index2()
    {   
       Db::startTrans();
       
       try {

           $data = ['title' => 'bar2', 'content' => 'foo2'];
           $re = Db::name('info')->insert($data);
           if(!$re){
               throw new Exception('error 12', 200);
           }
           
           Db::commit();
           return  'success 12';
       } catch (\Exception $exc) {
           Db::rollback();
           echo $exc->getcode() . $exc->getMessage();
           return false;
       }
    }
    
    
    public function index3()
    {   
       Db::startTrans();
       
       try {

           $data = ['title' => 'bar23', 'content' => 'foo23'];
           $re = Db::name('info')->insert($data);
           if(!$re){
               throw new Exception('error 123', 200);
           }
           throw new Exception('error 123', 200);
           Db::commit();
           return  'success 123';
       } catch (\Exception $exc) {
           Db::rollback();
           echo $exc->getcode() . $exc->getMessage();
           return false;
       }
    }
}
