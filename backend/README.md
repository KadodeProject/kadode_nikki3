```
protoc --proto_path=resources/proto \
  --php_out=app/Services/Grpc \
  --grpc_out=app/Services/Grpc \
  --plugin=protoc-gen-grpc=/usr/local/bin/grpc_php_plugin \
  ./resources/proto/nlp.proto
```
