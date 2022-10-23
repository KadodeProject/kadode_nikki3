# 稼働状況把握

## コア機能の利用状況推移

### 実行タイミングでの日記数やユーザー数を DB に格納

```
php artisan operationCoreTransition:generate
```

### 取得

-   api/OperationCoreTransitionPerHours/relative/day
-   api/OperationCoreTransitionPerHours/relative/week
-   api/OperationCoreTransitionPerHours/relative/month

## サーバーの負荷状況
