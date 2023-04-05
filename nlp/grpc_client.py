import sys
from pprint import pprint
from typing import List

# 「grpc」パッケージと、protocによって生成したパッケージをimportする
import grpc

from proto import nlp_pb2, nlp_pb2_grpc


def generate_all_request(stub, user_id: int):
    # リクエストに使用するオブジェクト（ここでは「UserRequest」型オブジェクト）を作成
    req = nlp_pb2.GenerateAllRequest(userId=user_id)
    response = stub.GenerateAll(req)
    # 取得したレスポンスの表示
    pprint(response)
    return response


def main():
    # サーバーに接続する
    channel = grpc.insecure_channel("localhost:1000")
    # 送信先の「stub」を作成する
    stub = nlp_pb2_grpc.NlpManagerStub(channel)
    # リクエストを送信する
    res = generate_all_request(stub=stub, user_id=int(sys.argv[1]))
    return res


if __name__ == "__main__":
    main()
