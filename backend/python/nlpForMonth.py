
import sys
import time

from base import connectDBClass as database

from nlp import morphological_analysis
from nlp import dependency_analysis
from nlp import cosSimilarity_analysis


def nlpForMonth():
    # from_php = sys.argv#php側の引数
    # user_id=from_php[1]
    user_id=1

    #DBインスタンス
    db = database.connectDB()


    # # データ取得
    # rows=db.get_all_diaries_from_user(user_id)
    
    rows=db.get_all_diaries_from_user(user_id)

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
            '''
            affiliation:アノテーション
            annotationは注釈、affiliationは所属という意味
            ↑誤字っているわけではない。
            '''
            affiliation=meta_generate.get_affiliation_by_ginza(row)
            # print(affiliation)


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
            '''
            important_words:重要そうな言葉top3
            '''
            '''
            cause_effect_sentences:原因と結果のjson,場所と文字列保持
            '''
            '''
            special_people:登場人物←これもafliationでける
            '''

            '''
            updated_statistic_at:統計更新日更新処理
            '''
            # DB更新

            #DB代入
            #まだ　テーブル名、id、任意引数
            # db.set_single_json_data('diaries',row[0],chunk=chunk,token=token,sentence=sentence,affiliation=affiliation,cause=cause,effect=effect)
            # db.set_single_normal_data('diaries',row[0],char_length=char_length)
            db.set_single_progress(row[0],"diaries",100)


            # #完了を送る
            # db.set_single_progress(row[0],"diaries",100)

    db.set_multiple_progress(user_id,"statistics",60)
    #インスタンス破棄
    del db

    print("nlpForMonth終了")


if __name__ == '__main__':
    nlpForMonth()