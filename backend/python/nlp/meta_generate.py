
# from janome.analyzer import Analyzer
# from janome.tokenfilter import *
# from janome.tokenizer import Tokenizer
# from janome.charfilter import *
import spacy

model="ja_ginza" #軽量モデルを使用。本当はtransformer採用型を使いたいけど、メモリが足りない。


"""
個別に日記の分析(diaryテーブルのtokenカラム生成用)
"""
def get_tokenChunkSentence_by_ginza(row:list):
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
    nlp_sentence={}
    where_chr=0#単語の文字位置
    sentence_num=0#文の番号


    nlp = spacy.load(model)
    doc = nlp(row[2])
    
    for sent in doc.sents:

        '''
        文の区切り情報(sentence)取得
        {
            'satrt':0,#開始文字位置
            'end':0,#終了文字位置
        }
        '''
        #文章情報
        nlp_sentence[sentence_num]={
            'start':sent.start_char,#開始文字位置
            'end':sent.end_char,#終了文字位置
        }
        sentence_num+=1

        for token in sent:
            #CoNLL-U Syntactic Annotation形式
            #1	銀座	銀座	PROPN	名詞-固有名詞-地名-一般	_	6	obl	_	SpaceAfter=No|BunsetuBILabel=B|BunsetuPositionType=SEM_HEAD|NP_B|Reading=ギンザ|NE=B-GPE|ENE=B-City
            #ID 表層　　基本　　品詞　　　言語依存の品詞　　　　形態論情報　係り先　係り関係ラベル   2次係り受け　その他
            #ID,FORM(表層形),LEMMA(基本形),UPOSTAG(品詞),XPOSTAG(言語依存の品詞),FEATS(形態論情報),HEAD(係り先),DEPREL(係り受け関係ラベル),DEPS(二次係り受け),MISC

            #品詞情報は 単語id={}
            '''
            単語の品詞など(token)取得
            '''
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
            '''
            係り受け情報(chunk)取得
            {
                'dependencyTxt':token.text,#該当単語(番号だけだときつい)
                'dependencyTag':token.dep_,#形態論情報
                'dependencyForId':token.head.i,#係り先
                'dependencyForTxt':token.head.text,#係り先の単語(本番では、日記の更新かかると引っ張ってこれなくなるので。)
            }
            ''' 
            nlp_chunk[token.i]={
                # 'dependencyTag':token.pos_,#形態論情報→品詞は別で持っているので不要
                #場所の情報無いのは、形態素解析のidと共通なので、そこから取ってこれるから
                'dependencyTxt':token.text,#該当単語(番号だけだときつい)
                'dependencyTag':token.dep_,#形態論情報
                'dependencyForId':token.head.i,#係り先
                'dependencyForTxt':token.head.text,#係り先の単語(本番では、日記の更新かかると引っ張ってこれなくなるので。)
            }
            
            where_chr+=len(token.orth_)
    return nlp_token,nlp_chunk,nlp_sentence

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

'''
アノテーション抽出
{
    'start':ent.start_char,#開始文字位置
    'end':ent.end_char,#終了文字位置z
    'lemma':ent.text,#基本形
    'form':ent.label_,#抽象分類
}
'''
def get_affiliation_by_ginza(row:list):
    nlp_affiliation={}
    affiliation_num=0#文の番号
    nlp = spacy.load(model)
    doc = nlp(row[2])
    for ent in doc.ents:
        # print('ent.text, ent.start_char, ent.end_char, ent.label_')
        # print(ent.text, ent.start_char, ent.end_char, ent.label_)
        nlp_affiliation[affiliation_num]={
            'start':ent.start_char,#開始文字位置
            'end':ent.end_char,#終了文字位置z
            'lemma':ent.text,#基本形
            'form':ent.label_,#抽象分類
        }
        affiliation_num+=1
    
    return nlp_affiliation