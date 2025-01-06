<?php

namespace App\Providers;


use App\Helpers\BlogHelper;
use App\Helpers\CommonHelper;
use App\Helpers\EnquiryHelper;
use App\Helpers\OptionListHelper;
use App\Helpers\PermissionHelper;
use App\Helpers\S3CloudDocStorage;
use App\Helpers\UserHelper;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('common-helper', CommonHelper::class);
        $this->app->singleton('user-helper', UserHelper::class);
        $this->app->singleton('permission-helper', PermissionHelper::class);
        $this->app->singleton('option-helper', OptionListHelper::class);
        $this->app->singleton('s3-cloud-doc-storage', S3CloudDocStorage::class);
        $this->app->singleton('blog-helper', BlogHelper::class);
        $this->app->singleton('enquiry-helper', EnquiryHelper::class);
    }
}
