<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //Form components
        Blade::component('text', '\App\View\Components\Form\Text');
        Blade::component('email', '\App\View\Components\Form\Email');
        Blade::component('number', '\App\View\Components\Form\Number');
        Blade::component('amount', '\App\View\Components\Form\Amount');
        Blade::component('mobile', '\App\View\Components\Form\Mobile');
        Blade::component('datepicker', '\App\View\Components\Form\Datepicker');
        Blade::component('select', '\App\View\Components\Form\Select');
        Blade::component('dynamic-select', '\App\View\Components\Form\DynamicSelect');
        Blade::component('checkbox', '\App\View\Components\Form\Checkbox');
        Blade::component('input-tags', '\App\View\Components\Form\InputTag');
        Blade::component('autocomplete', '\App\View\Components\Form\Autocomplete');
        Blade::component('file', '\App\View\Components\Form\File');
        Blade::component('radio', '\App\View\Components\Form\Radio');

        //Show components
        Blade::component('info', '\App\View\Components\Show\Info');
        Blade::component('timestamps', '\App\View\Components\Show\Timestamps');
        Blade::component('collection', '\App\View\Components\Show\Collection');
    }
}
