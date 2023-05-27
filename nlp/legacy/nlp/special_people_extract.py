def get_special_people(affiliation):
    # print(affiliation)
    """
    人を抽出
    {
        name:名前,
        count:登場回数
    }
    """
    people_list = []
    for value in affiliation.values():  # 辞書型なのでvalues必要
        if value["form"] == "Person":
            # print(value['lemma'])
            people_list.append(value["lemma"])
    # print(people_list)
    """
    かぶり除去
    """
    # 名前と登場回数を辞書型で保存
    name_counter = {}
    for people in people_list:
        name_counter[people] = (
            name_counter[people] + 1 if people in name_counter else 1
        )

    # それを登録する形に改変
    special_people_raw = []
    for key, value in name_counter.items():
        special_people_raw.append({"name": key, "count": value})
    # print(special_people_raw)

    # 多い順に並び替え
    special_people = sorted(
        special_people_raw, key=lambda x: x["count"], reverse=True
    )
    return special_people
