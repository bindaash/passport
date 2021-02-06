<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        //Passport::tokensExpireIn(Carbon::now()->addDays(1));
        //Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));

        //Passport::loadKeysFrom('/secret-keys/oauth');

        //Passport::tokensExpireIn(now()->addDays(15));

        //Passport::refreshTokensExpireIn(now()->addDays(30));

        //Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
