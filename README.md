## Установка

1. Склонируйте проект
2. Выполните установку.
```sh
make setup-docker
```
3. Запустите миграции
```sh
make docker-migrate
```
4. Запустите сиды
```sh
make start-seeds
```

## Пути

### /api/v1/auth/login
Получить токен для авторизации в последующих запросах.

email - admin@admin.ru, password - admin.

### /api/v1/profile/edit/nickname
Отправить код для подтверждения изменения nickname. По умолчанию код отправляет на email.

### /api/v1/profile/verify-change-nickname
Подтвердить код и отправить новый ник.

verification_code - .
nickname - .

### /api/v1/profile/edit/verification-method
Изменить способ подтверждения изменений.
