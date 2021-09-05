
import sys
from base import connectDB as db

from nlp import morphological_analysis

if __name__ == "__main__":
    """
    [id,タイトル,本文,日付]
    [0 ,1     ,2     ,3    ]
    """
    # from_php = sys.argv#php側の引数
    # user_id=from_php[1]
    user_id=1

    # # データ取得
    # rows=db.get_all_diaries_from_user(user_id)
    
    rows=db.get_all_diaries_from_user(user_id)


    #形態素解析
    total_noun_asc,total_adjective_asc=morphological_analysis.get_morphological_for_total(rows)

    #DB代入
    db.set_statistics_json(user_id,"total_noun_asc",total_noun_asc)   
    db.set_statistics_json(user_id,"total_adjective_asc",total_adjective_asc)   

    print("終了")