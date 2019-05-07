FROM mariadb:5.5

ARG GID
ARG UID

RUN usermod -u $UID mysql \
    && groupmod -g $GID mysql
