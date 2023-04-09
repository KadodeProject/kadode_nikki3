import spacy

# GiNZAの準備
nlp = spacy.load('ja_ginza')

# ルールの追加
# from spacy.pipeline import EntityRuler
# ruler = EntityRuler(nlp)

# config = {
#    'overwrite_ents': True
# }
# ruler = nlp.add_pipe('entity_ruler', config=config)
# patterns = [
#     {'label': 'Person', 'pattern': 'うすゆき'},
#     ]
# ruler.add_patterns(patterns)

# 固有表現抽出の実行
doc = nlp('彼の名はうすゆきである。')
for ent in doc.ents:
    print(
        ent.text+','+ # テキスト
        ent.label_+','+ # ラベル
        str(ent.start_char)+','+ # 開始位置
        str(ent.end_char) # 終了位置
    )
#パイプライン表示
for p in nlp.pipeline:
    print(p)
