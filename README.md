# Overview

[`PHP v8.3`](https://php.net)

[`MySql v8.2`]

[`Laravel v11`](https://github.com/laravel/laravel)

## Getting started

First, run command make `.env` file and install composer.

```bash
cp .env.example .env
```

After updating the necessary information for the env file, run the command:

```bash
bin/dockx up -d --build
```

```bash
bin/dockx composer install
```

```bash
bin/dockx artisan key:generate
```

Create database and insert data.

```bash
bin/dockx artisan migrate --seed
```
