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

set_time_limit(0);

ini_set('memory_limit', '-1');

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
 * 命令语法 
 * ffmpeg [全局选项] {[输入文件选项] -i 输入文件} ... {[输出文件选项] 输出文件} ...即
 * ffmpeg [global_options] {[input_file_options] -i input_file} ... {[output_file_options] output_file} ...
 * 
    -i 设定输入流
    -f 设定输出格式
    -ss 开始时间 
    视频参数： 
    -b 设定视频流量，默认为200Kbit/s 
    -r 设定帧速率，默认为25 
    -s 设定画面的宽与高 
    -aspect 设定画面的比例 
    -vn 不处理视频 
    -vcodec 设定视频编解码器，未设定时则使用与输入流相同的编解码器 
    音频参数： 
    -ar 设定采样率 
    -ac 设定声音的Channel数 
    -acodec 设定声音编解码器，未设定时则使用与输入流相同的编解码器 
    -an 不处理音频

    -ss 00:00:06 -t 00:00:12 6秒开始，时长为12秒
    -vcodec copy -acodec copy : 编码格式不变
    -y 对输出文件进行覆盖
    -threads 2 以两个线程进行运行 加快处理的速度
    -vcode 编码格式libx264 
    -f 强迫采用格式fmt 
    -q:v 2 视频码率 提高抽取到的图片的质量的  
 */
class Ffmpegs extends Controller
{
    protected $ffmpeg = '';
    protected $ffprobe = '';
    protected $is_linux = false;

    protected function initialize() {
        if(strtoupper(substr(PHP_OS,0,3))!=='WIN'){
            $this->ffmpeg = 'ffmpeg';
            $this->ffprobe = 'ffprobe';      
            $this->is_linux = true;
        }else{
            $this->ffmpeg = 'D:/ffmpeg/bin/ffmpeg.exe';
            $this->ffprobe = 'D:/ffmpeg/bin/ffprobe.exe';
            $this->is_linux = false;
        }
        
        //overlay
    }
   
    public function index()
    { 
//        $url = 'static/ffmpeg/1.mp4';
//        $durl = 'static/ffmpeg/'. $this->randName() .'/1_image%d.jpg';
//        $this->videoToImg($url, $durl, 30);
//        
//        $url = 'static/ffmpeg/2.mp4';
//        $durl = 'static/ffmpeg/'. $this->randName() .'/2_image%d.jpg';
//        $this->videoToImg($url, $durl);
//        
//        

//        $durl2 = 'static/ffmpeg/1_1.mp4';
//        $this->imgToVideo($durl, $durl2, 30);
        
//        $url = 'static/ffmpeg/1.mp4';
//        $info = $this->videoInfo($url);
//        dump($info);
        
        
//        $durl2 = 'static/ffmpeg/1_1_1.mp4';
//        $source = [
//            'static/ffmpeg/1.mp4',
//            'static/ffmpeg/2.mp4'
//        ];
//        $this->concat($source, $durl2);
        
        $durl2 = 'static/ffmpeg/1_1_2.mp4';
        $source = [
            'static/ffmpeg/1.mp4',
            'static/ffmpeg/2.mp4'
        ];
        //$this->overlay($source, $durl2);
        
        
    }
    
