<?php

namespace WPKit\Hashing;

use Illuminate\Support\ServiceProvider;
use WPKit\Hashing\Facades\Hasher as Facade;

class HashingServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	
	Facade::setRootApplication($this->app);
	    
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hash'];
    }
}
