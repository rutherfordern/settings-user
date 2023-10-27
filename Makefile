setup-docker:
	docker-compose up -d --build

docker-migrate:
	docker-compose exec app php artisan migrate

lint-cs-fixer:
	php vendor/bin/php-cs-fixer fix -vvv --show-progress=dots
