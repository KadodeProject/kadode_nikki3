import json
from collections.abc import Iterable
from typing import List

from google.protobuf import json_format
from legacy import pythonUseFromPHP

# 「grpc」パッケージと、grpc_tools.protocによって生成したパッケージをimportする
from proto import nlp_pb2, nlp_pb2_grpc


class NlpManager(nlp_pb2_grpc.NlpManagerServicer):
    """
    サービス定義から生成されたクラスを継承して、
    定義したリモートプロシージャに対応するメソッドを実装する。
    クライアントが引数として与えたメッセージに対応するオブジェクト
    context引数にはRPCに関する情報を含むオブジェクトが渡される
    """

    @staticmethod
    def get_registerer():
        return nlp_pb2_grpc.add_NlpManagerServicer_to_server

    @classmethod
    def get_name_for_reflection_register(self) -> str:
        return nlp_pb2_grpc.DESCRIPTOR.services_by_name[self.__name__].full_name

    def GenerateAll(self, request: nlp_pb2.GenerateAllRequest, context):
        # クライアントが送信した引数はrequest引数に格納され、
        # このオブジェクトに対しては一般的なPythonオブジェクトと
        # 同様の形でプロパティにアクセスできる
        user_id = request.userId
        print(f"userId: {user_id}")
        pythonUseFromPHP.legacyRun(user_id)

        return nlp_pb2.GenerateAllResponse(start=1)
