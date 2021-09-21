<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\IntegerConverterInterface;
use App\Services\RomanNumeralConverter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IntegerConverterInterface::class, function () {
            return new RomanNumeralConverter();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
