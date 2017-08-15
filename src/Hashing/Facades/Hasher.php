<?php

	namespace WPKit\Hashing\Facades;
	
	use Illuminate\Support\Facades\Facade;
	
	class Hasher extends BaseFacade {
		
	    /**
	     * Get the registered name of the component.
	     *
	     * @return string
	     */
	    protected static function getFacadeAccessor()
	    {
	        return 'hash';
	    }
	    
	}
