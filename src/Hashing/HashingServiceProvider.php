<?php

namespace WPKit\Hashing;

use Illuminate\Support\ServiceProvider;

class HashingServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	    require_once( ABSPATH . WPINC . DS . 'class-phpass.php' );
	    
        $this->app->singleton('hash', function () {
            return new Hasher(new \PasswordHash( 8, true ));
        });
        
        $this->app->singleton(
	        \Illuminate\Contracts\Hashing\Hasher::class,
	        function () {
	            return $this->app['hash'];
	        }
        );
        
    }

}
