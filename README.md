
# LaravelVue POS & Inventory System


[![](https://img.shields.io/badge/Laravel%20-8-F05340)](https://laravel.com/docs/8.x/readme)
[![](https://img.shields.io/badge/Vue-2.6.14-41B883)](https://vuejs.org/guide/quick-start.html)
[![](https://img.shields.io/badge/Admin%20LTE%20-3-lightgrey)](https://adminlte.io/docs/3.0/layout.html)
[![](https://img.shields.io/badge/Bootstrap%20-4-%230099CC)](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
[![](https://img.shields.io/badge/Bootstrapvue%20-2.21.2-blueviolet)](https://bootstrap-vue.org/)
[![](https://img.shields.io/badge/sweetalert2-9.17.2-violet)](https://sweetalert2.github.io/)


## About Repository

A Laravel 8 fully functional Point of Sale(POS) and Inventory System + Vue 2 + AdminLTE 3 based for SPA Application.
<!-- <p align="center">
<img src="https://i.imgur.com/mZAHbUL.png">
<img src="https://i.imgur.com/3hhoQnq.png">
<img src="https://i.imgur.com/aHtQkYl.png">
<img src="https://i.imgur.com/V7OuwLn.png">
</p> -->

## Tech Specification

- Laravel 8
- Vue 2 + VueRouter + vue-progressbar + sweetalert2 + laravel-vue-pagination
- Laravel Passport
- Admin LTE 3 + Bootstrap 4 + Font Awesome 5
- PHPUnit Test Case/Test Coverage

## Features

- Modal based Create+Edit, List with Pagination, Delete with Sweetalert
- Login, Register, Forget+Reset Password as default auth
- Profile, Update Profile, Change Password, Avatar
- Product Management 
- User Management
- Settings: Categories, Tags
- Frontend and Backend User ACL with Gate Policy (type: admin/user)
- Simple Static Dashboard
- Developer Options for OAuth Clients and Personal Access Token
- Build with Docker

## Installation

- `git clone https://github.com/AnowarCST/laravel-vue-crud-starter.git`
- `cd laravel-vue-crud-starter/`
- `composer install`
- `cp .env.example .env`
- Update `.env` and set your database credentials
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`
- `npm install`
- `npm run dev`
- `php artisan serve`

## Install with Docker

- `docker-compose up -d`
- `docker exec -it vue-starter /bin/bash`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`
- Application http://localhost:8008/
- Adminer for Database http://localhost:8080/
- DBhost: yourIP:3307, user: root, Password: 123456


## Unit Test

#### run PHPUnit

```bash
# run PHPUnit all test cases
vendor/bin/phpunit
# or Feature test only
vendor/bin/phpunit --testsuite Feature
```

#### Code Coverage Report

```bash
# reports is a directory name
vendor/bin/phpunit --coverage-html reports/
```
A `reports` directory has been created for code coverage report. Open the dashboard.html.


## Credit
This repository is motivated by [Hujjat/laravStart](https://github.com/Hujjat/laravStart) and his awesome video tutorial in [Youtube](https://www.youtube.com/playlist?list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE).

## License

[MIT license](https://opensource.org/licenses/MIT).
