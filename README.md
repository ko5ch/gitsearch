### Installation

1. Clone repo

2. Change to directory

````
cd gitsearch
````   

3. Install dependencies

````
composer install
````

4. Copy .env file

```
cp .env.example .env
```

5. Modify `DB_*` value in `.env` with your database config.

6. Generate application key:

````
php artisan key:generate
````

7. Run migrate command with '--f' flag for Node modules installation and building frontend, and '--b' flag for Laravel Breeze installation:
````
php artisan boss --f --b
````
