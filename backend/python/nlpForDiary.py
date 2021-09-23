

import time
import json
from datetime import datetime as dt

from base import connectDBClass as database

from nlp import special_people_extract
from nlp import classification_analysis
from nlp import importantWords_analysis
from nlp import emotions_analysis
from nlp import causeEffect_analysis
from nlp import dependency_analysis
from nlp import cosSimilarity_analysis

from nlp.dic import dic_to_trie

def nlpForDiary(user_id):

    #DBインスタンス
    db = database.connectDB()



    # SELECT id,updated_at,updated_statistic_at,sentence,chunk,token,affiliation,char_length
    rows=db.get_all_diariesPre_from_user(user_id)

    #感情極性辞書のTRIE作成
    dic_posi,dic_nega=dic_to_trie.make_trie()

    #全日記文字
    all_sentences=""
    for row in rows:
        all_sentences+=row[8]

    '''
    統計更新してから日記側に変更がないとき(updated_statistic_at<=updated_at)→処理しない分岐
    dbに入っている日付2021-09-20 14:29:16
    '''
    for row in rows:
        
        #個別日記のループ
        if(row[1]!=None):
             time_updated_at = row[1]#この時点でdatetime型になっている
        else:
            # データない場合
            time_updated_at = time.strptime('1800-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')
        #統計の更新日取得
        if(row[2]!=None):
            time_statistics_updated_at = row[2]
        else:
            # データない場合
            time_statistics_updated_at = dt.strptime('1800-1-1 11:11:11','%Y-%m-%d %H:%M:%S')

        if(time_statistics_updated_at>time_updated_at):
            #処理不要 リーダーブルコードに乗ってたやつ
            print(str(row[0])+"スキップ")
            continue
        else:
            print(str(row[0])+"Diary処理")
            # nlp関係はNoneがあるので注
            #jsonはdecodeする
            value_id=row[0]
            value_updated_at=row[1]
            value_updated_statistic_at=row[2]
            value_sentence=json.loads(row[3])
            value_chunk=json.loads(row[4])
            value_token=json.loads(row[5])
            value_affiliation=json.loads(row[6])
            value_char_length=row[7]
            value_content=row[8]
            '''
            emotions:感情数値化
            '''
            emotions=emotions_analysis.get_emotion(dic_posi,dic_nega,value_content)
            # print(emotions)
            '''
            flavor:ユーザーの日記らしさ、コサイン類似度?TF-IDF?
            値は出てくるが、激的に遅い上、差が見られない
            '''
            # similar_sentences=cosSimilarity_analysis.get_cos_similarity(all_sentences,row[8])
            # print(similar_sentences)
            '''
            similar_sentences:上の値を用いて、同じユーザーの似ている日記のidを5つ拾ってくる
            '''
            '''
            classification:推定分類　←afliation使えばすぐ行けそう
            '''
            classification=classification_analysis.get_mostGuess_classification(value_affiliation)
            # print(classification)
            '''
            important_words:重要そうな言葉top3
            '''
            important_words=importantWords_analysis.get_importantWords(value_affiliation)
            # print(important_words)
            '''
            cause_effect_sentences:原因と結果のjson,場所と文字列保持
            そもそも日記に原因結果の因果関係が存在しなくない？
            〇〇は○○に影響を与えたは、歴史や国の説明ではありえても、日記ではありえない。
            '''
            # cause_effect_sentences=causeEffect_analysis.get_causeEffect(value_chunk)


            '''
            special_people:登場人物←これもafliationでいける
            多い順が帰ってくる
            '''
            special_people=special_people_extract.get_special_people(value_affiliation)

            '''
            updated_statistic_at:統計更新日更新処理
            '''
            updated_statistic_at=time.strftime('%Y-%m-%d %H:%M:%S')#現在時刻を文字列でget (timeライブラリ)
            updated_statistic_at=dt.strptime(updated_statistic_at,'%Y-%m-%d %H:%M:%S')# datetime型に変換(datetimeライブラリ)


            '''
            DB更新
            '''

            #DB代入
            #まだ　meta_info,emotions,flavor,similar_sentences,classification,important_words,cause_effect_sentences,special_people,updated_statistic_at
            db.set_single_json_data('diaries',row[0],important_words=important_words,special_people=special_people)
            db.set_single_normal_data('diaries',row[0],classification=classification,emotions=emotions,updated_statistic_at=updated_statistic_at)

            db.set_single_progress(row[0],"diaries",100)

    db.set_multiple_progress(user_id,"statistics",40)
    del db

    print("nlpForDiary終了")

if __name__ == '__main__':
    nlpForDiary()