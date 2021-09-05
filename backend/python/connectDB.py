import MySQLdb
import loadEnv

"""
データベースに接続して、引数のユーザーIDのすべての日記(id,本文,タイトル)を取得
"""
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
    sql = "SELECT id,title,content,date FROM diaries WHERE user_id="+user_id+";"
    cur.execute(sql)

    # 実行結果をすべて取得する
    rows = cur.fetchall()

    
    # カーソルを閉じる
    cur.close()

    # 接続を閉じる
    conn.close()

    return rows
    """
    [[id,タイトル,本文,日付],.......]
    """

"""
解析済みのデータを書き込む
"""
def rewrite_to_db():
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
    sql = "SELECT id,title,content,date FROM diaries WHERE user_id="+user_id+";"
    cur.execute(sql)

    # 実行結果をすべて取得する
    rows = cur.fetchall()

    
    # カーソルを閉じる
    cur.close()

    # 接続を閉じる
    conn.close()

if __name__=="__main__":

    rows=get_all_diaries_from_user("3")
    for row in rows:
        for column in row:
            print(column)
