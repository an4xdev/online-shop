
- [TODO if I ever want to come back](#todo-if-i-ever-want-to-come-back)
- [Project](#project)
- [Used](#used)
- [Requirements](#requirements)
- [User types](#user-types)
- [Custom data seeding](#custom-data-seeding)
- [Start project](#start-project)
  - [Use batch script](#use-batch-script)
  - [Run separately](#run-separately)

# Online shop project

## TODO if I ever want to come back

- [ ] Modals
- [ ] Buy again button implementation
- [ ] Controller separations and refactoring

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
| Seller        | s[1,2,3,4,5,6]@example.com   | password |
| User          | u[1,2,3,4,5,6]@example.com   | password |

see [DatabaseSeeder](/database/seeders/DatabaseSeeder.php).


## Custom data seeding

In [data.py](/seed_data/data.py) is structure:

```js
products = [
    {
        "category": {
            "sub-category": ["name of subacategory in singular form if necessary", 
            "suffix like: l(liters) or kg(kilograms) or ...",
            ("company", "company", "company", ...)],
            ...
        }
    },
    ...
]
```

product name is" sub-category (```element[0]```) + company (one of ```element[2]```) + unit (```element[1]```).

In [main.py](/seed_data/main.py) you can modify constants.

Run [main.py](/seed_data/main.py) and generated file ```data.sql``` move to ```/database/seeds```.

Run migrations:

```bash
> php artisan migrate
```

Seed database:

```bash
> php artisan db:seed
```

## Start project

### Use batch script

#### With migrations and data seeding

```bash
> run.bat -mds
```

#### Without migrations and data seeding

```bash
> run.bat
```

### Run separately

#### Run laravel

```bash
> php artisan serve
```

#### Install js dependencies

```bash
> npm install
```

#### Run node.js

```bash
> npm run dev
```

#### Run migrations

```bash
> php artisan migrate
```

#### Seed database

```bash
> php artisan db:seed
```
