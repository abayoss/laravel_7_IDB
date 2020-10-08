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
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::resource("post","App\Policies\PostPolicy");

        // Gate::define("post.update", "App\Policies\PostPolicy@update");
        // Gate::define("post.delete", "App\Policies\PostPolicy@delete");

        // Gate::define("post.update" , function($user, $post) {
        //     return $user->id === $post->user_id;
        // });
        // Gate::define("post.delete" , function($user, $post) {
        //     return $user->id === $post->user_id;
        // });
        // Gate::before(function($user, $ability){
        //     return ($user->is_admin && in_array($ability, ['post.update']));
        // });
    }
}
