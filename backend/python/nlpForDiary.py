
import sys
import time
import json
import datetime

from base import connectDBClass as database

from nlp import special_people_extract
from nlp import classification_analysis
from nlp import dependency_analysis
from nlp import cosSimilarity_analysis

if __name__ == "__main__":
    # from_php = sys.argv#php側の引数
    # user_id=from_php[1]
    user_id=3

    #DBインスタンス
    db = database.connectDB()



    # SELECT id,updated_at,updated_statistic_at,sentence,chunk,token,affiliation,char_length
    rows=db.get_all_diariesPre_from_user(user_id)

    all_sentences=""
    # for row in rows:
    #     all_sentences+=row[2]
    
    '''
    統計更新してから日記側に変更がないとき(updated_statistic_at<=updated_at)→処理しない分岐
    dbに入っている日付2021-09-20 14:29:16
    '''
    for row in rows:
        #個別日記のループ
        try:
            time_updated_at = time.strptime(row[1], '%Y-%m-%d %H:%M:%S')
        except:
            # データない場合
            time_updated_at = time.strptime('2001-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')

        try:
            time_updated_statistic_at = time.strptime(row[2], '%Y-%m-%d %H:%M:%S')
        except:
            # データない場合
            time_updated_statistic_at = time.strptime('2000-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')

            
        if(time_updated_statistic_at>time_updated_at):
            #処理不要 リーダーブルコードに乗ってたやつ
            continue
        else:
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
            '''
            emotions:感情数値化
            '''
            '''
            flavor:ユーザーの日記らしさ、コサイン類似度?TF-IDF?
            '''
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
            # print(value_chunk)
            '''
            cause_effect_sentences:原因と結果のjson,場所と文字列保持
            '''
            '''
            special_people:登場人物←これもafliationでいける
            多い順が帰ってくる
            '''
            special_people=special_people_extract.get_special_people(value_affiliation)

            '''
            updated_statistic_at:統計更新日更新処理
            '''
            updated_statistic_at=time.strftime('%Y-%m-%d %H:%M:%S')
            # print(updated_statistic_at)
            # db.set_single_normal_data('diaries',row[0],updated_statistic_at)



            '''
            DB更新
            '''

            #DB代入
            #まだ　meta_info,emotions,flavor,similar_sentences,classification,important_words,cause_effect_sentences,special_people,updated_statistic_at
            # db.set_single_json_data('diaries',row[0],chunk=chunk,token=token,sentence=sentence,affiliation=affiliation,cause=cause,effect=effect)
            # db.set_single_normal_data('diaries',row[0],char_length=char_length)

            db.set_single_progress(row[0],"diaries",100)


            # #完了を送る
            # db.set_single_progress(row[0],"diaries",100)

    db.set_multiple_progress(user_id,"statistics",40)
    #インスタンス破棄
    del db

    print("nlpForDiary終了")