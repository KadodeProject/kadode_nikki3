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

nlpForPre.nlpForPre()
# nlpForDiary.nlpForDiary()
# nlpForMonth.nlpForMonth()
# nlpForYear.nlpForYear()
nlpForTotal.nlpForTotal()
