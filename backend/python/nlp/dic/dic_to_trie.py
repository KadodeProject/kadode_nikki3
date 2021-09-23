"""
評価極性辞書を読み込み、TRIEに変換してポジティブな語句とネガティブな語句をよそれぞれdic_positive,dic_negative変数に格納する処理
"""
from ahocorapy.keywordtree import KeywordTree
import os
def make_trie():
    dic_positive = KeywordTree()#
    dic_negative = KeywordTree()#

    # 用語編
    pass_to_dic=os.path.dirname(os.path.abspath(__file__))

    with open(pass_to_dic+'/wago.121808.pn') as words:# 辞書読み込み
        for line in words:
            line_splitted=line.strip().split('\t')
            if len(line_splitted) !=2:
                continue
            polarity_, term_=line_splitted[:2]
            polarity=polarity_[:2]
            term=term_.replace(' ','')#4
            if polarity=='ポジ':#
                dic_positive.add(term)#
            elif polarity=='ネガ':#
                dic_negative.add(term)#

    # 名詞編
    with open(pass_to_dic+'/pn.csv.m3.120408.trim') as noun:#辞書読み込み
        for line in noun:
            term,polarity=line.strip().split('\t')[:2]
            if polarity=='p':#
                dic_positive.add(term)#
            elif polarity=='n':#
                dic_negative.add(term)#


    dic_positive.finalize()#TRIEを構築
    dic_negative.finalize()#TRIEを構築
    return dic_positive, dic_negative

