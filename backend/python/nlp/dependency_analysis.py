import spacy
import ginza

if __name__ == '__main__':
    nlp = spacy.load('ja_ginza')
    doc = nlp('ぶいちゃでイチャイチャ、頭の中全部ぐちゃぐちゃ')

    # 文節間の係り受け解析
    for sent in doc.sents:
        for span in ginza.bunsetu_spans(sent):
            for token in span.lefts:
                print(str(ginza.bunsetu_span(token))+' ← '+str(span))