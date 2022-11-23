# 稼働状況把握

## コア機能の利用状況推移

### 実行タイミングでの日記数やユーザー数を DB に格納

```
php artisan measure:operationCoreTransitionToDB
```

### 取得

-   api/OperationCoreTransitionPerHours/relative/day
-   api/OperationCoreTransitionPerHours/relative/week
-   api/OperationCoreTransitionPerHours/relative/month

## サーバーの負荷状況

```
php artisan measure:machineResourceFor1minToRedis
```

※ローカルの Docker 環境では htop,free,df が実行できないため 0 となる

### 取得

-   api/MachineResource/relative/30min
