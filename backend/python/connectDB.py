import MySQLdb
import loadEnv


def get_all_diaries_from_user(user_id):
    # 接続する
    conn = MySQLdb.connect(
    user=loadEnv.DB_USERNAME,
    passwd=loadEnv.DB_PASSWORD,
    host=loadEnv.DB_HOST,
    db=loadEnv.DB_DATABASE,
    charset="utf8"
    )

    # カーソルを取得する
    cur= conn.cursor()

    # クエリを実行する
    sql = "select * from diaries WHERE user_id="+user_id+";"
    cur.execute(sql)

    # 実行結果をすべて取得する
    rows = cur.fetchall()

    # 一行ずつ表示する
    for row in rows:
        print(row)
    
    # カーソルを閉じる
    cur.close()

    # 接続を閉じる
    conn.close()

if __name__=="__main__":
    get_all_diaries_from_user("3")