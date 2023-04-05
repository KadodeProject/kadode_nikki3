import pprint
import sys

# 「grpc」パッケージと、protocによって生成したパッケージをimportする
import grpc

from proto import nlp_pb2, nlp_pb2_grpc


class NlpClientManager(nlp_pb2_grpc.NlpManagerServicer, BaseServicer):
    def __init__(self):
        pass

    def get_stub(channel):
        return nlp_pb2_grpc.NlpManagerStub(channel)


def main():
    # 引数をチェックする
    if len(sys.argv) < 2:
        print("usage: {} <user_id>".format(sys.argv[0]))
        sys.exit(-1)
    try:
        user_id = int(sys.argv[1])
    except ValueError:
        print("error: invalid user_id `{}'".format(sys.argv[1]))
        print("usage: {} <user_id>".format(sys.argv[0]))
        sys.exit(-1)

    # リクエストに使用するオブジェクト（ここでは「UserRequest」型オブジェクト）を作成
    req = user_pb2.GenerateAllRequest(userId=user_id)

    # サーバーに接続する
    with grpc.insecure_channel("localhost:1234") as channel:

        # 送信先の「stub」を作成する
        stub = nlp_pb2_grpc.NlpManagerStub(channel)

        # リクエストを送信する
        response = stub.GenerateAll(req)

    # 取得したレスポンスの表示
    pprint.pprint(response)


if __name__ == "__main__":
    main()
