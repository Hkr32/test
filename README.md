# Awesome promo code

Test task for hiring.

### Deployment
#### Create project:
```
cp .env.example .env
composer install
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
