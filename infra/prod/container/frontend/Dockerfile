FROM node:18-alpine
RUN corepack enable
ENV HOST=0.0.0.0
ENV PORT=2000
WORKDIR /frontend

COPY frontend/package.json ./
COPY frontend/pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile

COPY frontend/postcss.config.js .
COPY frontend/svelte.config.js .
COPY frontend/vite.config.ts .
COPY frontend/tailwind.config.cjs .
COPY frontend/tsconfig.json .

COPY frontend/static ./static
COPY frontend/src ./src
RUN chown -R node:node .
# RUNでbuildすると環境変数取れないのでCMDでbuildする
CMD pnpm build && node build/index.js
EXPOSE 2000
