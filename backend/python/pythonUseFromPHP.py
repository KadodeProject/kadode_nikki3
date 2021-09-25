#
'''
ここでpython呼び出すことで複数同時実行でおかしくなるのを防ぐ

従来のだと
先に終わったものが100にして、途中で完了判定してしまう
pre終わる前に次の実行行ってエラーでる

が起きるので、全部pythonで呼び出すことで解決
'''

import nlpForPre
import nlpForDiary
import nlpForMonth
import nlpForYear
import nlpForTotal
import sys
import time


if __name__ == '__main__':
    from_php = sys.argv#php側の引数
    user_id=from_php[1]

    print("nlpForPre")
    nlpForPre.nlpForPre(user_id)
    time.sleep(2)
    print("nlpForDiary")
    nlpForDiary.nlpForDiary(user_id)
    time.sleep(2)
    print("nlpForMonth")
    # nlpForMonth.nlpForMonth(user_id)
    time.sleep(2)
    print("nlpForYear")
    # nlpForYear.nlpForYear(user_id)
    time.sleep(2)
    print("nlpForTotal")
    nlpForTotal.nlpForTotal(user_id)
    time.sleep(2)
    print("DONE")
