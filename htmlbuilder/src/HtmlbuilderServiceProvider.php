<?php
/**
 * Created by PhpStorm.
 * User: martijn
 * Date: 12-Jun-17
 * Time: 20:28
 */

namespace jager\HTMLBuilder;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class HtmlbuilderServiceProvider extends ServiceProvider
{
    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('jager\HTMLBuilder');
    }
}