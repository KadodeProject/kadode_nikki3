```
protoc --proto_path=resources/proto \
  --php_out=. \
  --grpc_out=. \
  --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin \
  ./resources/proto/nlp.proto
```