    /**
     * 视频信息获取
        array(13) {
          ["duration"] => string(11) "00:00:15.21"      //视频长度
          ["seconds"] => float(15.21)                   //转为秒数
          ["start"] => string(8) "0.000000"             //开始时间
          ["bitrate"] => string(3) "555"                //码率 单位kb
                                                        //比特率 每秒传送的比特(bit)数。
                                                        //单位为 bps(Bit Per Second) 比特率越高，
                                                        //每秒传送数据就越多，画质就越清晰
          ["vcodec"] => string(31) "h264 (High) (avc1 / 0x31637661)" //-vcodec copy 编码格式
          ["vformat"] => string(7) "yuv420p"                        //视频格式
          ["resolution"] => string(7) "544x960"                     //分辨率 帧宽*帧高
          ["fps"] => string(7) "6"                                  //帧
          ["width"] => string(3) "544"                              //帧宽
          ["height"] => string(3) "960"                             //帧高
          ["acodec"] => string(28) "aac (LC) (mp4a / 0x6134706D)"   //音频编码
          ["asamplerate"] => string(5) "44100"                      //音频取样频率
          ["play_time"] => float(15.21)                             //实际播放时间
          ["size"] => int(1056806)                                  //视频文件大小
        }
     */
    private function videoInfo($file)
    { 
        //$file = 'static/ffmpeg/1.mp4';
        //$file = realpath($file);
        
        $str = "$this->ffmpeg -i $file";

        ob_start();
        //2>&1是将标准错误重定向到标准输出
        //ffmpeg -> At least one output file must be specified至少一个输出文件
        $str = $str . ' 2>&1';
        //执行外部程序并且显示原始输出
        passthru($str);
        $video_infos = $video_info = ob_get_contents();
        ob_end_clean();

//        $outfile = 'static/ffmpeg/' . md5(uniqid(rand())) . '.txt';
//        $str = $str . " 2>> $outfile";
//        //执行外部程序并且显示原始输出
//        passthru($str);
//        $video_info = file_get_contents($outfile);
//        @unlink($outfile);
        
        // 使用输出缓冲，获取ffmpeg所有输出内容
        $ret = array();
        
        $video_info = preg_replace('/\([^\(, ]*?, [^\), ]*?\)/', '', $video_info);

        // Duration: 00:33:42.64, start: 0.000000, bitrate: 152 kb/s
        if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $video_info, $matches)){
            $ret['duration'] = $matches[1]; // 视频长度
            $duration = explode(':', $matches[1]);
            $ret['seconds'] = $duration[0]*3600 + $duration[1]*60 + $duration[2]; // 转为秒数
            $ret['start'] = $matches[2]; // 开始时间
            $ret['bitrate'] = $matches[3]; // bitrate 码率 单位kb
        }

        // Stream #0:1: Video: rv20 (RV20 / 0x30325652), yuv420p, 352x288, 117 kb/s, 15 fps, 15 tbr, 1k tbn, 1k tbc
        // Stream #0:0(und): Video: h264 (Baseline) (avc1 / 0x31637661), yuv420p(tv, smpte170m/bt470bg/smpte170m), 720x1280, 5972 kb/s, 9.96 fps, 20.58 tbr, 1000k tbn, 2000k tbc (default)
        if(preg_match("/Video: (.*?), (.*?), (.*?), (.*?), (.*?) fps[,\s]/", $video_info, $matches)){
            $ret['vcodec'] = $matches[1];     // 编码格式
            $ret['vformat'] = $matches[2];    // 视频格式
            $ret['resolution'] = $matches[3]; // 分辨率
            $ret['fps'] = $matches[5]; // 帧
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
        $video_infos = iconv('gbk','UTF-8', $video_infos);
        return array($ret, $video_infos);
    }
    
    /**
     * 截图
     */
    public function printscreen($url, $durl, $ss, $t, $w , $h){
        
        //$url = 'static/ffmpeg/1.mp4';
        //$durl = 'static/ffmpeg/1_printscreen.jpg';

        $this->createDir($durl);
        $str = "$this->ffmpeg -i $url -y -f image2 -ss $ss -t $t -s " . $w . "x" . $h . " $durl";
        exec($str);
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
    
    
    /**
     * 视频转图片
     * @param type $url
     * @param type $durl
     * @return type
     */
    public function videoToImg($url, $durl, $r = 25){
        
        //$url = 'static/ffmpeg/1.mp4';
        //$durl = 'static/ffmpeg/img/1_image%d.jpg';
        
        $d = $this->getDir($durl);
        $this->removeDir($d);
        $this->createDir($durl);
        
        $str = "$this->ffmpeg -i $url -r $r $durl";
        
        exec($str);
        $imgName = glob($d);
        return $imgName?$imgName:[];
        
    }
    
    /**
     * 图片转视频
     * @param type $url
     * @param type $durl
     * @return boolean
     */
    public function imgToVideo($url, $durl, $r = 25){
        
        //$url = 'static/ffmpeg/img/1_image%d.jpg';
        //$durl = 'static/ffmpeg/1_1.mp4';
        
        $this->createDir($durl);
        
        $str = "$this->ffmpeg -y -r $r -f image2 -i $url -vcodec libx264 $durl";
        
        exec($str);
        
        $d = $this->getDir($url);
        $this->removeDir($d);
        return true; 
    }
    
    /**
     * 视频转ts
     * @param type $url
     * @param type $durl
     * @return boolean
     */
    public function videoToTs($url, $durl){
        
        //$url = 'static/ffmpeg/1.mp4';
        //$durl = 'static/ffmpeg/1_1_ts.ts';
        
        $this->createDir($durl);
        
        //mp4转成无损质量的ts
        $str = "$this->ffmpeg -i $url -vcodec copy -acodec copy -vbsf h264_mp4toannexb $durl";
        
        exec($str);
 
        return true; 
    }
    
    /**
     * 拼接
     */
    public function concat($source, $file) {
        $dir = "static/ffmpeg/". $this->randName();
        $this->createDir($dir.'/1.txt');
        $this->createDir($file);
        $ts  = '';
        foreach ($source as $k=>$v) {
            $tempFileName = "$dir/1_$k.ts";
            $str = "$this->ffmpeg -i $v -vcodec copy -acodec copy -vbsf h264_mp4toannexb $tempFileName";
            exec($str);
            $ts .= '|'.$tempFileName;
        }
        $ts = substr($ts, 1);
        $str = $this->ffmpeg . ' -y -i "concat:' . $ts . '" -acodec copy -vcodec copy -absf aac_adtstoasc ' . $file;
        exec($str);
        $this->removeDir($dir);
        //ffmpeg -i "concat:1.ts|2.ts" -acodec copy -vcodec copy -absf aac_adtstoasc output.mp4

    }
    
    /**
     * 视频覆盖
     * 命令的结构如下，input1是视频背景，input2是前景
     * ffmpeg -i input1 -i input2 -filter_complex overlay=x:y output 覆盖 左上角坐标x:y
     * ffmpeg -i pair.mp4 -i logo.png -filter_complex overlay pair1.mp4 左上角logo
     * overlay=W-w 右上 overlay=W-w:H-h 右下  overlay=0:H-h 左下
     * -itsoffset 5 5秒后加
     * 
     * 语法 overlay[=x:y[[:rgb={0, 1}]]参数x和y是可选的，其默认值为0 rgb参数是可选的，其值为0或1

        rgb rgb = 0…输入的颜色空间不改变，默认值 rgb = 1…输入的颜色空间设置为RGB
        main_w or W 主要输入宽度
        main_h or 
        overlay_w or w overlay输入宽度
        overlay_h or h overlay输
     */
    public function overlay($source, $file, $itsoffset = 0, $x = 0, $y = 0) {
        $this->createDir($file);
        $str = $this->ffmpeg . ' -y';
        foreach ($source as $k=>$v) {
            $str .= " -i $v";
        }
        if($itsoffset){
            $str .= " -itsoffset $itsoffset";
        }
        $str .= " -filter_complex overlay=$x:$y $file";
        exec($str);
        
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
        sleep(1);//等待删除
        return rmdir($dirName) ; 
    }
    
    

    public function createDir($fileName) 
    {
        $d = $this->getDir($fileName);
        if(!is_dir($d)){
            return mkdir ($d,0777,true);
        }
        return false;
    }
    
    public function getDir($fileName) 
    {
        return substr($fileName, 0, strrpos($fileName, '/'));
    }
    
    public function randName() {
        return md5(uniqid(rand()));
    }
}

