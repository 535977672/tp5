<?php
namespace app\index\controller;
        
require '../vendor/autoload.php';

use think\Controller;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Filters\Video\ExtractMultipleFramesFilter;

/**
 * 安装库文件
 * https://github.com/PHP-FFMpeg/PHP-FFMpeg
 * composer require php-ffmpeg/php-ffmpeg
 * 
 * Windows软件包地址
 * https://ffmpeg.zeranoe.com/builds/
 * 
 * linux
 * sudo apt-get install yasm 
 * sudo ./configure
 * sudo make && sudo make install
 * 
 * 
 */
class Ffmpegs extends Controller
{
    protected $ffmpeg = 'D:/ffmpeg/bin/ffmpeg.exe';
    protected $ffprobe = 'D:/ffmpeg/bin/ffprobe.exe';


    protected function initialize() {

    }
    
    public function index()
    { 
//        $url = 'static/ffmpeg/1.mp4';
//        $durl = 'static/ffmpeg/img/1_image%d.jpg';
//        $this->videoToImg($url, $durl);
//        
//        
//        $url = 'static/ffmpeg/img/1_image%d.jpg';
//        $durl = 'static/ffmpeg/1_1.mp4';
//        $this->imgToVideo($url, $durl);
        
        $url = 'static/ffmpeg/1.mp4';
        $info = $this->videoInfo($url);
        var_dump($info);
    }
    
    private function videoInfo($file)
    { 
        //$file = 'static/ffmpeg/1.mp4';
        
        $str = "$this->$ffprobe -i $file";
        
        ob_start();
        //执行外部程序并且显示原始输出
        passthru($str);// passthru(sprintf('/usr/local/bin/ffmpeg -i "%s" 2>&1', $file));
        $video_info = ob_get_contents();
        ob_end_clean();

        // 使用输出缓冲，获取ffmpeg所有输出内容
        $ret = array();

        // Duration: 00:33:42.64, start: 0.000000, bitrate: 152 kb/s
        if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $video_info, $matches)){
            $ret['duration'] = $matches[1]; // 视频长度
            $duration = explode(':', $matches[1]);
            $ret['seconds'] = $duration[0]*3600 + $duration[1]*60 + $duration[2]; // 转为秒数
            $ret['start'] = $matches[2]; // 开始时间
            $ret['bitrate'] = $matches[3]; // bitrate 码率 单位kb
        }

        // Stream #0:1: Video: rv20 (RV20 / 0x30325652), yuv420p, 352x288, 117 kb/s, 15 fps, 15 tbr, 1k tbn, 1k tbc
        if(preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $video_info, $matches)){
            $ret['vcodec'] = $matches[1];     // 编码格式
            $ret['vformat'] = $matches[2];    // 视频格式
            $ret['resolution'] = $matches[3]; // 分辨率
            list($width, $height) = explode('x', $matches[3]);
            $ret['width'] = $width;
            $ret['height'] = $height;
        }

        // Stream #0:0: Audio: cook (cook / 0x6B6F6F63), 22050 Hz, stereo, fltp, 32 kb/s
        if(preg_match("/Audio: (.*), (\d*) Hz/", $video_info, $matches)){
            $ret['acodec'] = $matches[1];      // 音频编码
            $ret['asamplerate'] = $matches[2]; // 音频采样频率
        }

        if(isset($ret['seconds']) && isset($ret['start'])){
            $ret['play_time'] = $ret['seconds'] + $ret['start']; // 实际播放时间
        }

        $ret['size'] = filesize($file); // 视频文件大小
        $video_info = iconv('gbk','UTF-8', $video_info);
        return array($ret, $video_info);
    }
    
    //截图
    public function printscreen(){
        
        $url = 'static/ffmpeg/1.mp4';
        $durl = 'static/ffmpeg/1_printscreen.jpg';
        
        // -i 设定输入流
        // -f 设定输出格式
        // -ss 开始时间 
        // 视频参数： 
        // -b 设定视频流量，默认为200Kbit/s 
        // -r 设定帧速率，默认为25 
        // -s 设定画面的宽与高 
        // -aspect 设定画面的比例 
        // -vn 不处理视频 
        // -vcodec 设定视频编解码器，未设定时则使用与输入流相同的编解码器 
        // 音频参数： 
        // -ar 设定采样率 
        // -ac 设定声音的Channel数 
        // -acodec 设定声音编解码器，未设定时则使用与输入流相同的编解码器 
        // -an 不处理音频
        
        //-ss 00:00:06 -t 00:00:12 6秒开始，时长为12秒
        //-vcodec copy -acodec copy : 编码格式不变
        //-y 对输出文件进行覆盖
        //-threads 2 以两个线程进行运行 加快处理的速度
        //-vcode 编码格式libx264 
        //-f 强迫采用格式fmt 
        //-q:v 2 视频码率 提高抽取到的图片的质量的
        $str = "$this->ffmpeg -i $url -y -f image2 -ss 1.0 -t 0.001 -r 9  -s 1920x1080 $durl";
        
        exec($str, $result);
        var_dump($result);

    }
    
    public function videoMerge(){
        
        $row = 1;//1-水平 0-垂直
        $url = [
            'static/ffmpeg/1.mp4',
            'static/ffmpeg/2.mp4'
        ];
        $len = count($url);
        
        $ffmpeg = $this->ffmpeg;
        
        $str = "$this->ffmpeg -i $url image%d.jpg";
        
    }
    
    
    
    private function videoToImg($url, $durl){
        
        //$url = 'static/ffmpeg/1.mp4';
        //$durl = 'static/ffmpeg/img/1_image%d.jpg';
        
        $d = substr($durl, 0, strrpos($durl, '/'));
        $this->removeDir($d);
        mkdir ($d,0777,true);
        $str = "$this->ffmpeg -i $url $durl";
        
        exec($str);
        return $d;
        
    }
    
    private function imgToVideo($url, $durl){
        
        //$url = 'static/ffmpeg/img/1_image%d.jpg';
        //$durl = 'static/ffmpeg/1_1.mp4';
        
        $d = substr($durl, 0, strrpos($durl, '/'));
        if(!is_dir($d))
        mkdir ($d,0777,true);
        
        $str = "$this->ffmpeg -y -r 9 -f image2 -i $url -vcodec libx264 $durl";
        
        exec($str);
        
        $d = substr($url, 0, strrpos($url, '/'));
        $this->removeDir($d);
        return true; 
    }
    
    private function videoToTs($url, $durl){
        
        //$url = 'static/ffmpeg/1.mp4';
        //$durl = 'static/ffmpeg/1_1_ts.ts';
        
        $d = substr($durl, 0, strrpos($durl, '/'));
        if(!is_dir($d))
        mkdir ($d,0777,true);
        
        //mp4转成无损质量的ts
        $str = "$this->ffmpeg -i $url -vcodec copy -acodec copy -vbsf h264_mp4toannexb $durl";
        
        exec($str);
 
        return true; 
    }

    public function removeDir($dirName) 
    { 
        if(! is_dir($dirName)) 
        { 
            return false; 
        } 
        $handle = @opendir($dirName); 
        while(($file = @readdir($handle)) !== false) 
        { 
            if($file != '.' && $file != '..') 
            { 
                $dir = $dirName . '/' . $file; 
                is_dir($dir) ? removeDir($dir) : @unlink($dir); 
            } 
        } 
        closedir($handle); 

        return rmdir($dirName) ; 
    }
}

