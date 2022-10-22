<?php

declare(strict_types=1);

return [
    // python本体の実行パス
    'python_absolute_binary_path' => env('PYTHON_PRO_DIR', '/usr/bin/python3'),
    // python関連の実行ファイルが入ったフォルダのパス(末尾スラッシュつけて)
    'python_absolute_folder_path' => env('PYTHON_FOLDER_DIR', 'work/backend/python/'),
];
