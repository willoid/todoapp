<?php

namespace App\Providers;

use Firebase\Auth\FirebaseAuth;
use Firebase\Firestore\FirestoreClient;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return (new Factory)
                ->withServiceAccount(config('firebase.credentials'));
        });

        $this->app->singleton(FirebaseAuth::class, function ($app) {
            return $app->make(Factory::class)->createAuth();
        });

        $this->app->singleton(FirestoreClient::class, function ($app) {
            return $app->make(Factory::class)->createFirestore();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
