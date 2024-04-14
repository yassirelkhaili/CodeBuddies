<?php

namespace App\Providers;

use App\Interfaces\ForumRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ForumRepository;
use App\Repositories\ThreadRepository;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
