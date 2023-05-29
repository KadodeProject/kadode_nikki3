"""
ここでpython呼び出すことで複数同時実行でおかしくなるのを防ぐ

従来のだと
先に終わったものが100にして、途中で完了判定してしまう
pre終わる前に次の実行行ってエラーでる

が起きるので、全部pythonで呼び出すことで解決
"""

# Standard Library
import sys

# Third Party Library
import nlpForDiary
import nlpForMonthAndYear
import nlpForPre
import nlpForTotal


def legacyRun(user_id):
    print("nlpForPre")
    number_of_diaries = nlpForPre.nlpForPre(user_id)
    print("日記数" + str(number_of_diaries))
    print("nlpForDiary")
    nlpForDiary.nlpForDiary(user_id)
    print("nlpForMonth&year")
    nlpForMonthAndYear.nlpForMonthAndYear(user_id)
    print("nlpForTotal")
    nlpForTotal.nlpForTotal(user_id)
    print("DONE")


if __name__ == "__main__":
    from_php = sys.argv  # php側の引数
    user_id = from_php[1]
    legacyRun(user_id)
