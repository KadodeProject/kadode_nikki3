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
        self.conn=MySQLdb.connect(
        user=loadEnv.DB_USERNAME,
        passwd=loadEnv.DB_PASSWORD,
        host=loadEnv.DB_HOST,
        db=loadEnv.DB_DATABASE,
        charset="utf8"
        )
        if not self.conn.open:
            print("sqlを叩き起こします")
            self.conn.ping(True)
        print('DB接続処理開始')
    def __del__(self):
        self.conn.close()
        if not self.conn.open:
            print('DB接続解除処理完了')


    """
    データベースに接続して、引数のユーザーIDのすべての日記の基本情報を取得
    """
    def get_all_diaries_from_user(self,user_id):
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
        self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
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
        sql = "SELECT id,updated_at,updated_statistic_at,sentence,chunk,token,affiliation,char_length,content FROM diaries WHERE user_id="+str(user_id)+";"
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
        return rows


    """
    データベースに接続して、引数のユーザーIDのすべての日記の自然言語完成情報を取得
    """
    def get_all_diariesNlpFin_from_user(self,user_id):
        print('日記の取得')
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する
        #このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = "SELECT id,updated_at,updated_statistic_at,date,char_length,emotions,classification,important_words,special_people,token FROM diaries WHERE user_id="+str(user_id)+";"
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    解析済みのJSONデータを書き込む(user_diのみで決まるもの)
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
        self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
    
    """
    解析済みのノーマルデータを書き込む(idで一意に決まりupdateで対応できる個別日記のもの用)
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
            self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みのJSONデータを書き込む(idで一意に決まりupdateで対応できる個別日記のもの用)
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
            self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
    """
    解析済みのノーマルデータを書き込む(user_idと年月で決まり、存在しない場合もあるもの用)
    dateは配列で date[year,month]
    """
    def set_depDate_normal_data(self,column,user_id,date,**values):
        for (key,value) in values.items():
            # カーソルを取得する
            cur= self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            if(column=="statistic_per_months"):
                #年付きでwhereする
                cur.execute(
                        'UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s AND month = %s;'.format(column,key),(value,user_id,date[0],date[1]))
            else:
                #年でwhereする
                cur.execute(
                        'UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s;'.format(column,key),(value,user_id,date[0]))

            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みのJSONデータを書き込む(user_idと年月で決まり、存在しない場合もあるもの用)
    dateは配列で date[year,month]
    """
    def set_depDate_json_data(self,column,user_id,date,**jsons):
        for (key,value) in jsons.items():
            # カーソルを取得する
            cur= self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            json_value = json.dumps(value,ensure_ascii=False)
            if(column=="statistic_per_months"):
                cur.execute(
                        'UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s AND month = %s;'.format(column,key),(json_value,user_id,date[0],date[1]))
            else:
                cur.execute(
                        'UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s;'.format(column,key),(json_value,user_id,date[0]))

            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)



    """
    進捗状況--日記テーブルなど1ユーザー複数テーブルでdbid既知のもの用
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
    """
    進捗状況--diary statistic per monthのようにuser_idと年月で決まり、存在しない場合もあるもの用
    """
    def set_depDate_progress(self,user_id,table_name,date,value):
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する
        if(table_name=="statistic_per_months"):
            cur.execute(
                    'UPDATE {0} SET statistic_progress = %s where user_id = %s AND year = %s AND month = %s;'.format(table_name),(str(value),str(user_id),date[0],date[1])
                    )
        else:
            cur.execute(
                    'UPDATE {0} SET statistic_progress = %s where user_id = %s AND year = %s ;'.format(table_name),(str(value),str(user_id),date[0])
                    )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()

    """
    解析済みのノーマルデータを書き込む(user_idと年月で決まり、存在しない場合もあるもの用)
    dateは配列で date[year,month]
    """
    def set_depDate_insertUpdate_data(self,column,user_id,date):
        # カーソルを取得する
        cur= self.conn.cursor()
        # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
        if(column=="statistic_per_months"):
            #無ければ新しい列を作る

            print(
                    'SELECT * CASE NOT EXISTS(SELECT * FROM {0} WHERE user_id = {1} AND year = {2} AND month = {3}) THEN INSERT {0} INTO (user_id,year,month,statistic_progress) VALUES ({1},{2},{3},1) END;'.format(column,user_id,date[0],date[1]))
            cur.execute(
                    'CASE NOT EXISTS(SELECT * FROM {0} WHERE user_id = {1} AND year = {2} AND month = {3}) THEN INSERT {0} INTO (user_id,year,month,statistic_progress) VALUES ({1},{2},{3},1) END;'.format(column,user_id,date[0],date[1]))
        else:
            #年でwhereする
            cur.execute(
                    'IF EXISTS(SELECT * FROM {0} WHERE user_id = {1} AND year = {2} ) UPDATE {0} SET year = {2}  ELSE {0} INSERT INTO (user_id,year,statistic_progress) VALUES ({1},{2},1);'.format(column,user_id,date[0]))

        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
# """
# データベースに接続して、引数のユーザーIDのすべての日記の基本情報を取得
# """
# def get_all_diaries_from_user(user_id):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     print('日記の取得')
#     # カーソルを取得する
#     cur= conn.cursor()
#     # クエリを実行する
#     #このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
#     sql = "SELECT id,title,content,date,updated_at,updated_statistic_at FROM diaries WHERE user_id="+str(user_id)+";"
#     cur.execute(sql)
#     # 実行結果をすべて取得する
#     rows = cur.fetchall()
#     # カーソルを閉じる
#     cur.close()
#     conn.close()
#     # conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
#     return rows
# """
# データベースに接続して、引数のユーザーIDのすべての日記の自然言語Pre情報を取得
# """
# def get_all_diariesPre_from_user(user_id):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     print('日記の取得')
#     # カーソルを取得する
#     cur= conn.cursor()
#     # クエリを実行する
#     #このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
#     sql = "SELECT id,updated_at,updated_statistic_at,sentence,chunk,token,affiliation,char_length,content FROM diaries WHERE user_id="+str(user_id)+";"
#     cur.execute(sql)
#     # 実行結果をすべて取得する
#     rows = cur.fetchall()
#     # カーソルを閉じる
#     cur.close()
#     conn.close()
#     # conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)
#     return rows

