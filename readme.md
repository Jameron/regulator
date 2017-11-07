This package has been built to work with Laravel 5.4.33, later versions may not be compatible.

    composer create-project laravel/laravel your-project-name 5.4.33

You may need to add this to your AppServiceProvider
```php
use Illuminate\Support\Facades\Schema;

function boot()
{
    Schema::defaultStringLength(191);
}
```

Add to your providers:

```php
        Jameron\Regulator\RegulatorServiceProvider::class,
```

Add to your Facades:

```php
        'Regulator' => Jameron\Regulator\Facades\RegulatorFacade::class,
```

php artisan vendor:publish
php artisan migrate

For the seed you can call it directly via command line or add it to your applications seeder file

Called via command line:

```php artisan db:seed --class=\\Jameron\\Regulator\\database\\seeds\\RegulatorSeeder```

Added to application seeder

      $this->call(\Jameron\Regulator\database\seeds\RegulatorSeeder::class);

**This tries to use native laravel authentication scaffolding as much as possible, however we need to tap into the authenticated method. The least obtrusive way to do this is:

php artisan make:auth

**DELETE the Auth::routes() from  routes/web.pp

Add to your App\User.php

```php

use Jameron\Regulator\Models\Traits\HasRoles;
class User extends Authenticatable
{
	use HasRoles;
```


Next run 

php artisan vendor:publish

Choose the number that coorelates to this package.

If you are using cached configuration files then update cache with

php artisan config:cache

Update your webpack.mix.js file

   .js('resources/assets/regulator/js/RegulatorDependencies.js', 'public/js/Regulator.js')
   .sass('resources/assets/regulator/sass/regulator.scss', 'public/css')


Notes:

***You are gonna wanna migrate the base laravel tables before adding this package to your providers list in app.php

*** You are gonna wanna delete all your routes in the app web.php file.

Change your resources/views/auth/login layout to this:

     @extends('regulator::layouts.student')
