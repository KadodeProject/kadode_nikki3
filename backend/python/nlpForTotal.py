
import sys
from base import connectDBClass as database

from nlp import morphological_analysis

def nlpForTotal():
    """
    [id,タイトル,本文,日付]
    [0 ,1     ,2     ,3    ]
    """
    from_php = sys.argv#php側の引数
    user_id=from_php[1]
    # user_id=1

    #DBインスタンス
    db = database.connectDB()



    # # データ取得
    # rows=db.get_all_diaries_from_user(user_id)
    
    rows=db.get_all_diaries_from_user(user_id)


    #形態素解析
    total_noun_asc,total_adjective_asc=morphological_analysis.get_morphological_for_total(rows)

    #DB代入
    db.set_statistics_json(user_id,"total_noun_asc",total_noun_asc)   
    db.set_statistics_json(user_id,"total_adjective_asc",total_adjective_asc)   


    #完了を送る
    #statisticでのpython実行はすべて並列で行われる
    db.set_multiple_progress(user_id,"statistics",100)
    #インスタンス破棄
    del db

    print("nlpForTotal処理終了")

if __name__ == '__main__':
    nlpForTotal()