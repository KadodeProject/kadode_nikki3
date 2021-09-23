'''
コサイン類似度
'''
import spacy

def get_cos_similarity(source,doc):
    doc="十七日、曇れる雲なくなりて曉月夜いとおもしろければ、船を出して漕ぎ行く。このあひだに雲のうへも海の底も同じ如くになむありける"
    nlp = spacy.load('ja_ginza')

    origin = nlp(source)
    now_sentence = nlp(doc)

    similar_sentences=origin.similarity(now_sentence)

    return similar_sentences

