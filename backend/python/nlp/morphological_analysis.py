
from janome.tokenizer import Tokenizer


"""
個別に日記の分析(diaryテーブルのtokenカラム生成用)
"""
def get_morphological_for_token(rows:list):
    token={}#形態素解析された結果を格納する辞書型配列
    for row in rows:
        #rowが日記1つに該当
        t = Tokenizer()#形態素解析用オブジェクトの生成
        results=t.tokenize(row[2])

        #token生成
        token[str(row[0])]=""
        for result in results:
            #整形
            print(type(result.surface))
            print(result.surface)
        token[str(row[0])]+={
            "lemma":result.base_form,
        }
    return token
    # token{'日記id':{},'日記id':{}……}
    # token{'日記id':{},'日記id':{}……}


"""
月ごとに日記の分析
"""
def get_morphological_for_month(rows:list):
    pass
"""
トータルの日記の分析
"""

def get_morphological_for_total(rows:list):
    return 