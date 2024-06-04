FROM ubuntu:kinetic
LABEL authors="loris"

RUN DEBIAN_FRONTED=noninteractive && \
    sed -i 's|http://\([a-z0-9.-]*\)\?archive.ubuntu.com/ubuntu|http://old-releases.ubuntu.com/ubuntu|' /etc/apt/sources.list && \
    sed -i 's|http://\([a-z0-9.-]*\)\?security.ubuntu.com/ubuntu|http://old-releases.ubuntu.com/ubuntu|' /etc/apt/sources.list && \
    apt-get update && \
    apt-get install -y --no-install-recommends tzdata emacs nano vim php php-common php-json php-mysql && \
    apt-get clean

ENTRYPOINT ["top", "-b"]