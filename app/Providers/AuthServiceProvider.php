<?php

namespace App\Providers;

use App\Models\exercise;
use App\Policies\ExercisePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        exercise::class => ExercisePolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('logged-in', function ($user = null) {
            return $user == null;
        });
        Gate::define('is-admin', function ($user) {
           return $user->admin == true;
        });
        //
    }
}
