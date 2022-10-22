<?php

declare(strict_types=1);

namespace App\UseCases\Statistic;

use Log;

/**
 * exec経由でpythonに自然言語処理を投げるクラス.
 */
class ThrowPythonNLP
{
    /**
     * 2021/9/21
     * python側で呼び出さないと、並列処理になってしまい各所でバグの温床になるので、一括実行へ変更←どういうこと？
     * $user_idの日記の自然言語処理を走らせる
     * デフォルト引数だけ変えればデバッグできるようにする
     *  $error_checkと$debugを有効にするとlaravel.logで実行結果とenv値見れるようになる.
     */
    public static function invoke(int $user_id, bool $error_check = false, bool $debug = false): array
    {
        if ($error_check) {
            // 2>&1でエラーメッセージ出せる
            $path = 'export LANG=ja_JP.UTF-8; '.config('nlp.python_absolute_binary_path').' '.config('nlp.python_absolute_folder_path').'pythonUseFromPHP.py '.$user_id.' 2>&1';
        } else {
            // > /dev/null & すると非同期で実行できる
            $path = 'export LANG=ja_JP.UTF-8; '.config('nlp.python_absolute_binary_path').' '.config('nlp.python_absolute_folder_path').'pythonUseFromPHP.py '.$user_id.' > /dev/null &';
        }

        $output = [];
        exec($path, $output); // python実行

        if ($debug) {
            Log::debug($path);
            Log::debug('python_path:'.config('nlp.python_absolute_binary_path'));
            Log::debug('python_folder_dir:'.config('nlp.python_absolute_folder_path'));
            Log::debug('python_output:');
            Log::debug($output);
            // \Log::debug("command_output:");
            // \Log::debug($return_var);
        }

        return $output;
    }
}
