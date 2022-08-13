# wsl の停止コマンド

```
wsl --shutdown
```

# wsl のメモリサイズ変更

ユーザー/.wslconfig

```
[wsl2]
memory=1.5GB

```

小さすぎると Laravel Dusk が

```
Facebook\WebDriver\Exception\InvalidSessionIdException: invalid session id
```

で落ちる(1GB だと無理、1.5GB ならいける)
