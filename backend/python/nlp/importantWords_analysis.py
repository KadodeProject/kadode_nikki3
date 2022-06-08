def get_importantWords(affiliation):
    '''
    返り値
    旧:[単語1,単語1,単語1]
    ↓
    {
        name:名前,
        count:登場回数
    }

    '''
    # print(affiliation)
    words={}
    #formの種類の数をそれぞれカウント
    for value in affiliation.values():#辞書型なのでvalues必要

        '''
        さん、くんは除く
        人物は除く
        != でorするとtrueになるので、この書き方
        '''
        if(value['lemma']=="さん" or value['lemma']=="くん" or value['form']=="Person" or value['form']=="Name_Other"):
            continue
        else:
            words[value['lemma']]=words[value['lemma']]+1 if value['lemma'] in words else 1

    #それを登録する形に改変
    important_words_raw=[]
    for key,value in words.items():
        important_words_raw.append({
            'name':key,
            'count':value
        })

    #多い順に並び変え
    important_words = sorted(important_words_raw, key=lambda x:x['count'],reverse=True)#タプル型になる

    #一番多いカテゴリを取得
    # important_words=[]
    # print(sortred_words)
    # try:
    #     important_words.append(sortred_words[0][0])
    # except:
    #     important_words.append("見つけることができませんでした")
    # try:
    #     important_words.append(sortred_words[1][0])
    # except:
    #     pass
    # try:
    #     important_words.append(sortred_words[2][0])
    # except:
    #     pass


    # print(important_words)#多い固有表現トップ3→全部出させる方式へ変更
    return important_words
