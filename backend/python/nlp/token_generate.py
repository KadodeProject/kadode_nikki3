
# from janome.analyzer import Analyzer
# from janome.tokenfilter import *
# from janome.tokenizer import Tokenizer
# from janome.charfilter import *
import spacy

"""
個別に日記の分析(diaryテーブルのtokenカラム生成用)
"""
def get_nlpMeta_by_ginza(row:list):
    # 返す値
    '''
    {
       "NE": "B-LOCATION", //Name Entity
        "POS": "名詞",
        "POS2": "固有名詞",
        "begin": 0, //文中の開始位置
        "end": 6,//文中の終了位置
        "lemma": "アイスランド"//原型
    }
    '''
    nlp_token={}
    nlp_chunk={}
    where_chr=0
    nlp = spacy.load('ja_ginza')
    doc = nlp(row[2])
    for sent in doc.sents:
        for token in sent:
            #CoNLL-U Syntactic Annotation形式
            #1	銀座	銀座	PROPN	名詞-固有名詞-地名-一般	_	6	obl	_	SpaceAfter=No|BunsetuBILabel=B|BunsetuPositionType=SEM_HEAD|NP_B|Reading=ギンザ|NE=B-GPE|ENE=B-City
            #ID 表層　　基本　　品詞　　　言語依存の品詞　　　　形態論情報　係り先　係り関係ラベル   2次係り受け　その他
            #ID,FORM(表層形),LEMMA(基本形),UPOSTAG(品詞),XPOSTAG(言語依存の品詞),FEATS(形態論情報),HEAD(係り先),DEPREL(係り受け関係ラベル),DEPS(二次係り受け),MISC

            #品詞情報は 単語id={}
            nlp_token[token.i]={
                'start':where_chr,#開始文字位置
                'end':where_chr+len(token.orth_),#終了文字位置
                'form':token.orth_,#表層形
                'lemma':token.lemma_,#基本形
                'uPOSTag':token.pos_,#品詞
                'xPOSTag':token.tag_,#言語依存の品詞
                'inflect':token.tag_,#活用形
                'isUnknown':token.is_oov,#未知語
            }
            #係り受け情報は 単語id={}
            nlp_chunk[token.i]={
                'dependencyTag':token.dep_,#形態論情報
                'dependencyFor':token.head.i,#係り先
            }
            where_chr+=len(token.orth_)

    print(nlp_token)
    print(nlp_chunk)
    return nlp_token,nlp_chunk

    # token={}#形態素解析された結果を格納する辞書型配列

    # #rowが日記1つに該当
    # t = Tokenizer()#形態素解析用オブジェクトの生成
    # results=t.tokenize(row[2])

    # #token生成
    # token[str(row[0])]=""
    # for result in results:
    #     #整形
    #     #「part_of_speech」、「infl_type」、「infl_form」、「base_form」、「reading」、および「phonetic」
    #     print(type(result.part_of_speech))
    #     print("part_of_speech"+result.part_of_speech)
    #     print("infl_type"+result.infl_type)
    #     print("infl_form"+result.infl_form)
    #     print("base_form"+result.base_form)
    #     print("reading"+result.reading)
    #     print("phonetic"+result.phonetic)
    #     # token[str(row[0])]+={
    #     #     "lemma":result.base_form,
    #     # }
    # # print(token)
    # return token
    # token{'日記id':{},'日記id':{}……}
    # token{'日記id':{},'日記id':{}……}

