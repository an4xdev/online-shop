- [Online shop project](#online-shop-project)
  - [Project](#project)
  - [Used](#used)
  - [Requirements](#requirements)
  - [User types](#user-types)
  - [Custom data seeding](#custom-data-seeding)
  - [Start project](#start-project)

# Online shop project

## Project

Project created to learn and practise Laravel.

## Used

- [Laravel](https://laravel.com/) - MIT License
- [BladewindUI](https://bladewindui.com/) - MIT License
- [Lorem Picsum](https://picsum.photos/) - MIT License
- [purl](https://github.com/allmarkedup/purl) - MIT License

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

In [data.py](/seed_data/data.py) is structure:

```js
products = [
    {
        "category": {
            "sub-category": ["name of subacategory in singular form if necessary", "suffix like: l(liters) or kg(kilograms) or ...",("company", "company", "company", ...)],
            ...
        }
    },
    ...
]
```

product name is" sub-category (element[0]) + company (one of element[2]) + unit (element[1]).

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

Run migrations:

```bash
> php artisan migrate:refresh
```

Seed database:

```bash
> php artisan db:seed
```
