.DEFAULT_GOAL := help

help: ##@other Show this help.
	@perl -e '$(HELP_FUN)' $(MAKEFILE_LIST)

build:  ##@build build php container
	cd docker/php && echo "Building..." 	&& docker build --build-arg ENABLE_X_DEBUG="on" --build-arg ENABLE_OPCACHE="on" --build-arg ENABLE_PRELOADING="on" --build-arg USER=${USER} --build-arg PASSWD=${PASSWD} --progress plain  -t bolttech:php-latest  . && cd -
up:
	docker-compose up -d
down:
	docker-compose down
shell:
	docker exec -u ${USER} -it bolttech-php /usr/bin/fish

HELP_FUN = \
    %help; \
    while(<>) { push @{$$help{$$2 // 'options'}}, [$$1, $$3] if /^([a-zA-Z\-]+)\s*:.*\#\#(?:@([a-zA-Z\-]+))?\s(.*)$$/ }; \
    print "usage: make [target]\n\n"; \
    for (sort keys %help) { \
    print "${WHITE}$$_:${RESET}\n"; \
    for (@{$$help{$$_}}) { \
    $$sep = " " x (32 - length $$_->[0]); \
    print "  ${YELLOW}$$_->[0]${RESET}$$sep${GREEN}$$_->[1]${RESET}\n"; \
    }; \
    print "\n"; }