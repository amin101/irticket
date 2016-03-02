# irticket v1.0
a simple tickets system for laravel 5.2+ witch integrates with Laravel default users system.

##Features:
1. Users can create tickets, keep track of their tickets status, giving comments, and close (resolve) their own tickets.
2. Fluent admin panel.
3. Localization (English, Farsi).

##Requirements
**First make sure you have got this Laravel setup working:**

1. [Laravel 5.2](http://laravel.com/docs/5.2#installation)
2. [Users table](http://laravel.com/docs/5.2/authentication)
3. Bootstrap 3+

## Installation :

Install Irticket package
```shell
		composer require amin101/irticket:1.*
```

Add this line on you `config/app.php` in Service Providers section.
```php
		Amin101\Irticket\IrticketServiceProvider::class
```
Run this code to publish migrations and assets
```shell
			php artisan vendor:publish
```
Run three migrations
```shell 
				php artisan migrate
```
				