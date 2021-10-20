<?php
use Google\Cloud\Storage\StorageClient;

$client = new StorageClient();
$bucket = $client->bucket(env('GCS_PACKET')); // 作成したバケット名
$bucket->upload(
    fopen(storage_path('app/laravel-backup/*.zip'), 'r')
);