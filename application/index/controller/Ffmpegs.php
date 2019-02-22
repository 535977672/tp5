<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use Exception;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Filters\Video\ExtractMultipleFramesFilter;


class ffmpegs extends Controller
{
    
    public function index()
    { 
        require '../vendor/autoload.php';
        $url = 'D:/mf/test/ffmpeg/test/img/1.mp4';
        $p = 'D:/mf/test/ffmpeg/test/img/1c.jpg';
        $str = "C:/Windows/System32/ffmpeg.exe -i $url -y -f image2 -t 0.001 -s 350x240 $p";

        $ffmpeg = \FFMpeg\FFMpeg::create([
             'ffmpeg.binaries' => 'C:/Windows/System32/ffmpeg',
            'ffprobe.binaries' => 'C:/Windows/System32/ffprobe',
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ]);
//        $video = $ffmpeg->open($url);
//        $video
//            ->filters()
//            ->resize(new \FFMpeg\Coordinate\Dimension(320, 240))->synchronize();
//
//        $video
//            ->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10))
//            ->save('D:/mf/test/ffmpeg/test/img/frame.jpg');
//
//        $video
//            ->save(new \FFMpeg\Format\Video\X264(), 'D:/mf/test/ffmpeg/test/img/export-x264.mp4')
//            ->save(new \FFMpeg\Format\Video\WMV(), 'D:/mf/test/ffmpeg/test/img/export-wmv.wmv')
//            ->save(new \FFMpeg\Format\Video\WebM(), 'D:/mf/test/ffmpeg/test/img/export-webm.webm'); 
//        
    }
    
  
}


