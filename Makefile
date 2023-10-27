setup-docker:
	docker-compose up -d --build

docker-migrate:
	docker-compose exec app php artisan migrate

start-seed:
	docker-compose exec app php artisan db:seed --class=UserSeeder

lint-cs-fixer:
	php vendor/bin/php-cs-fixer fix -vvv --show-progress=dots
