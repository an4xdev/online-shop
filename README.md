# Online shop project

## Project

Project created to learn and practise Laravel.

## Used

- [Laravel](https://laravel.com/) - MIT License
- [BladewindUI](https://bladewindui.com/) - MIT License
- [Lorem Picsum](https://picsum.photos/) - MIT License

## Requirements

- Laravel - 11.9
- BladewindUI - 2.6
- Node.js - v22.4.0
- Python - for custom data seeding

## User types

| Type          | Email                        | Password |
| ------------- | ---------------------------- | -------- |
| Administrator | admin@example.com            | password |
| Seller        | seller[1,2,3,4]@ example.com | password |
| User          | user[1,2,3,4]@ example.com   | password |

see [DatabaseSeeder](/database/seeders/DatabaseSeeder.php).


## Custom data seeding

In [data.py](/seed_data/data.py) are categories and names for products(product name is category and name from list).

In [main.py](/seed_data/main.py) you can modify constants.

Run [main.py](/seed_data/main.py) and generated file ```data.sql``` move to ```/database/seeds```.

Run migrations:

```bash
> php artisan migrate:refresh
```

Seed database:

```bash
> php artisan db:seed
```


## Start project

Run laravel:

```bash
> php artisan serve
```

Install js dependencies:

```bash
> npm install
```

Run node.js:

```bash
> npm run dev
```
