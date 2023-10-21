<?php

namespace App\Providers;

use App\Policies\admin;
use App\Policies\contributor;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\User' => admin::class,
        'App\User' => contributor::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('vendor-create', 'App\Policies\admin@isAdmin');
        Gate::define('vendor-edit', 'App\Policies\admin@isAdmin');
    }
}
