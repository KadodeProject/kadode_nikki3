# Third Party Library
import spacy

# First Party Library
from legacy.base import connectDBClass as database


def nlpForPre(user_id):
    # DBインスタンス
    db = database.connectDB()
    # 固有表現ルールcustom
    customNER = db.get_customNER(user_id)
    print(customNER)
    # 固有表現ルールpackage
    packageNER = db.get_packageNER(user_id)
    print(packageNER)
    # パターン生成
    del db

    NERList = []
    NERList.append({"label": "Product_Other", "pattern": "かどで日記"})
    for singleNER in customNER:
        NERList.append({"label": singleNER[0], "pattern": singleNER[1]})
    for singleNER in packageNER:
        NERList.append({"label": singleNER[0], "pattern": singleNER[1]})
    print(NERList)

    # GiNZAの準備
    nlp = spacy.load("ja_ginza")

    # ルールの追加
    config = {"overwrite_ents": True}
    ruler = nlp.add_pipe("entity_ruler", config=config)
    ruler.add_patterns(NERList)

    # 固有表現抽出の実行
    doc = nlp("るしーるさんと遊んだ")
    for ent in doc.ents:
        print(
            ent.text
            + ","
            + ent.label_  # テキスト
            + ","
            + str(ent.start_char)  # ラベル
            + ","
            + str(ent.end_char)  # 開始位置  # 終了位置
        )

    print("nlpForPre処理終了")
    # 日記数を返す(トータルの条件分岐で使用)


if __name__ == "__main__":
    nlpForPre(1)
