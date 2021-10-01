import time

from datetime import datetime as dt

from base import connectDBClass as database

from nlp import meta_generate


def nlpForPre(user_id):

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
        #日記の更新日取得
       
        if(row[4]!=None):
             time_updated_at = row[4]#この時点でdatetime型になっている
        else:
            # データない場合
            time_updated_at = time.strptime('1800-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')
        #統計の更新日取得
        if(row[5]!=None):
            time_statistics_updated_at = row[5]
        else:
            # データない場合
            time_statistics_updated_at = dt.strptime('1800-1-1 11:11:11','%Y-%m-%d %H:%M:%S')
        # print(time_updated_at)
        # print(time_statistics_updated_at)
        # print(type(time_updated_at))
        # print(type(time_statistics_updated_at))
            
        if(time_statistics_updated_at>time_updated_at):
            #処理不要 リーダーブルコードに乗ってたなんとかかんとかってやつ
            print(str(row[0])+"スキップ")

            continue
        else:
            print(str(row[0])+"pre処理")
            db.set_multiple_progress(row[0],"diaries",10)

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


            '''
            更新日更新はnlpDorDiaryで行う
            '''

            '''
            DB代入
            '''
            db.set_single_json_data('diaries',row[0],chunk=chunk,token=token,sentence=sentence,affiliation=affiliation)
            db.set_single_normal_data('diaries',row[0],char_length=char_length)
            db.set_single_progress(row[0],"diaries",50)

    db.set_multiple_progress(user_id,"statistics",20)
    #インスタンス破棄
    del db

    print("nlpForPre処理終了")
if __name__ == '__main__':
    nlpForPre(2)