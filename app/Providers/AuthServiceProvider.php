<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        \App\Post::class => \App\Policies\PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-post', function ($user, $post) {
            return $user->role === 'ADMIN' or $user->role === 'WRITER' or $user->role === 'EDITOR';
        });

        Gate::define('update-post', function ($user, $post) {
            return $user->role === 'ADMIN' or $user->role === 'EDITOR' or $user->id === $post->user->id;
        });
    }
}
