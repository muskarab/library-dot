<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## About Project

Project perpustakaan yang berisi API pusat informasi daftar buku
## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/muskarab/library-dot.git
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Then create the necessary database.

```
php artisan db
create database library-dot
```

And run the initial migrations and seeders.

```
php artisan migrate --seed
```

And Login Admin.

```
user : admin@gmail.com
pass : admin123
```

## Screen Shoot DB

![alt text](https://github.com/muskarab/library-dot/blob/master/ERD.png)
## Screen Shoot App

![alt text](https://github.com/muskarab/library-dot/blob/master/dashboard.png)
![alt text](https://github.com/muskarab/library-dot/blob/master/admin.png)
![alt text](https://github.com/muskarab/library-dot/blob/master/mobile.png)
## Further Ideas

1. Bisa membaca buku secara online
2. Bisa mendownload buku
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
