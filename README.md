# Pastelaria - RESTFull API TDD

## Index

- [About Repository](#about-repository)
- [Tech Specification](#tech-specification)
- [Features](#features)
- [Installation](#installation)
- [Install with Docker](#install-with-docker)
- [Unit Test](#unit-test)
    - [run PHPUnit in local](#run-phpunit-in-local)
    - [run PHPUnit in SAIL (Docker)](#run-phpunit-in-sail-docker)
- [API usage](#api-usage)
    - [API Endpoints](#api-endpoints)
- [License](#license)



## About Repository<a name="about-repository"></a>

This repository is a project of a API RESTful with Lumen 10. 
The project is a CRUD of Clients, Products and Orders. 
The project is using TDD (Test Driven Development) with PHPUnit.

## Tech Specification <a name="tech-specification"></a>

- PHP 8.2
- Lumen 10
- MySQL 8
- Docker
- PHPUnit 10 (Test Case/Test Coverage)

## Features <a name="features"></a>

- Clientes:
  - POST, PUT, GET List, GET with id, DELETE
- Produtos:
  - POST, PUT, GET List, GET with id, DELETE
- Pedidos:
  - POST, PUT, GET List, GET with id, DELETE, POST Order Products, POST remove Order Products, POST Send Order Creation E-mail
- Build with Docker

## Installation <a name="installation"></a>

- `git clone https://github.com/douradomurilo/pastelaria.git`
- `cd pastelaria/`
- `cd src/`
- `composer install`
- `cp .env.example .env`
- Update `.env` and set your database credentials
- `php artisan migrate`
- `php artisan db:seed`
- `php -S localhost:8000 -t public`

## Install with Docker <a name="install-with-docker"></a>

- `git clone https://github.com/douradomurilo/pastelaria.git`
- `cd pastelaria/`
- `cd src/`
- `docker-compose up -d`
- `docker exec -it pastelaria_php bash`
- `composer install`
- `cp .env.example .env`
- `php artisan migrate`
- `php artisan db:seed`
- Application http://localhost:8000/api/

## Unit Test <a name="unit-test"></a>

#### run PHPUnit in local <a name="run-phpunit-in-local"></a>

```bash
# run PHPUnit all test cases
docker exec -it pastelaria_php bash
vendor/bin/phpunit --testedox
```

#### Code Coverage Report <a name="code-coverage-report"></a>

```bash
# reports is a directory name
vendor/bin/phpunit --coverage-html reports/
```
A `reports` directory has been created for code coverage report. Open the dashboard.html.

## API usage <a name="api-usage"></a>

### Postman Collection <a name="postman-collection"></a>

Access: [Pastelaria API Endpoints Collection](https://web.postman.co/workspace/Pastelaria~77dbe364-92b6-44e2-89d1-ac47017f620c/overview)

### Postman Documentation <a name="postman-documentation"></a>

Access: [Pastelaria API Endpoints Collection - Postman Documentation](https://documenter.getpostman.com/view/1115812/2s93z3f5ii)

### API Endpoints <a name="api-endpoints"></a>

- Clients:
  - POST
    - /api/clients
  - PUT
    - /api/clients/{id}
  - GET List
    - /api/clients
  - GET one
    - /api/clients/{id}
  - Delete
    - /api/clients/{id}
- Products:
  - POST
    - /api/products
  - PUT
    - /api/products/{id}
  - GET List
    - /api/products
  - GET with id
    - /api/products/{id}
  - Delete
    - /api/products/{id}
- Orders:
  - POST
    - /api/orders
  - PUT
    - /api/orders/{id}
  - GET List
    - /api/orders
  - GET with id
    - /api/orders/{id}
  - Delete
    - /api/orders/{id}
  - POST Order Product
    - /api/orders/{id}/add-product
  - POST remove Order Product
    - /api/orders/{id}/remove-product
  - POST Send Order Creation E-mail
    - /api/orders/{id}/send-mail


## License <a name="license"></a>

Projeto sendo disponibilizado sobre a licença [MIT license](https://opensource.org/licenses/MIT).

A framework do Lumen é programa open-sourced licenciado sobre a [MIT license](https://opensource.org/licenses/MIT).