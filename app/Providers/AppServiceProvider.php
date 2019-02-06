<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
	    Validator::extendImplicit('checkbox', function($attribute, $value, $parameters, $validator)
	    {
		    $data = $validator->getData();
		    $data[$attribute] = ($value == "1" || strtolower($value) == "true" || strtolower($value) == "on")? "1": "0";
		    $validator->setData($data);
		    return true;
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
