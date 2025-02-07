<?php

namespace App\Providers;

use App\Interfaces\Repositories\IRolesRepository;
use App\Interfaces\Repositories\ITaskRepository;
use App\Interfaces\Repositories\IUsersRepository;
use App\Interfaces\Repositories\IUsersTokenRepository;
use App\Interfaces\Services\IRolesService;
use App\Interfaces\Services\ITaskService;
use App\Interfaces\Services\IUsersService;
use App\Interfaces\Services\IUsersTokenService;
use App\Repositories\RolesRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UsersRepository;
use App\Repositories\UsersTokenRepository;
use App\Services\RolesService;
use App\Services\TaskService;
use App\Services\UsersService;
use App\Services\UsersTokenService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUsersService::class, UsersService::class);
        $this->app->bind(IRolesService::class, RolesService::class);
        $this->app->bind(IUsersTokenService::class, UsersTokenService::class);
        $this->app->bind(ITaskService::class, TaskService::class);
        $this->app->bind(IUsersRepository::class, UsersRepository::class);
        $this->app->bind(IUsersTokenRepository::class, UsersTokenRepository::class);
        $this->app->bind(IRolesRepository::class, RolesRepository::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
