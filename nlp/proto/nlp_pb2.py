# -*- coding: utf-8 -*-
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/nlp.proto
"""Generated protocol buffer code."""
from google.protobuf.internal import builder as _builder
from google.protobuf import descriptor as _descriptor
from google.protobuf import descriptor_pool as _descriptor_pool
from google.protobuf import symbol_database as _symbol_database
# @@protoc_insertion_point(imports)

_sym_db = _symbol_database.Default()




DESCRIPTOR = _descriptor_pool.Default().AddSerializedFile(b'\n\x0fproto/nlp.proto\x12\x03nlp\"$\n\x12GenerateAllRequest\x12\x0e\n\x06userId\x18\x01 \x01(\r\"$\n\x13GenerateAllResponse\x12\r\n\x05start\x18\x01 \x01(\x08\x32P\n\nNlpManager\x12\x42\n\x0bGenerateAll\x12\x17.nlp.GenerateAllRequest\x1a\x18.nlp.GenerateAllResponse\"\x00\x62\x06proto3')

_builder.BuildMessageAndEnumDescriptors(DESCRIPTOR, globals())
_builder.BuildTopDescriptorsAndMessages(DESCRIPTOR, 'proto.nlp_pb2', globals())
if _descriptor._USE_C_DESCRIPTORS == False:

  DESCRIPTOR._options = None
  _GENERATEALLREQUEST._serialized_start=24
  _GENERATEALLREQUEST._serialized_end=60
  _GENERATEALLRESPONSE._serialized_start=62
  _GENERATEALLRESPONSE._serialized_end=98
  _NLPMANAGER._serialized_start=100
  _NLPMANAGER._serialized_end=180
# @@protoc_insertion_point(module_scope)
