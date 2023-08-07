<?php

namespace App\Providers;

use App\Http\Controllers\PostController;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(
            \App\Repositories\PostRepositoryInterface::class,
            \App\Repositories\PostRepository::class
        );
        $this->app->bind(Post::class, function ($app) {
            // You can add any custom logic to resolve the Post model here if needed.
            return new Post();
        });
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });
        $this->app->bind(
            \App\Services\PostService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
