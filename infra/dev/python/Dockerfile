FROM python:3-slim
WORKDIR /nlp
RUN apt update && apt -y install default-libmysqlclient-dev gcc
COPY nlp/requirements.txt /nlp/requirements.txt
RUN pip install -r requirements.txt
RUN echo "source /usr/share/bash-completion/completions/git" >> ~/.bashrc
