<?php
namespace app\index\controller;

use think\Controller;


/**
 * zip解压 
 */
class Zip extends Controller
{
    
  
    
    
    public function index() {
        //部分zip文件解压能成功 -》exec系统命令解压
        
        //$this->unzip('static/zip/2132312.zip');
        
        //$src_file = 'static/zip/32423434.zip';
        //$this->unzip($src_file);
        
        //$src_file = 'static/zip/12.zip';
        $src_file = 'static/zip/332.zip';
        $this->unzip($src_file);
        
    }
    
    public function index2() {
    
        $zip = new \ZipArchive;
        $fileName = 'static/zip/332.zip';
        $savePath = 'static/zip/332/dsdf/sfd';
        
        $res = $zip->open(mb_convert_encoding($fileName, 'GBK', 'UTF-8'));

        if(!file_exists(mb_convert_encoding($savePath, 'GBK', 'UTF-8'))) {
           mkdir(mb_convert_encoding($savePath, 'GBK', 'UTF-8'), 0777, true);
        }
        $docnum = $zip->numFiles;
        for($i = 0; $i < $docnum; $i++) {
           $statInfo = $zip->statIndex($i);
           $name = $statInfo['name'];
           //echo "save: ".$name."<br />";
           
           if($statInfo['crc'] == 0) {
               //echo mb_convert_encoding($savePath.'/'.substr($name, 0,-1), 'GBK', 'UTF-8')."<br />";
               //新建目录
               mkdir(mb_convert_encoding($savePath.'/'.substr($name, 0,-1), 'GBK', 'UTF-8'), 0777, true);
           } else {
               //拷贝文件
               copy('zip://'.mb_convert_encoding($fileName.'#'.$name, 'GBK', 'UTF-8'), mb_convert_encoding($savePath.'/'.$name, 'GBK', 'UTF-8'));
           }
        }
    }
    
    /**
    * https://www.php.net/manual/zh/ref.zip.php
    * Unzip the source_file in the destination dir
    *
    * @param   string      The path to the ZIP-file.
    * @param   string      The path where the zipfile should be unpacked, if false the directory of the zip-file is used
    * @param   boolean     Indicates if the files will be unpacked in a directory with the name of the zip-file (true) or not (false) (only if the destination directory is set to false!)
    * @param   boolean     Overwrite existing files (true) or not (false)
    *  
    * @return  boolean     Succesful or not
    */
    function unzip($src_file, $dest_dir=false, $create_zip_name_dir=true, $overwrite=true) 
    {
//        try {
            $zip = zip_open($src_file);
            if ($zip && is_resource($zip))
            {
                $splitter = ($create_zip_name_dir === true) ? "." : "/";
                if ($dest_dir === false) $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter))."/";

                // Create the directories to the destination dir if they don't already exist
                $this->create_dirs($dest_dir);

                // For every file in the zip-packet
                while ($zip_entry = zip_read($zip)) 
                {
                    $name = zip_entry_name($zip_entry);
                    //echo $name."<br />";
                    //mb_convert_variables('GBK', 'UTF-8', $name);
                    //$name = mb_convert_encoding($name, 'GBK', 'UTF-8');
                    //$name = iconv("UTF-8","GBK//IGNORE",$name);//忽略错误继续执行
                    //$name = iconv("UTF-8", "GBK", $name);//忽略错误继续执行
                    
                    // Now we're going to create the directories in the destination directories

                    // If the file is not in the root dir
                    $pos_last_slash = strrpos($name, "/");
                    if ($pos_last_slash !== false)
                    {
                        // Create the directory where the zip-entry should be saved (with a "/" at the end)
                        $this->create_dirs($dest_dir.substr($name, 0, $pos_last_slash+1));
                    }


                    // The name of the file to save on the disk
                    $file_name = $dest_dir.$name;
                    echo "save: ".$file_name."<br />";
                    if(!is_dir($file_name)){
                    // Open the entry
                        if (zip_entry_open($zip,$zip_entry,"r")) 
                        {

                            // Check if the files should be overwritten or not
                            if ($overwrite === true || $overwrite === false && !is_file($file_name))
                            {
                                // Get the content of the zip entry
                                $fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
                                echo "save2: ".$file_name."<br />";
                                file_put_contents($file_name, $fstream );
                                // Set the rights
                                chmod($file_name, 0777);
                               // echo "save: ".$file_name."<br />";
                            }

                            // Close the entry
                            zip_entry_close($zip_entry);
                        }     
                    }
                }
                // Close the zip-file
                zip_close($zip);

            } else {
                return false;
            }
//        } catch (\Exception $e) {
//            echo $e->getMessage();
//            return false;
//        }
        return true;
    }

    /**
    * This function creates recursive directories if it doesn't already exist
    *
    * @param String  The path that should be created
    *  
    * @return  void
    */
    function create_dirs($path)
    {
        if (!is_dir($path))
        {
            $directory_path = "";
            $directories = explode("/",$path);
            array_pop($directories);

            foreach($directories as $directory)
            {
                $directory_path .= $directory."/";
                if (!is_dir($directory_path))
                {
                    //echo $directory_path."<br />";
                    mkdir($directory_path);
                    chmod($directory_path, 0777);
                }
            }
        }
    }

   
}


