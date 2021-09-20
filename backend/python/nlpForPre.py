
import sys
import time

from base import connectDBClass as database

from nlp import morphological_analysis
from nlp import dependency_analysis
from nlp import meta_generate


if __name__ == "__main__":
    # from_php = sys.argv#php側の引数
    # user_id=from_php[1]
    user_id=1

    #DBインスタンス
    db = database.connectDB()

    #進行度を10%に
    db.set_multiple_progress(user_id,"statistics",10)
    # # データ取得
    # rows=db.get_all_diaries_from_user(user_id)
    
    rows=db.get_all_diaries_from_user(user_id)

    '''
    統計更新してから日記側に変更がないとき(updated_statistic_at<=udpated_at)→処理しない分岐
    dbに入っている日付2021-09-20 14:29:16
    '''
    for row in rows:
        #個別日記のループ
        try:
            time_udpated_at = time.strptime(row[4], '%Y-%m-%d %H:%M %S')
        except:
            # データない場合
            time_udpated_at = time.strptime('2001-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')

        try:
            time_updated_statistic_at = time.strptime(row[5], '%Y-%m-%d %H:%M:%S')
        except:
            # データない場合
            time_updated_statistic_at = time.strptime('2000-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')

            
        if(time_updated_statistic_at>time_udpated_at):
            #処理不要 リーダーブルコードに乗ってたやつ
            pass
        else:
            print("ないよ")

            '''
            char_length:日記の文字数
            '''
            char_length = len(row[2])#pythonはマルチバイトそのままでいける口
            # print(char_length)

            '''
            token:形態素解析
            chunk:係り受け構造
            sentence:一文ごとの位置(係り受けで使う)
            '''
           
            token,chunk,sentence=meta_generate.get_tokenChunkSentence_by_ginza(row)
            # print(sentence)
            # print(token)
            # print(chunk

            '''
            affiliation:アノテーション
            annotationは注釈、affiliationは所属という意味
            ↑誤字っているわけではない。
            '''
            affiliation=meta_generate.get_affiliation_by_ginza(row)
            # print(affiliation)
            #cause:原因
            #effect:結果
            cause,effect=meta_generate.get_causeEffect_by_ginza(row)


            # #更新日更新
            # DB更新

            #DB代入
            #まだ　テーブル名、id、任意引数
            # db.set_single_json_data('diaries',row[0],chunk=chunk,token=token,sentence=sentence,affiliation=affiliation,cause=cause,effect=effect)
            # db.set_single_normal_data('diaries',row[0],char_length=char_length)


            # #完了を送る
            # db.set_single_progress(row[0],"diaries",100)
            # db.set_multiple_progress(user_id,"statistics",40)

    #インスタンス破棄
    del db

    print("終了")