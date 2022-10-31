<?php

declare(strict_types=1);

return [
    // GCP google could storageのパケット名
    'packet' => env('GCS_PACKET', 'kadode'),
    'keyPath' => env('GOOGLE_APPLICATION_CREDENTIALS', ''),
    // 'notificationEmail' => env('BACKUP_NOTIFICATION_EMAIL_TO', ''),
    // 'uploadBackupPath' => env('SERVER_BACKUP_PATH', ''),
];
