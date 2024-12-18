build:
	docker-compose up -d --build

stop:
	docker-compose stop

composer:
	docker-compose run --rm composer install

run:
	docker-compose up -d --build && docker-compose run --rm composer install

key-generate:
	docker-compose run --rm php php artisan key:generate

test:
	docker-compose run --rm php ./vendor/bin/pest

.PHONY: build stop composer run key-generate test