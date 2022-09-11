# Install the project

```
composer install
composer dump-autoload
php artisan key:generate
php artisna migrate
cp .\.env.example .env
```
Before edit env you should have to craete database in phpmyadmin, Database name is "employee"
# Edit env file, modify this code
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee
DB_USERNAME=root
DB_PASSWORD=
```
# Run the project

```
php artisan serve
```

# Url for open project
```
http://127.0.0.1:8000/employee
```
