kubectl create namespace nginx-ingress
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v1.1.0/deploy/static/provider/cloud/deploy.yaml
kubectl get svc -n nginx-ingress

```
kubectl create namespace kadode-prod
kubectl apply -f infra/prod/manifest/backend \
&& kubectl apply -f infra/prod/manifest/frontend \
&& kubectl apply -f infra/prod/manifest/nlp \
&& kubectl apply -f infra/prod/manifest/mysql \
&& kubectl apply -f infra/prod/manifest/redis \
&& kubectl apply -f infra/prod/manifest/
```

# 全体の稼働状況を確認

```
kubectl get all -n kadode-prod
kubectl get pods -n kadode-prod
kubectl logs backend-app-6c945cf5d4-49tw2 -n kadode-prod
kubectl describe po backend-app-6c945cf5d4-49tw2 -n kadode-prod
kubectl get events -n kadode-prod
```

コンテナに入る(git bash だとだめなので WSL で入る)

```
kubectl exec --stdin --tty backend-app-6c945cf5d4-44dq8 -n kadode-prod -- /bin/bash
kubectl exec -it backend-service -c backend -n kadode-prod -- /bin/bash
```

```
kubectl exec --stdin --tty mysql-db-5849d68b45-hf99h -n kadode-prod -- /bin/mysql -u phper -p
```

# 削除

```
kubectl delete namespace kadode-prod

kubectl delete -f infra/prod/manifest/ \
&& kubectl delete -f infra/prod/manifest/backend \
&& kubectl delete -f infra/prod/manifest/frontend \
&& kubectl delete -f infra/prod/manifest/nlp \
&& kubectl delete -f infra/prod/manifest/mysql \
&& kubectl delete -f infra/prod/manifest/redis

```

# 更新

```
kubectl rollout restart deploy nlp-app -n kadode-prod
```
