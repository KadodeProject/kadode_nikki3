import MySQLdb
from base import loadEnv
import json

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
    sql = "SELECT id,title,content,date FROM diaries WHERE user_id="+str(user_id)+";"
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
def rewrite_to_db(user_id):
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


def set_statistics_json(user_id, column_name, value):
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
    print(  'UPDATE statistics SET '+column_name+' = '+json.dumps(value,ensure_ascii=False)+' where user_id = '+str(user_id)+';')
    # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま自家絵やり倒す
    json_value = json.dumps(value,ensure_ascii=False)
    cur.execute(
            'UPDATE statistics SET {0} = %s WHERE user_id = %s;'.format(column_name),(json_value,user_id))


    # 保存する
    conn.commit()

    
    # カーソルを閉じる
    cur.close()

    # 接続を閉じる
    conn.close()


def set_statistic_progress_100(user_id, table_name):
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
    cur.execute(
            'UPDATE %s SET statistic_progress = 100 where user_id = %s;',(table_name,user_id))


    # 保存する
    conn.commit()

    
    # カーソルを閉じる
    cur.close()

    # 接続を閉じる
    conn.close()


if __name__=="__main__":

    rows=get_all_diaries_from_user("3")
    for row in rows:
        for column in row:
            print(column)
