# よくある障害集

## コンソールからは実行できるのにブラウザでは実行できない

-   laravel の env がちゃんと読めていない可能性があるので、デバッグ有効にして laravel.log に出すか laravel tinker で env 出してみる(このとき、だいたい config:cache 周りが原因)
-   PHP から exec 経由で実行する時は普段の SSH とユーザーが違うのでそのあたりが原因でないか確認する（一般ユーザーで pip して入れただけではだめ、現状利用だと sudo pip しないと入らないひどい仕様なので……)
