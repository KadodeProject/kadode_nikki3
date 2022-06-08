
import json
import sys
import collections #配列の要素カウント
from datetime import datetime as dt
from datetime import timezone,timedelta

from datetime import datetime as dt
from datetime import timezone,timedelta

from base import connectDBClass as database


def nlpForMonthAndYear(user_id):
    #DBインスタンス
    db = database.connectDB()

    #タイムゾーン
    JST = timezone(timedelta(hours=+9), 'JST')


    # SELECT id,updated_at,updated_statistic_at,date,sentence,chunk,token,affiliation,char_length,token
    rows=db.get_all_diariesNlpFin_from_user(user_id)


    #月ごとを格納する辞書型配列
    yMonth_dicList={}
    #年ごとを格納するための辞書型配列
    year_dicList={}

    '''
    月ごとの空の配列作成処理
    '''
    for row in rows:
        value_date=str(row[3])
        date=value_date.split('-')
        # 辞書のラベル用
        date_label=date[0]+"-"+date[1]

        # 月ごとに分岐した空の辞書を作る(重複は上書きされるの問題なし)
        yMonth_dicList[date_label]={
            'emotions':[],
            'word_counts':[],
            'noun_rank':[],
            'adjective_rank':[],
            'important_words':[],
            'special_people':[],
            'classifications':[],
        }
        # 年ごとに分岐した空の辞書を作る(重複は上書きされるの問題なし)
        year_dicList[date[0]]={
            'emotions':[],
            'word_counts':[],
            'emotions_raw':{},
            'emotions_counter_for_raw':{},
            'word_counts_raw':{},
            'diary_counter':{},
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
        # if(0):
        #     #処理不要 リーダーブルコードに乗ってたやつ
        #     print(str(row[0])+"スキップ")
        #     continue
        # else:
        print(str(row[0])+"Diary処理")
        # nlp関係はNoneがあるので注
        #jsonはdecodeする
        """
        使ってないのでコメントアウト
        value_id=row[0]
        value_updated_at=row[1]
        value_updated_statistic_at=row[2]
        """
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
        year=date[0]
        day=date[2]

        '''
        感情まとめ
        emotions
        {
        date:
        value:
        }
        '''
        yMonth_dicList[date_label]['emotions'].append({
            "date":day,
            "value":value_emotions,
        })
        #年別用　無ければ作成、あれば足す
        if date_label in year_dicList[year]['emotions_raw'].keys():
            year_dicList[year]['emotions_raw'][date_label]+=value_emotions
            year_dicList[year]['emotions_counter_for_raw'][date_label]+=1
        else:
            year_dicList[year]['emotions_raw'][date_label]=value_emotions
            year_dicList[year]['emotions_counter_for_raw'][date_label]=1

        #足すだけなので処理不要


        '''
        文字数まとめ
        word_counts
        {
        date:
        count:
        }
        '''
        yMonth_dicList[date_label]['word_counts'].append({
            "date":day,
            "words":value_char_length,
        })
        #年別用　無ければ作成、あれば足す
        if date_label in year_dicList[year]['word_counts_raw'].keys():
            year_dicList[year]['word_counts_raw'][date_label]+=value_char_length
            year_dicList[year]['diary_counter'][date_label]+=1
        else:
            year_dicList[year]['word_counts_raw'][date_label]=value_char_length
            year_dicList[year]['diary_counter'][date_label]=1


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
                year_dicList[year]['noun_rank'].append(individual_token['lemma'])
            elif("形容詞" in individual_token['xPOSTag']):
                yMonth_dicList[date_label]['adjective_rank'].append(individual_token['lemma'])
                year_dicList[year]['adjective_rank'].append(individual_token['lemma'])


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
                year_dicList[year]['important_words'].append(important_word['name'])

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
                year_dicList[year]['special_people'].append(special_person['name'])

        '''
        推定分類
        classification
        {
        name:
        count:
        }
        '''
        yMonth_dicList[date_label]['classifications'].append(value_classification)
        year_dicList[year]['classifications'].append(value_classification)



    #forループここまで

    '''
    DB代入のための準備
    '''
    yearList=[]#年別で使う
    #空の月別を再生成
    db.delete_depDate_data('statistic_per_months',user_id)
    for dicKey in yMonth_dicList.keys():
        #日付取得
        date=dicKey.split('-')
        dateForDB=[date[0],date[1]]

        db.set_depDate_insertUpdate_data('statistic_per_months',user_id,dateForDB)
        #年情報を収集(あとで重複消す)
        yearList.append(date[0])

    #空の年別を作成
    db.delete_depDate_data('statistic_per_years',user_id)
    yearListUnique=set(yearList)#重複消す
    for year in yearListUnique:
        db.set_depDate_insertUpdate_data('statistic_per_years',user_id,[year])



    '''
    ソートとDB代入のループ(月別)
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
        dateForDB=[date[0],date[1]]#[year,month]


        #本目的のDB代入処理
        db.set_depDate_json_data('statistic_per_months',user_id,dateForDB,emotions=yMonth_dic['emotions'],word_counts=yMonth_dic['word_counts'],noun_rank=yMonth_dic['noun_rank'],adjective_rank=yMonth_dic['adjective_rank'],important_words=yMonth_dic['important_words'],special_people=yMonth_dic['special_people'],classifications=yMonth_dic['classifications'])
        #createdatもupdatedadも自動で入らない
        now_jst=dt.now(JST)
        db.set_depDate_normal_data("statistic_per_months",user_id,dateForDB,created_at=now_jst,updated_at=now_jst,statistic_progress=100)

    #ソートと代入のループ終わり

    # print( yMonth_dicList)

    db.set_multiple_progress(user_id,"statistics",40)


    '''
    ソートとDB代入のループ(年別)
                'emotions_raw':{},
            'word_counts_raw':{},
    '''
    for yearDate,year_dic in year_dicList.items():
        '''
        年別のみにまとめる処理
        '''
        #感情を整形
        for y_m, value in year_dic['emotions_raw'].items():
            this_diary=year_dic['emotions_counter_for_raw'][y_m]
            year_dic['emotions'].append({
                "date":y_m,
                "value":value/this_diary,
        })
        #文字数 配列から辞書型への整形
        for y_m, value in year_dic['word_counts_raw'].items():
            year_dic['word_counts'].append({
                "date":y_m,
                "words":value,#平均文字数に変換
                "diary":year_dic['diary_counter'][y_m],#平均文字数に変換
        })
        '''
        ソートして多いものだけ取り出す処理
        '''
        '''
        名詞
        '''
        noun_rank_raw=collections.Counter(year_dic['noun_rank'])#単語要素別にカウント
        noun_rank_all = sorted(noun_rank_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        noun_rank=noun_rank_all[0:20]#上位20個まで
        #代入
        # print(noun_rank)
        year_dic['noun_rank']=noun_rank
        '''
        形容詞
        '''
        adjective_rank_raw=collections.Counter(year_dic['adjective_rank'])#単語要素別にカウント
        adjective_rank_all = sorted(adjective_rank_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        adjective_rank=adjective_rank_all[0:20]#上位20個まで
        #代入
        # print(adjective_rank)
        year_dic['adjective_rank']=adjective_rank
        '''
        important_words
        '''
        important_words_raw=collections.Counter(year_dic['important_words'])#単語要素別にカウント
        important_words_all = sorted(important_words_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        important_words=important_words_all[0:20]#上位20個まで
        #代入
        # print(noun_rank)
        year_dic['important_words']=important_words
        '''
        special_people
        '''
        special_people_raw=collections.Counter(year_dic['special_people'])#単語要素別にカウント
        special_people_all = sorted(special_people_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        special_people=special_people_all[0:20]#上位20個まで
        #代入
        # print(noun_rank)
        year_dic['special_people']=special_people
        '''
        classification
        '''
        classification_raw=collections.Counter(year_dic['classifications'])#単語要素別にカウント
        classification_all = sorted(classification_raw.items(), key=lambda x:x[1],reverse=True)#値の大きい順にソート
        classification=classification_all[0:20]#上位20個まで
        year_dic['classifications']=classification





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
        year=yearDate
        dateForDB=[year]


        #本目的のDB代入処理
        db.set_depDate_json_data('statistic_per_years',user_id,dateForDB,emotions=year_dic['emotions'],word_counts=year_dic['word_counts'],noun_rank=year_dic['noun_rank'],adjective_rank=year_dic['adjective_rank'],important_words=year_dic['important_words'],special_people=year_dic['special_people'],classifications=year_dic['classifications'])
        #createdatもupdatedadも自動で入らない
        now_jst=dt.now(JST)
        db.set_depDate_normal_data("statistic_per_years",user_id,dateForDB,created_at=now_jst,updated_at=now_jst,statistic_progress=100)


    db.set_multiple_progress(user_id,"statistics",60)

    del db

    print("nlpForMonth終了")

if __name__ == '__main__':
    from_php = sys.argv#php側の引数
    user_id=from_php[1]
    nlpForMonthAndYear(user_id)
