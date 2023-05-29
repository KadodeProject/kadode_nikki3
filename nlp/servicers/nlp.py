# Standard Library
import asyncio

# First Party Library
from legacy import pythonUseFromPHP
from proto import nlp_pb2, nlp_pb2_grpc


class NlpManager(nlp_pb2_grpc.NlpManagerServicer):
    @staticmethod
    def get_registerer():
        return nlp_pb2_grpc.add_NlpManagerServicer_to_server

    @classmethod
    def get_name_for_reflection_register(self) -> str:
        return nlp_pb2_grpc.DESCRIPTOR.services_by_name[
            self.__name__
        ].full_name

    def GenerateAll(self, request: nlp_pb2.GenerateAllRequest, context):
        user_id = request.userId

        # 非同期で投げっぱなしにてreturnする いわゆるfire and forget
        loop = asyncio.new_event_loop()
        asyncio.set_event_loop(loop)
        loop.run_in_executor(None, pythonUseFromPHP.legacyRun, user_id)
        print(f"userId: {user_id}")

        return nlp_pb2.GenerateAllResponse(start=1)
