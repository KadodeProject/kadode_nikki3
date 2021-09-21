import MySQLdb
from base import loadEnv
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
        self.conn.close()
        print('DB接続解除処理')

    """
    データベースに接続して、引数のユーザーIDのすべての日記の基本情報を取得
    """
    def get_all_diaries_from_user(self,user_id):
        print('日記の取得')
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する
        #このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = "SELECT id,title,content,date,updated_at,updated_statistic_at FROM diaries WHERE user_id="+str(user_id)+";"
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        return rows
    """
    データベースに接続して、引数のユーザーIDのすべての日記の自然言語Pre情報を取得
    """
    def get_all_diariesPre_from_user(self,user_id):
        print('日記の取得')
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する
        #このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = "SELECT id,updated_at,updated_statistic_at,sentence,chunk,token,affiliation,char_length FROM diaries WHERE user_id="+str(user_id)+";"
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        return rows

    """
    解析済みのJSONデータを書き込む
    """
    def set_statistics_json(self,user_id, column_name, value):
        # カーソルを取得する
        cur= self.conn.cursor()        # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま自家絵やり倒す
        json_value = json.dumps(value,ensure_ascii=False)
        cur.execute(
                'UPDATE statistics SET {0} = %s WHERE user_id = %s;'.format(column_name),(json_value,user_id))
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()
    
    """
    解析済みのノーマルデータを書き込む(1ユーザー複数テーブルのもの用)
    """
    def set_single_normal_data(self,column,db_id,**values):
        for (key,value) in values.items():
            # カーソルを取得する
            cur= self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            cur.execute(
                    'UPDATE {0} SET {1} = %s WHERE id = %s;'.format(column,key),(value,db_id))
            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()

    """
    解析済みのJSONデータを書き込む(1ユーザー複数テーブルのもの用)
    """
    def set_single_json_data(self,column,db_id,**jsons):
        for (key,value) in jsons.items():
            # カーソルを取得する
            cur= self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            json_value = json.dumps(value,ensure_ascii=False)
            cur.execute(
                    'UPDATE {0} SET {1} = %s WHERE id = %s;'.format(column,key),(json_value,db_id))
            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()



    """
    進捗状況--日記テーブルなど1ユーザー複数テーブルのもの用
    """
    def set_single_progress(self,db_id,table_name,value):
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する
        cur.execute(
                'UPDATE {0} SET statistic_progress = %s where id = %s;'.format(table_name),(str(value),str(db_id))
                )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()

    """
    進捗状況--統計テーブルなど1ユーザー1テーブルのもの用
    """
    def set_multiple_progress(self,user_id, table_name,value):
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する
        cur.execute(
                'UPDATE {0} SET statistic_progress = %s where user_id = %s;'.format(table_name),(str(value),str(user_id))
                )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()



if __name__ == '__main__':
    f = connectDB()

    rows=f.get_all_diaries_from_user(2)
    for row in rows:
        for column in row:
            print(column)
    del f

