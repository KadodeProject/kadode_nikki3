<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Console\Command;

class GCSCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gcs:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GCSへバックアップデータを送るコマンド';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $client = new StorageClient();
        $bucket = $client->bucket(config('gcs.packet')); // 作成したバケット

        /**
         * ディレクトリハンドルの取得.
         *
         * @var null|resource
         */
        $dirH = opendir(storage_path('app/laravel-backup/'));

        while (false !== (
            // @var array|null
            $fileList[] = readdir($dirH)
        ));
        closedir($dirH);

        /*
         * $fileListは
         * ^ array:5 [
         *     0 => '2022-07-26-22-22-06.zip'
         *     1 => '2022-07-26-22-37-15.zip'
         *     2 => '..'
         *     3 => '.'
         *     4 => false
         *     ]
         * なので、後ろ3つを除く
         */
        array_splice($fileList, -3);

        // 最新ファイルの探索
        $timer = date_create_immutable_from_format('Y-m-d-H-i-s', '2021-10-20-07-16-00');
        $recentFile = '';
        foreach ($fileList as $newFile) {
            $dateFromName = mb_substr($newFile, 0, -4); // 時刻抽出(ファイル名から)
            $timeDate = date_create_immutable_from_format('Y-m-d-H-i-s', $dateFromName); // ファイルの更新日時を取得
            if ($timeDate > $timer) {
                $recentFile = $newFile; // 最新のCSVファイル
                $timer = $timeDate; // 最新の更新日時
            }
        }
        if ('' !== $recentFile) {
            $latestFile = $recentFile;

            /** @var null|resource|string */
            $uploadData = fopen(storage_path('app/laravel-backup/').$latestFile, 'r');
            $bucket->upload($uploadData);
            echo 'uploaded:'.$latestFile;
        } else {
            echo 'ファイルがありませんでした';
        }

        return Command::SUCCESS;
    }
}
