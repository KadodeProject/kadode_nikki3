<?php

namespace App\CustomFunction;





class throwPython
{
    public static function throwPython($py_file_name,$user_id,$error_check=false,$debug=false){
        if($error_check==true){
            //2>&1でエラーメッセージ出せる
            $path = "export LANG=ja_JP.UTF-8;python3"." ".env('PYTHON_FOLDER_DIR'). $py_file_name.".py". " ".$user_id." 2>&1 > /dev/null &";
        }else{
            $path = "export LANG=ja_JP.UTF-8;python3"." ".env('PYTHON_FOLDER_DIR'). $py_file_name.".py". " ".$user_id." > /dev/null &";
        }

        $output=null;
        exec($path, $output);//python実行

        if($debug==true){
            \Log::debug($path);
            \Log::debug("file_name:".$py_file_name);
            \Log::debug("python_output");
            \Log::debug($output);
        }

        return $output;
    }
}