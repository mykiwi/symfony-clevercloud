FROM dunglas/frankenphp
RUN install-php-extensions \
		@composer \
		pdo_sqlite \
		intl \
		opcache
COPY composer* symfony.lock ./
RUN composer install \
		--prefer-dist \
		--no-autoloader \
		--no-scripts \
		--no-progress
COPY . ./
ENV APP_ENV=dev \
    APP_DEBUG=true
RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer dump-autoload --classmap-authoritative --apcu; \
	composer dump-env dev; \
	composer run-script post-install-cmd; sync;
