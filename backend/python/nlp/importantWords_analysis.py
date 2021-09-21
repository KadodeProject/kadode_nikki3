def get_importantWords(affiliation):
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
            try:
                words[value['lemma']]+=1                 
            except:
                words[value['lemma']]=1
    
    #多い順に並び変え
    sortred_words = sorted(words.items(), key=lambda x:x[1],reverse=True)#タプル型になる

    #一番多いカテゴリを取得
    important_words=[]
    try:
        important_words.append(sortred_words[0][0])
    except:
        important_words.append("見つけることができませんでした")
    try:
        important_words.append(sortred_words[1][0])
    except:
        pass
    try:
        important_words.append(sortred_words[2][0])
    except:
        pass


    # print(important_words)#多い固有表現トップ3
    return important_words