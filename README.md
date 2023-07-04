# Laravel Passport Demo

## Setup Instructions

**Clone Repository**
```bash
git clone git@github.com:smit-webpatriot/laravel-passport-demo.git
```

**Copy .env**
```bash
cp .env.example .env
```

**Configure that .env file**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=<password>
```

**Generate APP_KEY**
```bash
php artisan key:generate
```

**Migrate Database with Seeder**
```bash
php artisan migrate --seed
```

**Install Passport**
```bash
php artisan passport:install
```

**Start Project**
```bash
php artisan serve
```

### You can see the project running on port 8000
#### You can access the API.
#### The documentation is present in postman collection present in this directory,
