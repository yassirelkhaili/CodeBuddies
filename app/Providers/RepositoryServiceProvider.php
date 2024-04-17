<?php

namespace App\Providers;

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Repositories\ForumRepository;
use App\Repositories\ThreadRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ResponseRepository;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ForumRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use App\Interfaces\ResponseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ForumRepositoryInterface::class, ForumRepository::class);
        $this->app->bind(ThreadRepositoryInterface::class, ThreadRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(ResponseRepositoryInterface::class, ResponseRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
