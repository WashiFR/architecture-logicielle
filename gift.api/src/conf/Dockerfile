FROM ubuntu:kinetic
LABEL authors="loris"

ENV DEBIAN_FRONTEND=noninteractive

RUN sed -i 's|http://\([a-z0-9.-]*\)\?archive.ubuntu.com/ubuntu|http://old-releases.ubuntu.com/ubuntu|' /etc/apt/sources.list && \
    sed -i 's|http://\([a-z0-9.-]*\)\?security.ubuntu.com/ubuntu|http://old-releases.ubuntu.com/ubuntu|' /etc/apt/sources.list && \
    apt-get update && \
    ln -fs /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
    echo "Europe/Paris" > /etc/timezone && \
    apt-get install -y --no-install-recommends tzdata emacs nano vim php php-common php-json php-mysql && \
    dpkg-reconfigure --frontend noninteractive tzdata && \
    apt-get clean

ENTRYPOINT ["top", "-b"]