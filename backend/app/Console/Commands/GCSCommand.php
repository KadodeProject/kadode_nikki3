<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Cloud\Storage\StorageClient;

class GCSCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kadode:gcsBackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GCSへバックアップデータを送るコマンド';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new StorageClient();
        $bucket = $client->bucket(env('GCS_PACKET')); // 作成したバケット

        
        // ディレクトリハンドルの取得
        $dirH = opendir( storage_path('app/laravel-backup/')) ;
        while (false !== ($fileList[] = readdir($dirH))) ;
        closedir( $dirH ) ;
        
        //最新ファイルの探索
        $timer = 0;
        foreach ($fileList as $newFile) {
            $dateFromName=substr($newFile,0,-4);//時刻抽出
            var_dump($dateFromName);
            $timeDate = date( 'Y-m-d-H-i-s' ,strtotime($dateFromName));//ファイルの更新日時を取得
            if($timeDate > $timer)
            {
                $recentFile = $newFile;//最新のCSVファイル
                $timer = $timeDate;//最新の更新日時
            }
        }
        $latestFile = $recentFile;


        $bucket->upload(
            fopen( storage_path('app/laravel-backup/').$latestFile, 'r')
        );
        echo('uploaded:'.$latestFile);
        return Command::SUCCESS;
    }
}