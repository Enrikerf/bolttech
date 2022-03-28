FROM php:8.0-fpm-alpine

LABEL version="1.0.0"
LABEL description="V5 PHP8.0 Development"
LABEL maintainer="Enrique Arrabal"

ARG ENABLE_X_DEBUG
ARG ENABLE_OPCACHE
ARG ENABLE_JIT
ARG ENABLE_PRELOADING
ARG USER
ARG PASSWD

# misc
RUN apk add --no-cache $PHPIZE_DEPS  \
    && pecl install -o -f redis  \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis  \
    && docker-php-ext-install pcntl  \
    && docker-php-ext-install mysqli  \
    && docker-php-ext-install pdo_mysql  \
    && docker-php-ext-install opcache \
    && apk add nghttp2-dev npm composer util-linux sqlite fish curl-dev git openssh-client zsh zsh-vcs bash ncurses exa jq htop\
    && npm install -g swagger-cli \
    && apk add php8-redis \
    && apk add php8-pdo_mysql \
    && apk add php8-simplexml \
    && apk add php8-dom \
    && apk add php8-tokenizer \
    && apk add php8-xmlwriter \
    && apk add php8-xml \
    && apk add php8-ctype \
    && apk add php8-sodium \
    && apk add php8-fileinfo \
    && apk add php8-opcache

# xdebug
RUN if [[ "${ENABLE_X_DEBUG}" = "on" ]] ; then \
        echo "installing xdebug"; \
        pecl install xdebug-3.1.2 ; \
        echo "xdebug.mode=coverage,develop,profile,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.client_host='host.docker.internal'" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.client_port=9091" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.idekey='VSCODE'" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        echo "xdebug.log_level='0'" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
        docker-php-ext-enable xdebug; \
    else \
        echo "Skipping xdebug"; \
    fi

#opcode cache
RUN if [[ "${ENABLE_OPCACHE}" = "on" ]] ; then \
      echo "Installing opcode cache tweaks (opcode/jit/preloading)"; \
      echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.memory_consumption=1024" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.interned_strings_buffer=256" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.max_accelerated_files=30000" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.max_wasted_percentage=10" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
      echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    else \
      echo "Skipping opcode cache tweaks (opcode/jit/preloading)"; \
    fi

#preloading
RUN if [[ "${ENABLE_PRELOADING}" = "on" ]] ; then \
      echo "Installing preloading tweaks (opcode/jit/preloading)"; \
      echo "opcache.preload_user=www-data" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini; \
    else \
      echo "Skipping preloading tweaks (opcode/jit/preloading)"; \
    fi

RUN mv "/usr/local/etc/php/php.ini-development" "/usr/local/etc/php/php.ini"

# user
RUN addgroup -S -g 1000 $USER  \
    && adduser $USER -D -g "" -G $USER  \
    && apk add sudo \
    && echo "%$USER ALL=(ALL) ALL" > /etc/sudoers.d/$USER \
    && addgroup $USER wheel \
    && addgroup $USER www-data \
    && echo "$USER:$PASSWD"|chpasswd

COPY config.fish /home/$USER/.config/fish/config.fish

RUN chown -R $USER:$USER /home/$USER
