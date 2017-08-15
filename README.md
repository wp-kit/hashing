# WPKit Hashing

This is a Wordpress PHP Component that handles password hashing. 

This PHP Component was built to run within an Illuminate Container so is perfect for frameworks such as Themosis.

WPKit Hashing was built to support WPKit Basic Auth when authenticating users and comparing the input password against the stored password in the Wordpress Users table.

We decided to extrapolate WPKit Hashing for a few reasons. Firstly, when working with frameworks such as Themosis, developers can take advantage of Eloquent from Illuminate\Database. 

There are many good reasons to use Eloquent but often password hashing on users can get in the way of using Eloquent to create users.

In Themosis, Themosis\User\UserFactory falls back on traditional Wordpress functions to create the user, but just in case you need to stick to a traditional Eloquent Model, this repo is for you!

## Installation

If you're using Themosis, install via composer in the Themosis route folder, otherwise install in your theme folder:

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

If you are just using this component standalone then add the following the functions.php

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

If you are using WPKit Basic Auth, hashing will work out of the box as Illuminate\Auth listens to the hash binding on the container which is register by HashingServiceProvider. However you can use the Hasher elsewhere in your application if you wish:

```php
use WPKit\Hashing\Facades\Hasher;

$hashed = Hasher::make('some_password');

$validated = Hasher::check('some_password', $hashed);
```

## Requirements

Wordpress 4+

PHP 5.6+

## License

WPKit Hashing is open-sourced software licensed under the MIT License.
