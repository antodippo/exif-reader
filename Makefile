build:
	docker-compose build --no-cache

php72-pipeline:
	rm -f composer.lock
	docker-compose run --rm php72 composer install
	docker-compose run --rm php72 vendor/bin/psalm
	docker-compose run --rm php72 vendor/bin/phpunit --coverage-clover=coverage.xml --coverage-text
	docker-compose run --rm php72 vendor/bin/infection --threads=4 --min-msi=95

php73-pipeline:
	rm -f composer.lock
	docker-compose run --rm php73 composer install
	docker-compose run --rm php73 vendor/bin/psalm
	docker-compose run --rm php73 vendor/bin/phpunit --coverage-clover=coverage.xml --coverage-text
	docker-compose run --rm php73 vendor/bin/infection --threads=4 --min-msi=95

php74-pipeline:
	rm -f composer.lock
	docker-compose run --rm php74 composer install
	docker-compose run --rm php74 vendor/bin/psalm
	docker-compose run --rm php74 vendor/bin/phpunit --coverage-clover=coverage.xml --coverage-text
	docker-compose run --rm php74 vendor/bin/infection --threads=4 --min-msi=95