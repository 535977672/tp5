<?php
namespace app\index\controller;

use think\Controller;

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
 *  -i 设定输入流
 *  -f 设定输出格式
 *  -ss 开始时间 
 *  视频参数： 
 *  -b 设定视频流量，默认为200Kbit/s 
 *  -r 设定帧速率，默认为25 
 *  -s 设定画面的宽与高 
 *  -aspect 设定画面的比例 
 *  -vn 不处理视频 
 *  -vcodec 设定视频编解码器，未设定时则使用与输入流相同的编解码器 
 *  音频参数： 
 *   -ar 设定采样率 
 *  -ac 设定声音的Channel数 
 *  -acodec 设定声音编解码器，未设定时则使用与输入流相同的编解码器 
 *  -an 不处理音频
 *  
 *   -ss 00:00:06 -t 00:00:12 6秒开始，时长为12秒
 *  -vcodec copy -acodec copy : 编码格式不变
 *  -y 对输出文件进行覆盖
 *  -threads 2 以两个线程进行运行 加快处理的速度
 *  -vcode 编码格式libx264 
 *  -f 强迫采用格式fmt 
 *  -q:v 2 视频码率 提高抽取到的图片的质量的  
 * 
 * 读取文件有两种方式:一种是直接读取,文件被迅速读完;一种是按时间戳读取。一般都是按时间戳读取文件
 * -re -i，表示按时间戳读取文件
 * -shortest 当最短的输入流结束后即停止编码和输出 shortest=1就是当输入停止的时候延迟1秒结束
 * nullsrc=s=256x256 nullsrc作为视频源，宽高为256x256， 默认绿屏 
 * '-vf "delogo=x=15:y=5:w=320:h=120:show=1" 去logo,show=1,显示确认框确认坐标
 * overlay=0+t*20:0 这里在x坐标上加上了+t*10，于是水印就会慢慢向右边移动 t=2时x=40
 * overlay=x='if(gte(t,2),10,NAN)':(main_h-overlay_h)/2 特定时间显示水印
 * if(条件,条件为true时的值,条件为false时的值)
 * 
 *  选项
 *  - -y / -n
 *  - -codec(-c)
 *  - -ss
 *  - -t
 *   - -to
 *  - -f
 *  - -filter / -filter_complex
 *  - -vframes
 *  - -vn
 *  - -r
 *  - -s
 *  - -an
 *  - -threads
 *  - -shortest
 *      filter
 *      scale
 *      crop
 *      overlay
 *      drawtext
 *      fade
 *      fps
fade
•type, t
指定类型是in代表淡入，out代表淡出，默认为in

•start_frame, s
指定应用效果的开始时间，默认为0.

•nb_frames, n
应用效果的最后一帧序数。
对于淡入，在此帧后将以本身的视频输出，对于淡出此帧后将以设定的颜色输出，默认25.

•alpha
如果设置为1，则只在透明通道实施效果（如果只存在一个输入），默认为0

•start_time, st
指定按秒的开始时间戳来应用效果。
如果start_frame和start_time都被设置，则效果会在更后的时间开始，默认为0

•duration, d
按秒的效果持续时间。
对于淡入，在此时后将以本身的视频输出，对于淡出此时后将以设定的颜色输出。
如果duration和nb_frames同时被设置，将采用duration值。默认为0（此时采用nb_frames作为默认）

•color, c
设置淡化后（淡入前）的颜色，默认为"black".
•30帧开始淡入
fade=in:0:30
•等效上面
fade=t=in:s=0:n=30
•在200帧视频中从最后45帧淡出
fade=out:155:45 fade=type=out:start_frame=155:nb_frames=45
•对1000帧的视频25帧淡入，最后25帧淡出:
fade=in:0:25, fade=out:975:25
•让前5帧为黄色，然后在5-24淡入:
fade=in:5:20:color=yellow
•仅在透明通道的第25开始淡入
fade=in:0:25:alpha=1
•设置5.5秒的黑场，然后开始0.5秒的淡入:
fade=t=in:st=5.5:d=0.5












 */
class Ffmpegs extends Controller
{
    protected $ffmpeg = '';
    protected $ffprobe = '';
    protected $is_linux = false;
    protected $debug = false;

