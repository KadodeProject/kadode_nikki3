<?php
namespace App\CustomFunction;
use Google\Cloud\Storage\StorageClient;

$client = new StorageClient();
$bucket = $client->bucket(env('GCS_PACKET')); // 作成したバケット名
$bucket->upload(
    fopen(storage_path('2021-10-20-10-26-00.zip'), 'r')
);