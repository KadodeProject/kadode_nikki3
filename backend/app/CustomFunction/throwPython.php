<?php

namespace App\CustomFunction;





class throwPython
{

    /**
     * ファイル名指定で実行する場合
     *
     * @param [type] $py_file_name
     * @param [type] $user_id
     * @param boolean $error_check
     * @param boolean $debug
     * @return void
     */
    public static function throwPython($py_file_name,$user_id,$error_check=false,$debug=false){
        //execで渡しているのはユーザー名のみ
        // user_idは自動付け、.envはlinux側でのみ編集可能なのでOSコマンドインジェクションのリスクなし
        if($error_check==true){
            //2>&1でエラーメッセージ出せる
            $path = "export LANG=ja_JP.UTF-8;cpulimit -l ".env('CPU_LIMIT')." python3"." ".env('PYTHON_FOLDER_DIR'). $py_file_name.".py". " ".$user_id." 2>&1 > /dev/null &";
        }else{
            $path = "export LANG=ja_JP.UTF-8;cpulimit -l ".env('CPU_LIMIT')." python3"." ".env('PYTHON_FOLDER_DIR'). $py_file_name.".py". " ".$user_id." > /dev/null &";
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
    /**
     * 2021/9/21
     * python側で呼び出さないと、並列処理になってしまい各所でバグの温床になるので、一括実行へ変更
     *
     *
     * @param [type] $user_id
     * @param boolean $error_check
     * @param boolean $debug
     * @return void
     */
    public static function throwNlpToPython($user_id,$error_check=false,$debug=false){

        if($error_check==true){
            //2>&1でエラーメッセージ出せる
            $path = "export LANG=ja_JP.UTF-8;cpulimit -l ".env('CPU_LIMIT')." python3"." ".env('PYTHON_FOLDER_DIR')."pythonUseFromPHP.py". " ".$user_id." 2>&1 > /dev/null &";
        }else{
            $path = "export LANG=ja_JP.UTF-8;cpulimit -l ".env('CPU_LIMIT')." python3"." ".env('PYTHON_FOLDER_DIR')."pythonUseFromPHP.py". " ".$user_id." > /dev/null &";
        }

        $output=null;
        exec($path, $output);//python実行

        if($debug==true){
            \Log::debug($path);
            \Log::debug("file_name:");
            \Log::debug("python_output");
            \Log::debug($output);
        }

        return $output;
    }
}