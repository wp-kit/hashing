# wp-kit/hashing

This is a Wordpress PHP Component that handles password hashing. 

This PHP Component was built to run within an [```Illuminate\Container\Container```](https://github.com/illuminate/container/blob/master/Container.php) so is perfect for frameworks such as [```Themosis```](http://framework.themosis.com/).

```wp-kit/hashing``` was built to support [```wp-kit/auth```](https://github.com/wp-kit/auth) when authenticating users and comparing the input password against the stored password in Wordpress.

We decided to extrapolate ```wp-kit/hashing``` for a few reasons. Such as when working with frameworks such as ```Themosis```, developers can take advantage of [```Eloquent```](https://laravel.com/docs/5.4/eloquent) from [```illuminate/database```](https://github.com/illuminate/database) and use how they wish. 

There are many good reasons to use ```Eloquent``` but often password hashing on users can get in the way of using ```Eloquent``` to manage users.

In ```Themosis```, [```Themosis\User\UserFactory```](https://github.com/themosis/framework/blob/master/src/Themosis/User/UserFactory.php) falls back on traditional Wordpress functions to create the user, but just in case you need to stick to a traditional ```Eloquent``` Model, this repo is for you!

## Installation

If you're using ```Themosis```, install via [```Composer```](https://getcomposer.org/) in the root of your ```Themosis``` installation, otherwise install in your ```Composer``` driven theme folder:

```php
composer require "wp-kit/hashing"
```

## Setup

### Add Service Provider

**Within Themosis Theme**

Just register the service provider in the providers config:

```php
//inside themosis-theme/resources/config/providers.config.php

return [
    //
    WPKit\Hashing\HashingServiceProvider::class
];
```

**Within functions.php**

If you are just using this component standalone then add the following the ```functions.php```

```php
// within functions.php

// make sure composer has been installed
if( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	
	wp_die('Composer has not been installed, try running composer', 'Dependancy Error');
	
}

// Use composer to load the autoloader.
require __DIR__ . '/vendor/autoload.php';

$container = new Illuminate\Container\Container(); // create new app container

$provider = new WPKit\Hashing\HashingServiceProvider($container); // inject into service provider

$provider->register(); //register service provider
```

### Add Facade

```php
//inside themosis-theme/resource/config/theme.config.php

'aliases' => [
    //
    'Hasher' => WPKit\Hashing\Facades\Hasher::class
    //
]
```

## Usage

If you are using ```wp-kit/auth```, hashing will work out of the box as ```illuminate/auth``` listens to the hash binding on the container which is register by [```HashingServiceProvider```](https://github.com/wp-kit/hashing/blob/master/src/Hashing/HashingServiceProvider.php). However you can use the [```Hasher```](https://github.com/wp-kit/hashing/blob/master/src/Hashing/Hasher.php) elsewhere in your application if you wish:

```php
use WPKit\Hashing\Facades\Hasher;

$hashed = Hasher::make('some_password');

$validated = Hasher::check('some_password', $hashed);
```

## Requirements

Wordpress 4+

PHP 5.6+

## License

wp-kit/hashing is open-sourced software licensed under the MIT License.
