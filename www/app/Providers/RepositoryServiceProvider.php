<?php

namespace App\Providers;

use App\Repositories\BlogRepository;
use App\Repositories\EnquiryRepository;
use App\Repositories\OptionListRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton('role-repo', RoleRepository::class);
        $this->app->singleton('user-repo', UserRepository::class);
        $this->app->singleton('permission-repo', PermissionRepository::class);
        $this->app->bind('b-option-repo', OptionListRepository::class);
        $this->app->singleton('option-repo', OptionListRepository::class);
        $this->app->singleton('blog-repo', BlogRepository::class);
        $this->app->bind('b-blog-repo', BlogRepository::class);
        $this->app->singleton('enquiry-repo', EnquiryRepository::class);
    }
}
