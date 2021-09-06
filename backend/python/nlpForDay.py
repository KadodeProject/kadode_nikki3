
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
    

    # # データ取得
    # rows=db.get_all_diaries_from_user(user_id)
    
    rows=db.get_all_diaries_from_user("2")


    #形態素解析
    token=morphological_analysis.get_morphological_for_token(rows)


    #タプル→リストへの変換　タプルだと色々不便なので
    rows=list(rows)

    # データ保存 tokenとか色々混ぜ込む


    # ぷりんと
    print(type(token))
    # print(token)
    # print(token['29'])
    


    print("終了")