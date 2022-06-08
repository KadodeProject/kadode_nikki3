

import sys
import json
from datetime import datetime as dt
from datetime import timezone,timedelta

from datetime import datetime as dt
from datetime import timezone,timedelta

from base import connectDBClass as database


def nlpForTotal(user_id):
    #DBインスタンス
    db = database.connectDB()
    yearDataList=db.get_all_yearStatistics_from_user(user_id)

    '''
    year,emotions,word_counts,noun_asc,adjective_asc,important_words,special_people,classifications
    '''
    total_month_words={}
    total_month_diaries={}
    total_emotions=[]

    total_classifications={}
    total_important_words={}
    total_special_people={}
    total_noun_asc={}
    total_adjective_asc={}
    total_words=0
    total_diaries=0
    for yearData in yearDataList:
        print(str(yearData[0])+"年処理")
        # nlp関係はNoneがあるので注
        #jsonはdecodeする
        """
        # 使ってないのでコメントアウト
        value_year=yearData[0]
        """
        value_emotions=json.loads(yearData[1])
        value_word_counts=json.loads(yearData[2])
        value_noun_asc=json.loads(yearData[3])
        value_adjective_asc=json.loads(yearData[4])
        value_important_words=json.loads(yearData[5])
        value_special_people=json.loads(yearData[6])
        value_classifications=json.loads(yearData[7])



        #月別の文字数と日記数

        for word_count in value_word_counts:
            total_month_words[word_count["date"]]=word_count["words"]
            total_month_diaries[word_count["date"]]=word_count["diary"]
            total_words+=word_count["words"]
            total_diaries+=word_count["diary"]
        #月別の感情数推移
        for emotion in value_emotions:
            total_emotions.append({
                "date":emotion["date"],
                "value":emotion["value"],
                })

        #NLP情報足していく、そのままだと[名前,数]で順位並び替え難しいので、名前:数の辞書型にする
        for classification in value_classifications:
            #すでに存在したら加算、なかったら代入
            if(classification[0] in total_classifications):
                total_classifications[classification[0]]+=classification[1]
            else:
                total_classifications[classification[0]]=classification[1]

        for important_word in value_important_words:
            #すでに存在したら加算、なかったら代入
            if(important_word[0] in total_important_words):
                total_important_words[important_word[0]]+=important_word[1]
            else:
                total_important_words[important_word[0]]=important_word[1]

        for special_person in value_special_people:
            #すでに存在したら加算、なかったら代入
            if(special_person[0] in total_special_people):
                total_special_people[special_person[0]]+=special_person[1]
            else:
                total_special_people[special_person[0]]=special_person[1]

        for noun_asc in value_noun_asc:
            #すでに存在したら加算、なかったら代入
            if(noun_asc[0] in total_noun_asc):
                total_noun_asc[noun_asc[0]]+=noun_asc[1]
            else:
                total_noun_asc[noun_asc[0]]=noun_asc[1]

        for adjective_asc in value_adjective_asc:
            #すでに存在したら加算、なかったら代入
            if(adjective_asc[0] in total_adjective_asc):
                total_adjective_asc[adjective_asc[0]]+=adjective_asc[1]
            else:
                total_adjective_asc[adjective_asc[0]]=adjective_asc[1]



    #多い順に並び替え
    total_classifications = sorted(total_classifications.items(), key=lambda x:x[1], reverse=True)
    total_important_words = sorted(total_important_words.items(), key=lambda x:x[1], reverse=True)
    total_special_people = sorted(total_special_people.items(), key=lambda x:x[1], reverse=True)
    total_noun_asc = sorted(total_noun_asc.items(), key=lambda x:x[1], reverse=True)
    total_adjective_asc = sorted(total_adjective_asc.items(), key=lambda x:x[1], reverse=True)

    #辞書型に変換
    # total_classifications=dict(total_classifications)
    # total_important_words=dict(total_important_words)
    # total_special_people=dict(total_special_people)
    # total_noun_asc=dict(total_noun_asc)
    # total_adjective_asc=dict(total_adjective_asc)
    #配列
    # total_month_diaries=list(total_month_diaries)
    # total_emotions=list(total_emotions)
    # total_classifications=list(total_classifications)

    # print(total_important_words)
    # print(total_month_words)
    # print(total_month_diaries)
    # print(total_emotions)
    # print(total_classifications)
    # print(total_special_people)
    # print(total_noun_asc)
    # print(total_adjective_asc)

    # print(total_words)
    # print(total_diaries)


    # print(total_month_words)
    # print(total_month_diaries)
    # print(total_emotions)
    #本目的のDB代入処理
    db.set_statistics_json(user_id,important_words=total_important_words,month_words=total_month_words,month_diaries=total_month_diaries,emotions=total_emotions,classifications=total_classifications,special_people=total_special_people,total_noun_asc=total_noun_asc,total_adjective_asc=total_adjective_asc)
    db.set_statistics_value(user_id,total_words=total_words,total_diaries=total_diaries)
    db.set_multiple_progress(user_id,"statistics",100)

    del db

    print("nlpForMonth終了")

if __name__ == '__main__':
    from_php = sys.argv#php側の引数
    user_id=from_php[1]
    nlpForTotal(user_id)
