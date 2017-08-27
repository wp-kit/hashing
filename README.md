# wp-kit/hashing

This is a wp-kit component that handles password hashing. 

This component was built to run within an [```Illuminate\Container\Container```](https://github.com/illuminate/container/blob/master/Container.php) so is perfect for frameworks such as [```Themosis```](http://framework.themosis.com/), [```Assely```](https://assely.org/) and [```wp-kit/theme```](https://github.com/wp-kit/theme).

```wp-kit/hashing``` was built to support [```wp-kit/auth```](https://github.com/wp-kit/auth) when authenticating users and comparing the input password against the stored password in Wordpress.

We decided to extrapolate ```wp-kit/hashing``` for a few reasons. Such as when working with frameworks such as ```Themosis```, developers can take advantage of [```Eloquent```](https://laravel.com/docs/5.4/eloquent) from [```illuminate/database```](https://github.com/illuminate/database) and use how they wish. 

There are many good reasons to use ```Eloquent``` but often password hashing on users can get in the way of using ```Eloquent``` to manage users.

In ```Themosis```, [```Themosis\User\UserFactory```](https://github.com/themosis/framework/blob/master/src/Themosis/User/UserFactory.php) falls back on traditional WordPress functions to create the user, but just in case you need to stick to a traditional ```Eloquent``` Model, this repo is for you!

## Installation

If you're using ```Themosis```, install via [```Composer```](https://getcomposer.org/) in the root of your ```Themosis``` installation, otherwise install in your ```Composer``` driven theme folder:

```php
composer require "wp-kit/hashing"
```

## Setup

### Add Service Provider

Just register the service provider in the providers config:

```php
//inside theme/resources/config/providers.config.php

return [
    //
    WPKit\Hashing\HashingServiceProvider::class
];
```

### Add Facade

If you are using Themosis or another ```Iluminate``` driven framework, you may want to add ```Facades```, simply add them to your aliases:

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
