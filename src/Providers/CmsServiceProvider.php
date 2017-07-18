<?php

namespace Sahakavatar\cms\Providers;

//use TorMorten\Eventy;

use Illuminate\Support\ServiceProvider;


class CmsServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->register(' "Sahakavatar\User\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Console\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Framework\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Manage\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Mesources\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Settings\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Uploads\Providers\ModuleServiceProvider');
        $this->app->register(' "Sahakavatar\Modules\Providers\ModuleServiceProvider');
        $this->app->register(' "Avatar\Avatar\Providers\AvatarServiceProvider');
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
