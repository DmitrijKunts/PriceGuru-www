<?php

namespace App\Providers;

use App\Models\ReleaseComment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('release-master', function (User $user) {
            return $user->id == 1;
        });

        Gate::define('users-admin', function (User $user) {
            return $user->id == 1;
        });

        Gate::define('comments-edit', function (User $user, ReleaseComment $rc) {
            return $user->id == $rc->user->id || $user->id == 1;
        });
    }
}
