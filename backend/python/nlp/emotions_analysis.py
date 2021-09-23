
"""
辞書内語句マッチを行う関数
"""

def get_emotion(dic_posi,dic_nega,text):
    #TRIEデータは先に作っておく（毎回ここで呼び出すのはO(n)的な増加なので）
    #TRIEで探査→辞書内語句マッチ
    results_posi= list(dic_posi.search_all(text))
    results_nega= list(dic_nega.search_all(text))
    # print(results_posi,results_nega)#判定結果(単語と木の位置)

    #結果が単語の配列で帰ってくるので、配列の長さから単語の数を取得
    results_posi_count=len(results_posi)
    results_nega_count=len(results_nega)

    #数値化
    if(results_posi_count==results_nega_count):
        results_ave=0.5
    elif(results_posi_count==0):
        results_ave=0.0
    elif(results_nega_count==0):
        results_ave=1.0
    else:
        results_ave=(results_posi_count/(results_nega_count+results_posi_count))
    return results_ave
    #0~1で返す
if __name__ == '__main__':
    kekka=get_emotion("こんにちは、今日の天気は快晴で最悪です。")
    print(kekka)