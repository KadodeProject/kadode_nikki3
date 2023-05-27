# Standard Library
import json

# Third Party Library
import MySQLdb

# First Party Library
# curl.execute(,(ここに変数))入れることでSQLインジェクション防げる。
# SQLインジェクション放置している部分はユーザーの値が入らないところなので即急な対応は不要だが、ちゃんとエスケープしたい。
# テーブル名がエスケープできない謎仕様なので、プラスでつなげている
from legacy.base import loadEnv


class connectDB:
    conn = MySQLdb.connect(
        user=loadEnv.DB_USERNAME,
        passwd=loadEnv.DB_PASSWORD,
        host=loadEnv.DB_HOST,
        db=loadEnv.DB_DATABASE,
        charset="utf8",
    )

    def __init__(self):
        self.conn = MySQLdb.connect(
            user=loadEnv.DB_USERNAME,
            passwd=loadEnv.DB_PASSWORD,
            host=loadEnv.DB_HOST,
            db=loadEnv.DB_DATABASE,
            charset="utf8",
        )
        if not self.conn.open:
            print("sqlを叩き起こします")
            self.conn.ping(True)
        print("DB接続処理開始")

    def __del__(self):
        self.conn.close()
        if not self.conn.open:
            print("DB接続解除処理完了")

    """
    データベースに接続して、引数のユーザーIDのすべての日記の基本情報を取得
    """

    def get_all_diaries_from_user(self, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        # このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = (
            "SELECT D.id,D.title,D.content,D.date,D.updated_at,S.updated_at AS updated_statistic_at,S.statistic_progress FROM diaries AS D LEFT JOIN statistic_per_dates AS S ON D.id = S.diary_id LEFT JOIN diary_processeds AS P ON D.id = P.diary_id  WHERE user_id="
            + str(user_id)
            + ";"
        )
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    データベースに接続して、引数のユーザーIDのすべての日記の自然言語Pre情報を取得
    """

    def get_all_diariesPre_from_user(self, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        # このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = (
            "SELECT D.id,D.updated_at,S.updated_at AS updated_statistic_at,P.sentence,P.chunk,P.token,P.affiliation,P.char_length,D.content FROM diaries AS D LEFT JOIN statistic_per_dates AS S ON D.id = S.diary_id LEFT JOIN diary_processeds AS P ON D.id = P.diary_id WHERE D.user_id="
            + str(user_id)
            + ";"
        )
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    データベースに接続して、引数のユーザーIDのすべての日記の自然言語完成情報を取得
    """

    def get_all_diariesNlpFin_from_user(self, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        # このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = (
            "SELECT D.id,D.updated_at,S.updated_at AS updated_statistic_at,D.date,P.char_length,S.emotions,S.classification,S.important_words,S.special_people,P.token FROM diaries AS D LEFT JOIN statistic_per_dates AS S ON D.id = S.diary_id LEFT JOIN diary_processeds AS P ON D.id = P.diary_id WHERE user_id="
            + str(user_id)
            + ";"
        )
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    データベースに接続して、年の統計データを取得する
    """

    def get_all_yearStatistics_from_user(self, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        # このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = (
            "SELECT year,emotions,word_counts,noun_rank,adjective_rank,important_words,special_people,classifications FROM statistic_per_years WHERE user_id="
            + str(user_id)
            + " ORDER BY year ASC;"
        )
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    データベースに接続して、ユーザーのカスタム固有表現取得
    """

    def get_customNER(self, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        # このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = (
            "SELECT l.label,n.name FROM custom_n_e_r_s n INNER JOIN n_e_r_labels l ON n.label_id=l.id WHERE n.user_id="
            + str(user_id)
            + ";"
        )
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    データベースに接続して、ユーザーの使用してるNLPパッケージを取得し、そのパッケージから固有表現のパッケージを探し出し、パッケージ固有表現を取得
    """

    def get_packageNER(self, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        # このクエリの順番は他所でrow[2]的な依存をしているので変更は要注意
        sql = (
            "SELECT l.label,n.name FROM nlp_package_users u INNER JOIN nlp_package_names p ON u.package_id=p.id AND p.genre_id=1 INNER JOIN package_n_e_r_s n ON p.id=n.package_id INNER JOIN n_e_r_labels l ON n.label_id=l.id WHERE u.user_id="
            + str(user_id)
            + ";"
        )
        cur.execute(sql)
        # 実行結果をすべて取得する
        rows = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return rows

    """
    解析済みのJSONデータを書き込む(user_idのみで決まるもの)
    """

    def set_statistics_json(self, user_id, **jsons):
        for key, value in jsons.items():
            # カーソルを取得する
            cur = (
                self.conn.cursor()
            )  # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま自家絵やり倒す
            json_value = json.dumps(value, ensure_ascii=False)
            cur.execute(
                "UPDATE statistics SET {0} = %s WHERE user_id = %s;".format(
                    key
                ),
                (json_value, user_id),
            )
            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みの統計データを書き込む(user_diのみで決まるもの)
    """

    def set_statistics_value(self, user_id, **values):
        for key, value in values.items():
            # カーソルを取得する
            cur = (
                self.conn.cursor()
            )  # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま自家絵やり倒す
            cur.execute(
                "UPDATE statistics SET {0} = %s WHERE user_id = %s;".format(
                    key
                ),
                (value, user_id),
            )
            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みのノーマルデータを書き込む(idで一意に決まりupdateで対応できる個別日記のもの用)
    """

    def set_single_normal_data(self, column, db_id, **values):
        for key, value in values.items():
            # カーソルを取得する
            cur = self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            cur.execute(
                "UPDATE {0} SET {1} = %s WHERE diary_id = %s;".format(
                    column, key
                ),
                (value, db_id),
            )
            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みのJSONデータを書き込む(idで一意に決まりupdateで対応できる個別日記のもの用)
    statistic_per_dates専用になっている
    """

    def set_single_json_data(self, column: str, db_id: int, **jsons):
        for key, value in jsons.items():
            # カーソルを取得する
            cur = self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            json_value = json.dumps(value, ensure_ascii=False)
            # print('UPDATE '+column+' SET '+key+' = '+json_value+' WHERE diary_id = '+str(db_id)+';')
            cur.execute(
                "UPDATE {0} SET {1} = %s WHERE diary_id = %s;".format(
                    column, key
                ),
                (json_value, db_id),
            )

            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みのノーマルデータを書き込む(user_idと年月で決まり、存在しない場合もあるもの用)
    dateは配列で date[year,month]
    """

    def set_depDate_normal_data(self, column, user_id, date, **values):
        for key, value in values.items():
            # カーソルを取得する
            cur = self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            if column == "statistic_per_months":
                # 年付きでwhereする
                cur.execute(
                    "UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s AND month = %s;".format(
                        column, key
                    ),
                    (value, user_id, date[0], date[1]),
                )
            else:
                # 年でwhereする
                cur.execute(
                    "UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s;".format(
                        column, key
                    ),
                    (value, user_id, date[0]),
                )

            # 保存する
            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    解析済みのJSONデータを書き込む(user_idと年月で決まり、存在しない場合もあるもの用)
    dateは配列で date[year,month]
    """

    def set_depDate_json_data(self, column, user_id, date, **jsons):
        for key, value in jsons.items():
            # カーソルを取得する
            cur = self.conn.cursor()
            # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
            json_value = json.dumps(value, ensure_ascii=False)
            if column == "statistic_per_months":
                cur.execute(
                    "UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s AND month = %s;".format(
                        column, key
                    ),
                    (json_value, user_id, date[0], date[1]),
                )
            else:
                cur.execute(
                    "UPDATE {0} SET {1} = %s WHERE user_id = %s AND year = %s;".format(
                        column, key
                    ),
                    (json_value, user_id, date[0]),
                )

            self.conn.commit()
            # カーソルを閉じる
            cur.close()
            self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    進捗状況--日記テーブルなど1ユーザー複数テーブルでdbid既知のもの用
    statistic_per_dates専用になっている
    """

    def set_single_progress(self, db_id, table_name, value):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        cur.execute(
            "UPDATE {0} SET statistic_progress = %s where diary_id = %s;".format(
                table_name
            ),
            (str(value), str(db_id)),
        )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()

    """
    進捗状況--統計テーブルなど1ユーザー1テーブルのもの用
    """

    def set_multiple_progress(self, user_id, table_name, value):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        cur.execute(
            "UPDATE {0} SET statistic_progress = %s where user_id = %s;".format(
                table_name
            ),
            (str(value), str(user_id)),
        )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()

    """
    進捗状況--diary statistic per monthのようにuser_idと年月で決まり、存在しない場合もあるもの用
    """

    def set_depDate_progress(self, user_id, table_name, date, value):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        if table_name == "statistic_per_months":
            cur.execute(
                "UPDATE {0} SET statistic_progress = %s where user_id = %s AND year = %s AND month = %s;".format(
                    table_name
                ),
                (str(value), str(user_id), date[0], date[1]),
            )
        else:
            cur.execute(
                "UPDATE {0} SET statistic_progress = %s where user_id = %s AND year = %s ;".format(
                    table_name
                ),
                (str(value), str(user_id), date[0]),
            )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()

    """
    ユーザーidの人が持ってる月別・年別統計データを取得する
    """

    def check_exist_data(self, column, user_id):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する
        if column == "statistic_per_months":
            cur.execute(
                "SELECT year,month FROM statistic_per_months WHERE user_id ={0}".format(
                    user_id
                )
            )
        if column == "statistic_per_years":
            cur.execute(
                "SELECT year FROM statistic_per_years WHERE user_id ={0}".format(
                    user_id
                )
            )
        # 実行結果をすべて取得する
        result = cur.fetchall()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)
        return result

    """
    個別の統計行を作成する
    """

    def create_diary_meta_row(self, table_name: str, diary_id: int, date):
        # カーソルを取得する
        cur = self.conn.cursor()
        cur.execute(
            "INSERT INTO {0} (diary_id,created_at,updated_at) VALUES (%s,%s,%s) ;".format(
                table_name
            ),
            (diary_id, date, date),
        )
        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)

    """
    月別と年別で一度ユーザーのデータを作成する
    """

    def insert_void_column(self, column, user_id, date):
        # カーソルを取得する
        cur = self.conn.cursor()
        # クエリを実行する ここはsqkインジェクションにならないところなので、そのまま
        if column == "statistic_per_months":
            # 無ければ新しい列を作る

            # print(
            #                  'INSERT  INTO {0}(user_id,year,month,statistic_progress) VALUES ({1},{2},{3},10) ;'.format(column,user_id,date[0],date[1]))
            cur.execute(
                "INSERT  INTO {0}(user_id,year,month,statistic_progress) VALUES ({1},{2},{3},10) ;".format(
                    column, user_id, date[0], date[1]
                )
            )
        else:
            # 年でwhereする
            cur.execute(
                "INSERT  INTO {0}(user_id,year,statistic_progress) VALUES ({1},{2},10) ;".format(
                    column, user_id, date[0]
                )
            )

        # 保存する
        self.conn.commit()
        # カーソルを閉じる
        cur.close()
        self.conn.ping(True)  # mysql2003エラー(サーバー接続切れ防止)


if __name__ == "__main__":
    f = connectDB()

    rows = f.get_all_diaries_from_user(2)
    for row in rows:
        for column in row:
            print(column)
    del f
