<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
                // Define gates for each permission
                Gate::define('manage-job-opportunities', function ($user) {
                    return $user->hasPermission('manage-job-opportunities');
                });

                Gate::define('manage-users', function ($user) {
                    return $user->hasPermission('manage-users');
                });

                Gate::define('manage-bootcamps', function ($user) {
                    return $user->hasPermission('manage-bootcamps');
                });

                Gate::define('manage-surveys', function ($user) {
                    return $user->hasPermission('manage-surveys');
                });

                Gate::define('manage-youth-surveys', function ($user) {
                    return $user->hasPermission('manage-youth-surveys');
                });

                Gate::define('manage-company-survays', function ($user) {
                    return $user->hasPermission('manage-company-survays');
                });

                Gate::define('manage-comments', function ($user) {
                    return $user->hasPermission('manage-comments');
                });

                Gate::define('manage-roles', function ($user) {
                    return $user->hasPermission('manage-roles');
                });

                Gate::define('manage-permissions', function ($user) {
                    return $user->hasPermission('manage-permissions');
                });

    }
}
