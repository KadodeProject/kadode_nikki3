import MySQLdb
import loadEnv
import json

class connectDB:
    conn = MySQLdb.connect(
    user=loadEnv.DB_USERNAME,
    passwd=loadEnv.DB_PASSWORD,
    host=loadEnv.DB_HOST,
    db=loadEnv.DB_DATABASE,
    charset="utf8"
    )
    def __init__(self):
        print('DB接続処理')
    def __del__(self):
        conn.close()
        print('DB接続解除処理')
    
    def get_all_diaries_from_user(self,user_id):
        print('日記の取得')
        # カーソルを取得する
        cur= conn.cursor()

        # クエリを実行する
        sql = "SELECT id,title,content,date FROM diaries WHERE user_id="+str(user_id)+";"
        cur.execute(sql)

        # 実行結果をすべて取得する
        rows = cur.fetchall()
        
        # カーソルを閉じる
        cur.close()
        return rows
    def write_pre_data(self):
        print('日記の書き込み')

f = connectDB()
f.get_all_diaries_from_user(2)
del f

