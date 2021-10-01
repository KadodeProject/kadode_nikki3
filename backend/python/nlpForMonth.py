

import time
import json
import collections #配列の要素カウント
from datetime import datetime as dt
from datetime import timezone,timedelta

from datetime import datetime as dt
from datetime import timezone,timedelta

from base import connectDBClass as database

from nlp import special_people_extract
from nlp import classification_analysis
from nlp import importantWords_analysis
from nlp import emotions_analysis
from nlp import causeEffect_analysis
from nlp import dependency_analysis
from nlp import cosSimilarity_analysis

from nlp.dic import dic_to_trie

def nlpForMonth(user_id):
    #DBインスタンス
    db = database.connectDB()

    #タイムゾーン
    JST = timezone(timedelta(hours=+9), 'JST')


    # SELECT id,updated_at,updated_statistic_at,date,sentence,chunk,token,affiliation,char_length,token
    rows=db.get_all_diariesNlpFin_from_user(user_id)


    #月ごとを書くのする辞書型配列
    yMonth_dicList={}

    '''
    月ごとの空の配列作成処理
    '''
    for row in rows:
        value_date=str(row[3])
        date=value_date.split('-')
        # 辞書のラベル用
        date_label=date[0]+"-"+date[1]

        # 月ごとに分岐した空の辞書を作る
        yMonth_dicList[date_label]={
            'emotions':[],
            'word_counts':[],
            'noun_rank':[],
            'adjective_rank':[],
            'important_words':[],
            'special_people':[],
            'classifications':[],
        }
    print("空の配列作成完了")



    
    #その月のデータが既にあったら更新しない
    


    '''
    配列を先に作る
    nullの処理が面倒すぎるので。
    '''
    
    '''
    統計更新してから日記側に変更がないとき(updated_statistic_at<=updated_at)→処理しない分岐
    dbに入っている日付2021-09-20 14:29:16

    id,updated_at,updated_statistic_at,date,char_length,emotions,classification,important_words,special_people
    '''
    for row in rows:
        
        #個別日記のループ
        # if(row[1]!=None):
        #      time_updated_at = row[1]#この時点でdatetime型になっている
        # else:
        #     # データない場合
        #     time_updated_at = time.strptime('1800-1-1 11:11:11', '%Y-%m-%d %H:%M:%S')
        # #統計の更新日取得
        # if(row[2]!=None):
        #     time_statistics_updated_at = row[2]
        # else:
        #     # データない場合
        #     time_statistics_updated_at = dt.strptime('1800-1-1 11:11:11','%Y-%m-%d %H:%M:%S')
        #本当は条件分岐したいが、全部まとめてやったほうが早いので、分岐せず数の暴力でぶん回す
        if(0):
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
            value_date=str(row[3])
            value_char_length=row[4]
            value_emotions=row[5]
            value_classification=row[6]
            value_important_words=json.loads(row[7])
            value_special_people=json.loads(row[8])
            value_token=json.loads(row[9])

            '''
            年月日に分ける
            '''
            date=value_date.split('-')
            # 辞書のラベル用
            date_label=date[0]+"-"+date[1]
            day=date[2]

            '''
            感情まとめ
            emotions
            {
            day:
            value:
            }
            '''
            yMonth_dicList[date_label]['emotions'].append({   
                "day":day,
                "value":value_emotions,
            })
            #足すだけなので処理不要


            '''
            文字数まとめ
            word_counts
            {
            day:
            count:
            }
            '''
            yMonth_dicList[date_label]['word_counts'].append({   
                "day":day,
                "value":value_char_length,
            })


            '''
            名詞多い順3 
            noun_rank
            {
            name:
            count:
            }
            
            形容詞多い順3
            adjective_rank
            {
            name:
            count:
            }

            '''
            #token複数あるので、ループで処理
            for individual_token in value_token.values():
                #残り
                '''
                dict
                {
                    'lemma':#基本形
                    'xPOSTag':#言語依存の品詞(動詞-一般的な)
                }
                '''
                if("名詞" in individual_token['xPOSTag'] ):
                    yMonth_dicList[date_label]['noun_rank'].append(individual_token['lemma'])
                elif("形容詞" in individual_token['xPOSTag']):
                    yMonth_dicList[date_label]['adjective_rank'].append(individual_token['lemma'])


            '''
            重要そうな単語3
            important_words
            {
            name:
            count:
            }
            '''
            for important_word in value_important_words:
                #残り
                #同一要素数でカウントするため、count枠の数だけ要素を追加する(この方が計算しやすい)
                for x in range(important_word['count']):
                    yMonth_dicList[date_label]['important_words'].append(important_word['name'])

            '''
            人物多い順3
            special_people
            {
            name:
            count:
            }
            '''
            for special_person in value_special_people:
                #残り
                #同一要素数でカウントするため、count枠の数だけ要素を追加する(この方が計算しやすい)
                for x in range(special_person['count']):
                    yMonth_dicList[date_label]['special_people'].append(special_person['name'])

            '''
            推定分類3つ
            classification
            {
            name:
            count:
            }
            '''
            yMonth_dicList[date_label]['classifications'].append(value_classification)


               
    #forループここまで

    '''
    DB代入のための準備
    '''
    #月別を一旦消す
    db.delete_depDate_data('statistic_per_months',user_id)
    #空の月別を作成
    for dicKey in yMonth_dicList.keys():
        print(dicKey)
        #日付取得
        date=dicKey.split('-')
        dateForDB=[date[0],date[1]]

        db.set_depDate_insertUpdate_data('statistic_per_months',user_id,dateForDB)


    '''
    ソートとDB代入のループ
    '''
    for yMonthDate,yMonth_dic in yMonth_dicList.items():
        '''
        年月日に分けたものを整形する処理
        '''
        '''
        名詞
        '''
        noun_rank_raw=collections.Counter(yMonth_dic['noun_rank'])#単語要素別にカウント
        noun_rank_all = sorted(noun_rank_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        noun_rank=noun_rank_all[0:10]#上位10個まで
        #代入
        # print(noun_rank)    
        yMonth_dic['noun_rank']=noun_rank
        '''
        形容詞
        '''
        adjective_rank_raw=collections.Counter(yMonth_dic['adjective_rank'])#単語要素別にカウント
        adjective_rank_all = sorted(adjective_rank_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        adjective_rank=adjective_rank_all[0:10]#上位10個まで
        #代入
        # print(adjective_rank)    
        yMonth_dic['adjective_rank']=adjective_rank
        '''
        important_words
        '''
        important_words_raw=collections.Counter(yMonth_dic['important_words'])#単語要素別にカウント
        important_words_all = sorted(important_words_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        important_words=important_words_all[0:10]#上位10個まで
        #代入
        # print(noun_rank)    
        yMonth_dic['important_words']=important_words
        '''
        special_people
        '''
        special_people_raw=collections.Counter(yMonth_dic['special_people'])#単語要素別にカウント
        special_people_all = sorted(special_people_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        special_people=special_people_all[0:10]#上位10個まで
        #代入
        # print(noun_rank)    
        yMonth_dic['special_people']=special_people
        '''
        classification
        '''
        classification_raw=collections.Counter(yMonth_dic['classifications'])#単語要素別にカウント
        classification_all = sorted(classification_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        classification=classification_all[0:10]#上位10個まで
        yMonth_dic['classifications']=classification


        '''
        DB更新
        set_depDate_normal_data
        set_depDate_json_data
        set_depDate_progress

        ここのメモ
        なかったらinsertあったらupdateがしたい
        ↓
        mergeでできるらしい→ダメ
        ifでできるらしい→ダメ(普通のsqlでは使えない)
        caseでできるらしい→構文エラーで上手く行かない
        ↓
        一旦ユーザーのものをすべて消してからDB作る
        その後にupdateする
        →これだと、idがどんどん増えていってしまうが、やむをえない
        21億個目でエラーになってしまう
        '''
        #日付取得
        date=yMonthDate.split('-')
        # 辞書のラベル用
        year=date[0]
        month=date[1]
        dateForDB=[date[0],date[1]]


        #本目的のDB代入処理
        db.set_depDate_json_data('statistic_per_months',user_id,dateForDB,emotions=yMonth_dic['emotions'],word_counts=yMonth_dic['word_counts'],noun_rank=yMonth_dic['noun_rank'],adjective_rank=yMonth_dic['adjective_rank'],important_words=yMonth_dic['important_words'],special_people=yMonth_dic['special_people'],classifications=yMonth_dic['classifications'])
        #createdatもupdatedadも自動で入らない
        now_jst=dt.now(JST)
        db.set_depDate_json_data('statistic_per_months',user_id,dateForDB,emotions=yMonth_dic['emotions'],word_counts=yMonth_dic['word_counts'],noun_rank=yMonth_dic['noun_rank'],adjective_rank=yMonth_dic['adjective_rank'],important_words=yMonth_dic['important_words'],special_people=yMonth_dic['special_people'],classifications=yMonth_dic['classifications'])
        db.set_depDate_normal_data("statistic_per_months",user_id,dateForDB,created_at=now_jst,updated_at=now_jst)

    #ソートと代入のループ終わり

    print( yMonth_dicList)

    db.set_multiple_progress(user_id,"statistics",40)
    del db

    print("nlpForMonth終了")

if __name__ == '__main__':
    nlpForMonth(2)