FROM nginx:latest

ARG GID
ARG UID

RUN usermod -u $UID www-data \
    && groupmod -g $GID www-data

ADD nginx.conf /etc/nginx/nginx.conf
