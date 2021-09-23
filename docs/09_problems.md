# ローカル mysql

## MySQL の cnf ファイルが反映されない

infra>mysql>my.cnf を読み取り専用にする(エクスプローラーからプロパティ開いてチェック)

https://yama-weblog.com/why-my-cnf-does-not-work-in-docker/

## いつもは動くのにエラーになる

update で動かしてるから、カラムがない場合はそもそも作れない

## MySQLdb.\_exceptions.OperationalError: (2006, '')

https://pickles-ochazuke.hatenablog.com/entry/2017/12/09/164921

# Python

## 型確認

type()

### 型変換

str()
