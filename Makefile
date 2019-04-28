.PHONY: up
up:
	@docker-compose up -d

.PHONY: composer-install
composer-install:
	@docker-compose exec php composer install

.PHONY: init-db
init-db:
	@docker-compose exec mysqldb mysql -u lucas -pclaude -e "ALTER USER 'lucas' IDENTIFIED WITH mysql_native_password BY 'claude';"
	@docker-compose exec php composer init-db

.PHONY: start
start:
	@docker-compose exec php bin/console server:run *:80

.PHONY: php-cs-fixer
php-cs-fixer:
	@docker-compose exec php ./vendor/bin/php-cs-fixer fix --config .php_cs.dist

.PHONY: phpstan
phpstan:
	@docker-compose exec php ./vendor/bin/phpstan analyse src/ tests/ --level 1

.PHONY: phpunit
phpunit:
	@docker-compose exec php ./vendor/bin/simple-phpunit

