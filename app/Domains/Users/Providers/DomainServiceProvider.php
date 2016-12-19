<?php

namespace Chatmimik\Domains\Users\Providers;

use Chatmimik\Domains\Users\Database\Migrations\CreatePasswordResetsTable;
use Chatmimik\Domains\Users\Database\Migrations\CreateUsersTable;
use Chatmimik\Domains\Users\Repositories;
use Chatmimik\Domains\Users\User;
use Illuminate\Support\ServiceProvider;
use Migrator\MigratorTrait as HasMigrations;

class DomainServiceProvider extends ServiceProvider
{
    use HasMigrations;

    public function register()
    {
        $this->registerMigrations();
        $this->registerRepositories();
    }

    protected function registerMigrations()
    {
        $this->migrations([
            CreateUsersTable::class,
            CreatePasswordResetsTable::class
        ]);
    }

    protected function registerRepositories()
    {
        $this->app->bind(Repositories\UserRepositoryInterface::class, function () {
            return new Repositories\UserRepository(new User);
        });
    }
}