    protected function initialize() {
        if(strtoupper(substr(PHP_OS,0,3))!=='WIN'){
            $this->ffmpeg = 'ffmpeg -threads 8';
            $this->ffprobe = 'ffprobe -threads 8';      
            $this->is_linux = true;
        }else{
            $this->ffmpeg = 'D:/ffmpeg/bin/ffmpeg.exe -threads 8';
            $this->ffprobe = 'D:/ffmpeg/bin/ffprobe.exe -threads 8';
            $this->is_linux = false;
            $this->debug = true;
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
        
//        $url = 'static/ffmpeg/1.mp4';
//        $dts = 'static/ffmpeg/'. $this->randName() .'/1_ts.ts';
//        $this->videoToTs($url, $dts);
//        $durl = 'static/ffmpeg/'. $this->randName() .'/1_image%d.jpg';
//        $this->videoToImg($dts, $durl, 30);
        $durl = 'static/ffmpeg/1/1_image%d.jpg';
        $durl2 = 'static/ffmpeg/1_1.mp4';
        $this->imgToVideo($durl, $durl2, 30, false);
        
//        $url = 'static/ffmpeg/1.mp4';
//        $info = $this->videoInfo($url);
//        dump($info);
        
        
//        $durl2 = 'static/ffmpeg/1_1_1.mp4';
//        $source = [
//            'static/ffmpeg/1.mp4',
//            'static/ffmpeg/2.mp4'
//        ];
//        $this->concat($source, $durl2);
        
//        $durl2 = 'static/ffmpeg/1_1_2.mp4';
//        $source = [
//            'static/ffmpeg/1.mp4',
//            'static/ffmpeg/2.mp4'
//        ];
//        $this->overlay($source, $durl2, 0, 50, 50);
        
//        $source =  'static/ffmpeg/1.mp4';
//        $file = 'static/ffmpeg/1_logo.mp4';
//        $file2 = 'static/ffmpeg/1_logo2.mp4';
//        $info = $this->videoInfo($source);
//        $this->logo($source, $file, 15, 15, 330, 120);
//        $this->logo($file, $file2, $info[0]['width']-345, $info[0]['height']-135, 330, 120);
        
//        $source =  'static/ffmpeg/1.mp4';
//        $file = 'static/ffmpeg/1_copy.mp4';
//        $info = $this->videoInfo($source);
//        $this->copy($source, $file, 3, 5);
        
        
        
    }
    
    public function test1() {
        $source =  'static/ffmpeg/1.mp4';
        
        $file = 'static/ffmpeg/'. $this->randName() .'.mp4';
        $file2 = 'static/ffmpeg/'. $this->randName() .'.mp4';
        $info = $this->videoInfo($source);
        $this->logo($source, $file, 15, 15, 330, 120);
        $this->logo($file, $file2, $info[0]['width']-345, $info[0]['height']-135, 330, 120);
        
        $file3 = 'static/ffmpeg/'. $this->randName() .'.mp4';
        $info = $this->overlay4($file2,$file3);
        
        $file4 = 'static/ffmpeg/1_overlay4_2.mp4';
        $info = $this->overlay2([$file3,$file2,$file2],$file4);
        @unlink($file);
        @unlink($file2);
        @unlink($file3);
    }
    
    public function test2() {
        $source =  'static/ffmpeg/1.mp4';
        $file = 'static/ffmpeg/1_logo.mp4';
        $file2 = 'static/ffmpeg/1_logo2.mp4';
        $info = $this->videoInfo($source);
        $this->logo($source, $file, 15, 15, 330, 120);
        $this->logo($file, $file2, $info[0]['width']-345, $info[0]['height']-135, 330, 120);
        
        $info = $this->videoInfo($file2);
        $w = $info[0]['width'];
        $h = $info[0]['height'];
        
        $file3 =  'static/ffmpeg/1_overlay_2.mp4';
        //视频覆盖+移动
        $str = $this->ffmpeg . " -y -re -i $file2 -re -i $file2 -re -i $file2 -re -i $file2 -re -i $file2 " 
                . '-filter_complex "'
                . '[1:v] setpts=PTS-STARTPTS, scale='. $w*4/5 .'x'. $h*4/5 .' [ov1]; '
                . '[2:v] setpts=PTS-STARTPTS, scale='. $w*3/5 .'x'. $h*3/5 .' [ov2]; '
                . '[3:v] setpts=PTS-STARTPTS, scale='. $w*2/5 .'x'. $h*2/5 .' [ov3]; '
                . '[4:v] setpts=PTS-STARTPTS, scale='. $w*1/5 .'x'. $h*1/5 .' [ov4]; '
                . '[0:v] [ov1] overlay=shortest=1:x=\'if(gte(t,3),'. $w/10 .',NAN)\':y=\'if(gte(t,5),(t-5)*30+'. $h/10 .',NAN)\' [tmp1]; '
                . '[tmp1] [ov2] overlay=shortest=1:x=\'if(gte(t,5),'. $w/5 .',NAN)\':y=\'if(gte(t,7),'. $h/5 .'-(t-7)*40,NAN)\' [tmp2]; '
                . '[tmp2] [ov3] overlay=shortest=1:x=\'if(gte(t,7), (t-7)*50+'. $w*3/10 .',NAN)\':y=\'if(gte(t,9),(t-9)*50+'. $h*3/10 .',NAN)\' [tmp3]; '
                . '[tmp3] [ov4] overlay=shortest=1:x=\'if(gte(t,9),'. $w*4/10 .'-(t-9)*60,NAN)\':y=\'if(gte(t,11),(t-11)*60+'. $h*4/10 .',NAN)\'" '
                . $file3;
        //echo $str;
        $this->execDebug($str);
    }
    
    public function test3() {
        $source =  'static/ffmpeg/1.mp4';
        $file = 'static/ffmpeg/1_logo.mp4';
        $file2 = 'static/ffmpeg/1_logo2.mp4';
        $info = $this->videoInfo($source);
        $this->logo($source, $file, 15, 15, 330, 120);
        $this->logo($file, $file2, $info[0]['width']-345, $info[0]['height']-135, 330, 120);
        
        $file2 = 'static/ffmpeg/1_logo2.mp4';
        $info = $this->videoInfo($file2);
        $w = $info[0]['width'];
        $h = $info[0]['height'];
        
        $file3 =  'static/ffmpeg/1_overlay_3.mp4';
        //视频覆盖+移动+淡入+曲线移动
        $str = $this->ffmpeg . " -y -re -i $file2 -re -i $file2 -re -i $file2 -re -i $file2 -re -i $file2 " 
                . '-filter_complex "'
                . '[1:v] setpts=PTS-STARTPTS, scale=width='. $w*0.8 .':height='. $h*0.8 .', fade=in:d=3:n=100 [ov1]; '
                . '[2:v] setpts=PTS-STARTPTS, scale='. $w*3/5 .'x'. $h*3/5 .' [ov2]; '
                . '[3:v] setpts=PTS-STARTPTS, scale='. $w*2/5 .'x'. $h*2/5 .' [ov3]; '
                . '[4:v] setpts=PTS-STARTPTS, scale='. $w*1/5 .'x'. $h*1/5 .' [ov4]; '
                . '[0:v] [ov1] overlay=shortest=1:x=\'if(gte(t,3),'. $w/10 .',NAN)\':y=\'if(gte(t,5),(t-5)*40+'. $h/10 .','. $h/10 .')\' [tmp1]; '
                . '[tmp1] [ov2] overlay=shortest=1:x=\'if(gte(t,5),'. $w/5 .',NAN)\':y=\'if(gte(t,7),'. $h/5 .'-(t-7)*50,'. $h/5 .')\' [tmp2]; '
                . '[tmp2] [ov3] overlay=shortest=1:x=\'if(gte(t,7), (t-7)*60+'. $w*3/10 .',NAN)\':y=\'if(gte(t,9),(t-9)*60+'. $h*3/10 .','. $h*3/10 .')\' [tmp3]; '
                . '[tmp3] [ov4] overlay=shortest=1:x=\'if(gte(t,9),'. $w*4/10 .'-sin(1.5*t)*'. $w/2 .',NAN)\':y=\'if(gte(t,11),(t-11)*80+'. $h*4/10 .','. $h*4/10 .')\'" '
                . $file3;
        //echo $str;
        $this->execDebug($str);
    }
    
    public function overlay2($sou, $file) {
        //$source =  'static/ffmpeg/1.mp4';
        //$file = 'static/ffmpeg/1_9_overlay2.mp4';
        
        if(is_array($sou)){
            $source1 = $sou[1];
            $source2 = $sou[2];
            $source = $sou[0];
        }else{
            $source1 = $source2 = $source = $sou;
        }
        
        $info = $this->videoInfo($source);
        $w = $info[0]['width'];
        $h = $info[0]['height'];
        $w2 = $w/2;
        $h2 = $h/2;
        $h4 = $h/4;
        
        $str = $this->ffmpeg . " -y -re -i $source -re -i $source1 -re -i $source2 " 
            . '-filter_complex "[1:v] setpts=PTS-STARTPTS, scale='. $w2 .'x'. $h2 .' [left]; [2:v] setpts=PTS-STARTPTS, scale='. $w2 .'x'. $h2 .' [right]; [0:v] [left] overlay=shortest=1:x=0:y='. $h4 .' [tmp1]; [tmp1][right] overlay=shortest=1:x='. $w2 .':y='. $h4 .'" '
            . $file;
        
        $this->execDebug($str);
    }
    
    public function overlay4($source, $file) {
        //$source =  'static/ffmpeg/1.mp4';
        //$file = 'static/ffmpeg/1_9_overlay4.mp4';
        
        $info = $this->videoInfo($source);
        $w = $info[0]['width'];
        $h = $info[0]['height'];
        $w2 = $w/2;
        $h2 = $h/2;
        
        $str = $this->ffmpeg . " -y -re -i $source -re -i $source  -re -i $source  -re -i $source " 
        . '-filter_complex "nullsrc=size='. $w .'x'. $h .' [base];'
        . '[0:v] setpts=PTS-STARTPTS, scale='. $w2 .'x'. $h2 .' [upperleft]; '
        . '[1:v] setpts=PTS-STARTPTS, scale='. $w2 .'x'. $h2 .' [upperright]; '
        . '[2:v] setpts=PTS-STARTPTS, scale='. $w2 .'x'. $h2 .' [lowerleft]; '
        . '[3:v] setpts=PTS-STARTPTS, scale='. $w2 .'x'. $h2 .' [lowerright]; '
        . '[base] [upperleft] overlay=shortest=1:x=0:y=0 [tmp1]; '
        . '[tmp1] [upperright] overlay=shortest=1:x='. $w2 .':y=0 [tmp2]; '
        . '[tmp2] [lowerleft] overlay=shortest=1:x=0:y=' . $h2 .' [tmp3]; '
        . '[tmp3] [lowerright] overlay=shortest=1:x='. $w2 .':y='. $h2 .' " '
        . $file;
        
       $this->execDebug($str);
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
        $video_info = preg_replace('/\[(.*?)\]/', '', $video_info);

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
        // Stream #0:0(und): Video: h264 (High) (avc1 / 0x31637661), yuv420p, 720x1280 [SAR 1:1 DAR 9:16], 1390 kb/s, 25 fps, 25 tbr, 12800 tbn, 50 tbc (default)
        if(preg_match("/Video: (.*?), (.*?), (.*?), (.*?), (.*?) fps[,\s]/", $video_info, $matches)){
            $ret['vcodec'] = $matches[1];     // 编码格式
            $ret['vformat'] = $matches[2];    // 视频格式
            $ret['resolution'] = $matches[3]; // 分辨率
            $ret['fps'] = $matches[5]; // 帧
            list($width, $height) = explode('x', $matches[3]);
            $ret['width'] = floatval($width);
            $ret['height'] = floatval($height);
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
        $this->execDebug($str);
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
        
        $this->execDebug($str);
        $imgName = glob($d);
        return $imgName?$imgName:[];
        
    }
    
    /**
     * 图片转视频
     * @param type $url
     * @param type $durl
     * @return boolean
     */
    public function imgToVideo($url, $durl, $r = 25, $del = true){
        
        //$url = 'static/ffmpeg/img/1_image%d.jpg';
        //$durl = 'static/ffmpeg/1_1.mp4';
        
        $this->createDir($durl);
        
        $str = "$this->ffmpeg -y -f image2 -i $url -r $r  -vcodec h264 $durl";
        
        $this->execDebug($str);
        
        $d = $this->getDir($url);
        if($del) $this->removeDir($d);
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
        
        $this->execDebug($str);
 
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
            $this->execDebug($str);
            $ts .= '|'.$tempFileName;
        }
        $ts = substr($ts, 1);
        $str = $this->ffmpeg . ' -y -i "concat:' . $ts . '" -acodec copy -vcodec copy -absf aac_adtstoasc ' . $file;
        $this->execDebug($str);
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
        $this->execDebug($str);
        
    }
    
    /**
     * 去logo
     * '-vf "delogo=x=15:y=5:w=320:h=120:show=1" 去logo,show=1,显示确认框确认坐标
     */
    public function logo($source, $file, $x = 0, $y = 0, $w = 0, $h = 0) {
        $this->createDir($file);
        $str = $this->ffmpeg . " -y -i $source " 
            . '-vf "delogo=x='. $x .':y='. $y .':w='. $w .':h='. $h .'" '
            . $file;
        $this->execDebug($str);
        
    }
    
    /**
     * 剪切
     * ffmpeg -ss 00:00:01 -t 00:00:10 -i input.mp4 -vcodec copy -acodec copy output.mp4
     * -ss开始时间 -ss要在-i之前
     * -t 时长
     * -vcodec copy -acodec copy 编码格式不变
     */
    public function copy($source, $file, $ss = '00:00:01', $t = '00:00:01') {
        $this->createDir($file);
        $str = $this->ffmpeg . " -y  -ss $ss -t $t -i $source -vcodec copy -acodec copy $file";
        $this->execDebug($str);
        
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
    
    public function execDebug($str){
        if($this->debug){
            ob_start();
            $str = $str . ' 2>&1';
            //执行外部程序并且显示原始输出
            passthru($str);
            $re = ob_get_contents();
            ob_end_clean();
            dump($re);
        }else{
            exec($str);
        }
    }
}

