def get_special_people(affiliation):
    # print(affiliation)
    '''
    人を抽出
    {
        name:名前,
        count:登場回数
    }
    '''
    people_list=[]
    for value in affiliation.values():#辞書型なのでvalues必要
        if(value['form']=="Person"):
            # print(value['lemma'])
            people_list.append(value['lemma'])
    # print(people_list)
    '''
    かぶり除去
    '''
    #名前と登場回数を辞書型で保存
    name_counter={}
    for people in people_list:
        try:
            name_counter[people]+=1                 
        except:
            name_counter[people]=1
    
    #それを登録する形に改変
    special_people=[]
    for key,value in name_counter.items():
        special_people.append({
            'name':key,
            'count':value
        })
    print(special_people)
        


    return special_people
