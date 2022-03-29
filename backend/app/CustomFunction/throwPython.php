<?php

namespace App\CustomFunction;





class throwPython
{
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
    public static function throwNlpToPython($user_id, $error_check = false, $debug = false)
    {

        if ($error_check) {
            //2>&1でエラーメッセージ出せる
            // sourceコマンドは.←これ
            //> /dev/null & すると非同期で実行できる
            $path = "export LANG=ja_JP.UTF-8;. " . env('PYTHON_VENV_DIR') . "kadode_py/bin/activate &&" . env('PYTHON_PRO_DIR') . " " . env('PYTHON_FOLDER_DIR') . "pythonUseFromPHP.py " . $user_id . " && deactivate 2>&1";
        } else {
            $path = "export LANG=ja_JP.UTF-8;. " . env('PYTHON_VENV_DIR') . "kadode_py/bin/activate &&" . env('PYTHON_PRO_DIR') . " " . env('PYTHON_FOLDER_DIR') . "pythonUseFromPHP.py" . " " . $user_id . " && deactivate > /dev/null &";
        }
        $output = null;
        // $path = "export LANG=ja_JP.UTF-8;python3 " . env('PYTHON_PRO_DIR') . " " . env('PYTHON_FOLDER_DIR') . "pythonUseFromPHP.py" . " " . $user_id . " > /dev/null &";
        // dd($path);
        exec($path, $output); //python実行

        if ($debug) {
            \Log::debug($path);
            \Log::debug("file_name:" . env('PYTHON_VENV_DIR') . "pythonUseFromPHP.py");
            \Log::debug("python_output:");
            \Log::debug($output);
            // \Log::debug("command_output:");
            // \Log::debug($return_var);
        }

        return $output;
    }
}