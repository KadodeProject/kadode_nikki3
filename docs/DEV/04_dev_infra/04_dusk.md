# Laravel Dusk(ブラウザテスト)エラー対応

## invalid session id

```
Facebook\WebDriver\Exception\InvalidSessionIdException: invalid session id
```

メモリ不足。WSL の割当を増やしたりすることで減らせる。

## Cannot read properties of undefined

```
Facebook\WebDriver\Exception\JavascriptErrorException: javascript error: Cannot read properties of undefined (reading 'click')
(Session info: headless chrome=103.0.5060.134)
```

不明。
