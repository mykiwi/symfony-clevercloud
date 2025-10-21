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
		--no-dev \
		--no-scripts \
		--no-progress
COPY . ./
RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer dump-autoload --classmap-authoritative --apcu --no-dev; \
	composer dump-env prod; \
	composer run-script --no-dev post-install-cmd; sync;