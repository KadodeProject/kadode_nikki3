<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

class ThrowPythonNLP
{
    /**
     * 2021/9/21
     * python側で呼び出さないと、並列処理になってしまい各所でバグの温床になるので、一括実行へ変更←どういうこと？
     * $user_idの日記の自然言語処理を走らせる
     */
    public static function invoke(int $user_id, bool $error_check = false, bool $debug = false): array
    {

        if ($error_check) {
            //2>&1でエラーメッセージ出せる
            $path = "export LANG=ja_JP.UTF-8; " . env('PYTHON_PRO_DIR') . " " . env('PYTHON_FOLDER_DIR') . "pythonUseFromPHP.py " . $user_id . " 2>&1";
        } else {
            //> /dev/null & すると非同期で実行できる
            $path = "export LANG=ja_JP.UTF-8; " . env('PYTHON_PRO_DIR') . " " . env('PYTHON_FOLDER_DIR') . "pythonUseFromPHP.py" . " " . $user_id . " > /dev/null &";
        }

        $output = [];
        exec($path, $output); //python実行

        if (true) {
            var_dump($path);
            var_dump("file_name:" . env('PYTHON_VENV_DIR') . "pythonUseFromPHP.py");
            var_dump("python_output:");
            var_dump($output);
            // \Log::debug("command_output:");
            // \Log::debug($return_var);
        }
        return $output;
    }
}
