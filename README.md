# Awesome promo code

Test task for hiring.

### Deployment
#### Create project:
```
composer create-project Igor-Art/test test-app
```
OR
```
composer install
cp .env.example .env
```
### Set database settings in .env

### Build
#### Run migrations:
```
php install.php
```
#### Run php server:
```
php -S 127.0.0.1:8000 -t ./public
```

### Build with docker
```
cp .env.example .env
docker-compose up -d
```
#### Run migrations: 
```
docker-compose exec php /bin/bash
php install.php
```
Database: `localhost:3377`
