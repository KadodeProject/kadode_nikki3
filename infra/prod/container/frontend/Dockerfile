FROM node:18-alpine
RUN corepack enable
ENV HOST=0.0.0.0
ENV PORT=2000
WORKDIR /frontend

COPY package.json ./
COPY pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile

COPY . .
RUN chown -R node:node .
# RUNでbuildすると環境変数取れないのでCMDでbuildする
CMD pnpm build && node build/index.js
EXPOSE 2000