# """
# 解析済みのJSONデータを書き込む
# """
# def set_statistics_json(user_id, column_name, value):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     # カーソルを取得する
#     cur= conn.cursor()        # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま自家絵やり倒す
#     json_value = json.dumps(value,ensure_ascii=False)
#     cur.execute(
#             'UPDATE statistics SET {0} = %s WHERE user_id = %s;'.format(column_name),(json_value,user_id))
#     # 保存する
#     conn.commit()
#     # カーソルを閉じる
#     cur.close()
#     conn.close()
#     # conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)

# """
# 解析済みのノーマルデータを書き込む(1ユーザー複数テーブルのもの用)
# """
# def set_single_normal_data(column,db_id,**values):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     for (key,value) in values.items():
#         # カーソルを取得する
#         cur= conn.cursor()
#         # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
#         cur.execute(
#                 'UPDATE {0} SET {1} = %s WHERE id = %s;'.format(column,key),(value,db_id))
#         # 保存する
#         conn.commit()
#         # カーソルを閉じる
#         cur.close()
#         conn.close()
#         # conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)

# """
# 解析済みのJSONデータを書き込む(1ユーザー複数テーブルのもの用)
# """
# def set_single_json_data(column,db_id,**jsons):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     for (key,value) in jsons.items():
#         # カーソルを取得する
#         cur= conn.cursor()
#         # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
#         json_value = json.dumps(value,ensure_ascii=False)
#         cur.execute(
#                 'UPDATE {0} SET {1} = %s WHERE id = %s;'.format(column,key),(json_value,db_id))
#         # 保存する
#         conn.commit()
#         # カーソルを閉じる
#         cur.close()
#         conn.close()
#         # conn.ping(True)#mysql2003エラー(サーバー接続切れ防止)



# """
# 進捗状況--日記テーブルなど1ユーザー複数テーブルのもの用
# """
# def set_single_progress(db_id,table_name,value):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     # カーソルを取得する
#     cur= conn.cursor()
#     # クエリを実行する
#     cur.execute(
#             'UPDATE {0} SET statistic_progress = %s where id = %s;'.format(table_name),(str(value),str(db_id))
#             )
#     # 保存する
#     conn.commit()
#     # カーソルを閉じる
#     cur.close()
#     conn.close()
    

# """
# 進捗状況--統計テーブルなど1ユーザー1テーブルのもの用
# """
# def set_multiple_progress(user_id, table_name,value):
#     conn = MySQLdb.connect(
#     user=loadEnv.DB_USERNAME,
#     passwd=loadEnv.DB_PASSWORD,
#     host=loadEnv.DB_HOST,
#     db=loadEnv.DB_DATABASE,
#     charset="utf8"
#     )
#     conn.ping(True)
#     # カーソルを取得する
#     cur= conn.cursor()
#     # クエリを実行する
#     cur.execute(
#             'UPDATE {0} SET statistic_progress = %s where user_id = %s;'.format(table_name),(str(value),str(user_id))
#             )
#     # 保存する
#     conn.commit()
#     # カーソルを閉じる
#     cur.close()
#     conn.close()




if __name__ == '__main__':
    f = connectDB()

    rows=f.get_all_diaries_from_user(2)
    for row in rows:
        for column in row:
            print(column)
    del f

