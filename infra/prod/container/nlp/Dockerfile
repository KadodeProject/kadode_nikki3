FROM python:3.11-slim-bullseye
LABEL maintainer="usuyuki"

WORKDIR /nlp

ARG apt_get_server=ftp.jaist.ac.jp/pub/Linux

ENV POETRY_HOME=/opt/poetry
ENV PATH="/root/.cargo/bin:$PATH"
RUN \
    #
    # apt-get
    sed -i s@archive.ubuntu.com@${apt_get_server}@g /etc/apt/sources.list && \
    apt-get update -qq && \
    apt-get install -y --no-install-recommends \
    curl \
    apt-transport-https \
    gcc \
    default-libmysqlclient-dev \
    sudo \
    && \
    #
    # arm向けビルドでrustコンパイラが必要なので
    curl --proto '=https' --tlsv1.2 -sSf https://sh.rustup.rs | sh -s -- -y && \
    #
    # poetryインストール
    curl -sSL https://install.python-poetry.org | python && \
    cd /usr/local/bin && \
    ln -s /opt/poetry/bin/poetry && \
    #
    # 容量減らすやつ
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

ENV PATH $POETRY_HOME/bin:$PATH

COPY poetry.lock pyproject.toml ./
RUN poetry config virtualenvs.create false && poetry install

COPY . .

EXPOSE 1000

CMD ["python", "grpc_manager.py"]
