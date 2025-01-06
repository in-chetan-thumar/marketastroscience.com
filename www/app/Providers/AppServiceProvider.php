<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $this->app->register(\KitLoong\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        Schema::defaultStringLength(191);
        Paginator::defaultView('vendor.pagination.bootstrap-4');

        DB::listen(function ($query) {
            // Check if the query is INSERT, UPDATE, or DELETE
            if (preg_match('/^(insert|update|delete)/i', $query->sql)) {
                // Log the query into the custom daily log file
                $user = auth()->user();
                $sql_query = vsprintf(str_replace("?", " '%s' ", $query->sql), $query->bindings);
                $logMessage = "SQL: " . $sql_query . PHP_EOL .
                    "Execution Time: " . $query->time . " ms" . PHP_EOL .
                    "User: " . ($user ? $user->name : '') . PHP_EOL .
                    str_repeat('-', 20);  // separator line

                Log::channel('querylog')->debug($logMessage);
            }
        });
    }
}
