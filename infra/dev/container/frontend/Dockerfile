# alpineだとplaywrightの依存で動かないのでdebianを使う
FROM node:18-bullseye-slim
RUN corepack enable
RUN npx playwright install-deps
ENV HOST=0.0.0.0
ENV PORT=2000
WORKDIR /frontend
EXPOSE 2000
