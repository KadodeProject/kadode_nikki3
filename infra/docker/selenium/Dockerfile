FROM selenium/standalone-chrome
LABEL maintainer="usuyuki"

# RUN apt-get update && apt-get install -y \
#     wget \
#     unzip

# RUN sudo wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb && \
# sudo apt install -y ./google-chrome-stable_current_amd64.deb

# ARG CHROME_VERSION
# # Google Chrome 104.0.5112.79みたいに出てくるのでsedで取り除いて数値だけにする + 末尾がスペースなのでそれを取り除く

# RUN  CHROME_VERSION=`google-chrome --version | sed -e "s/^.\{14\}//"| sed -e "s/.\{1\}$//"` && \
# sudo wget https://chromedriver.storage.googleapis.com/$CHROME_VERSION/chromedriver_linux64.zip && \
# sudo unzip chromedriver_linux64.zip && \
# sudo mv chromedriver /usr/local/bin/


# ENTRYPOINT ["/usr/local/bin/chromedriver"]
