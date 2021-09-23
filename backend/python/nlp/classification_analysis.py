def get_mostGuess_classification(affiliation):
    # print(affiliation)
    categories={}
    #formの種類の数をそれぞれカウント
    for value in affiliation.values():#辞書型なのでvalues必要
        try:
            categories[value['form']]+=1                 
        except:
            categories[value['form']]=1
    
    #多い順に並び変え
    sortred_categories = sorted(categories.items(), key=lambda x:x[1],reverse=True)#タプル型になる

    #でるやつ
    
    
    #多いやつからそれっぽいやつが出たら終了、なかったら「不明」にする
    category="不明"
    for value in sortred_categories:
        if value[0]=="Title_Other":#先輩とか、さん、とか
            continue
        elif value[0]=="N_Person":#人数(1人など)
            continue
        elif value[0]=="Timex_Other":#夏休みなど
            continue
        elif value[0]=="Time":#夜、など
            continue
        elif value[0]=="Date":#1日など
            continue
        elif value[0]=="Unit_Other":#空き部屋で反応
            continue
        elif value[0]=="Doctrine_Method_Other":#LINEで反応
            continue
        elif value[0]=="Period_Week":#２週間など
            continue
        elif value[0]=="Numex_Other":#二(漢数字)など
            continue
        elif value[0]=="Frequency":#一度など
            continue
        elif value[0]=="GOE_Other":
            continue
        elif value[0]=="Period_Year":#1年など
            continue
        elif value[0]=="Percent":#100%など
            continue
        elif value[0]=="Ordinal_Number":#第一法則など
            continue
        elif value[0]=="Period_Time":#3時間など
            continue
        elif value[0]=="Period_Day":#3日など
            continue
        elif value[0]=="Measurement_Other":#32GBなど
            continue
        elif value[0]=="Countx_Other":#一つなど
            continue
        elif value[0]=="Rank":#一番など
            continue
        elif value[0]=="Multiplication":#20倍など
            continue
        elif value[0]=="Speed":#1929→1930など
            continue
        elif value[0]=="Point":#2点など
            continue
        elif value[0]=="Day_Of_Week":#金曜日など
            continue
        elif value[0]=="Plan":#ロケット切り離し
            continue
        elif value[0]=="Incident_Other":#Laravel朝に　に反応
            continue
        elif value[0]=="Period_Month":#2ヶ月間
            continue
        elif value[0]=="Physical_Extent":#2ミリ
            continue
        elif value[0]=="Theater":#LINE
            category="劇"
            break
        elif value[0]=="Offense":#詐欺
            category="攻撃"
            break
        elif value[0]=="Material":#木綿
            category="物"
            break
        elif value[0]=="Compound":#お砂糖
            category="合成物"
            break
        elif value[0]=="Character":#just
            category="正確"
            break
        elif value[0]=="Weapon":#ワクチンで出てきた
            category="武器など"
            break
        elif value[0]=="Location_Other":#空き部屋
            category="空間"
            break
        elif value[0]=="Space":#四畳半
            category="空間"
            break
        elif value[0]=="Era":#バブル期
            category="時代"
            break
        elif value[0]=="Age":#13歳
            category="年齢"
            break
        elif value[0]=="Sport":#スポーツ
            category="スポーツ"
            break
        elif value[0]=="Game":#オリンピックなど
            category="スポーツ"
            break
        elif value[0]=="N_Product":#core2に反応
            category="製品"
            break
        elif value[0]=="Product_Other":#商品名
            category="製品"
            break
        elif value[0]=="Park":#など
            category="公園"
            break
        elif value[0]=="Event_Other":#3アマなど
            category="催し"
            break
        elif value[0]=="N_Event":#3アマなど
            category="催し"
            break
        elif value[0]=="Animal_Disease":#目など
            category="病気"
            break
        elif value[0]=="Animal_Part":#目など
            category="身体"
            break
        elif value[0]=="Academic":#眼科
            category="学術"
            break
        elif value[0]=="School":#一番など
            category="学業"
            break
        elif value[0]=="School_Age":#一番など
            category="学業"
            break
        elif value[0]=="Position_Vocation":#一番など
            category="職業・学業"
            break
        elif value[0]=="Corporation_Other":#一番など
            category="職業"
            break
        elif value[0]=="Conference":#ZOOMなど
            category="会議"
            break
        elif value[0]=="Organization_Other":#法学部
            category="団体"
            break
        elif value[0]=="Show_Organization":#LINE
            category="団体"
            break
        elif value[0]=="N_Organization":#LINE
            category="団体"
            break
        elif value[0]=="International_Organization":#マック
            category="団体"
            break
        elif value[0]=="Family":#〇〇家
            category="家庭"
            break
        elif value[0]=="URL":#http://www
            category="インターネット"
            break
        elif value[0]=="Company":#佐川急便
            category="企業"
            break
        elif value[0]=="Movie":#東京オリンピック
            category="映画"
            break
        elif value[0]=="Flora":#justで出たけど、意味的には植物相
            category="植物"
            break
        elif value[0]=="Drug":#予防接種で出た
            category="医療"
            break
        elif value[0]=="Nature_Color":
            category="色"
            break
        elif value[0]=="Book":#コロナ
            category="本"
            break
        elif value[0]=="Culture":#GHQ占領
            category="社会の行動様式"
            break
        elif value[0]=="Facility_Part":#プール
            category="施設"
            break
        elif value[0]=="Facility_Other":#宇大
            category="施設"
            break
        elif value[0]=="Museum":#
            category="施設"
            break
        elif value[0]=="Province":#広島
            category="場所"
            break
        elif value[0]=="Island":#礼文島
            category="場所"
            break
        elif value[0]=="Domestic_Region":
            category="場所"
            break
        elif value[0]=="Worship_Place":#峰キャン
            category="場所"
            break
        elif value[0]=="Station":#永野
            category="場所"
            break
        elif value[0]=="LOC":
            category="場所"
            break
        elif value[0]=="City":
            category="場所"
            break
        elif value[0]=="Country":
            category="場所"
            break
        elif value[0]=="Continental_Region":#アフリカ
            category="場所"
            break
        elif value[0]=="Spa":#有馬温泉
            category="場所"
            break
        elif value[0]=="Mountain":#佐久間ダム
            category="場所"
            break
        elif value[0]=="Continental_Region":#上越線
            category="鉄道"
            break
        elif value[0]=="Tumulus":#三内丸山遺跡
            category="歴史"
            break
        elif value[0]=="Money":
            category="お金"
            break
        elif value[0]=="Person":
            category="人物"
            break
        elif value[0]=="Name_Other":
            category="人物"
            break
        elif value[0]=="Military":#自衛隊
            category="軍"
            break
        elif value[0]=="Clothing":#シャーペンで出たが
            category="衣服"
            break
        elif value[0]=="Natural_Phenomenon_Other":#シャーペンで出たが
            category="地球環境"
            break
        elif value[0]=="Natural_Disaster":#シャーペンで出たが
            category="自然災害"
            break
        elif value[0]=="Earthquake":#地震
            category="自然災害"
            break
        elif value[0]=="Dish":
            category="食べ物"
            break
        elif value[0]=="Food_Other":
            category="食べ物"
            break
        elif value[0]=="Planet":#太陽
            category="宇宙"
            break
        elif value[0]=="Mammal":#人間
            category="動物"
            break
        elif value[0]=="Bird":
            category="動物"
            break
        elif value[0]=="Nationality":#日本人
            category="国"
            break
        elif value[0]=="National_Language":#言語
            category="言語"
            break
        elif value[0]=="Government":#日本政府
            category="政府"
            break
        elif value[0]=="Treaty":#LINE
            category="条約"
            break
        elif value[0]=="Law":#モンテカルロ法
            category="方法・法律"
            break
        elif value[0]=="Car":#サクシード
            category="車"
            break
        elif value[0]=="Show":#Laravel
            category="コンテンツ"
            break
        elif value[0]=="Broadcast_Program":#Laravel
            category="コンテンツ"
            break
        elif value[0]=="Occasion_Other":#新入生セミナー
            category="催し物"
            break
        elif value[0]=="GOE_Other":#paypayとかjustで反応
            category=value[0]
            break
        elif value[0]=="Weight":#ATOM Matrix
            category=value[0]
            break
        elif value[0]=="GPE_Other":#マイクラ、陽東に反応
            category=value[0]
            break
        elif value[0]=="Reptile":#people でも意味は爬虫類
            category=value[0]
            break
        else:
            # print("未確認"+value[0])
            category=value[0]
    # print(category)
    return category