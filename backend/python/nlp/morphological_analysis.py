
from janome.analyzer import Analyzer
from janome.tokenfilter import *
from janome.tokenizer import Tokenizer
from janome.charfilter import *


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
    #文字列結合
    all_diaries=""
    for row in rows:
        all_diaries+=" "+row[2]
    
    total_noun_asc={}
    total_adjective_asc={}

    syuruiList=["名詞","形容詞"]#品詞←,"名詞,固有名詞"などでも行ける。
    zyogaiList=["名詞,代名詞","名詞,非自立","名詞,数"]#除外
    # tokenizer = Tokenizer()
    i=0
    for syurui in syuruiList:
        tmp={}
        cf = [UnicodeNormalizeCharFilter()]#前処理フィルタ←アルファベット、半角カタカナを全角にするなど,Unicode文字列の正規化とドキュメントにあり
        tf = [CompoundNounFilter(),POSKeepFilter([syurui]),POSStopFilter(zyogaiList),TokenCountFilter(att='base_form')] #後処理フィルタ準備 att="base_form"で品詞活用をまとえｍて基本形のみにする
        a = Analyzer(char_filters =cf,token_filters=tf)#解析器生成
        results = a.analyze(all_diaries)#解析
        print(syurui,"登場順")
        s =sorted(results, key=lambda x:x[1],reverse=True)#結果並べ替え
        for i,wc in enumerate(s):
            if i >= 50:break
            # print((i +1),':',wc)
            tmp[i+1]={'word':wc[0],'count':wc[1]}

        if(syurui=="名詞"):
            total_noun_asc=tmp
        elif(syurui=="形容詞"):
            total_adjective_asc=tmp
        i+=1

        

    return total_noun_asc,total_adjective_asc
    """
    {
        '1':{
            'word':'言葉の原型',
            'count':12
        },

    }
    """