<?php

namespace Chatmimik\Domains\Messages\Providers;

use Chatmimik\Domains\Messages\Database\Migrations\CreateMessagesTable;
use Illuminate\Support\ServiceProvider;
use Migrator\MigratorTrait as HasMigrations;

class DomainServiceProvider extends ServiceProvider
{
    use HasMigrations;

    public function register()
    {
        $this->registerMigrations();
    }

    protected function registerMigrations()
    {
        $this->migrations([
           CreateMessagesTable::class
        ]);
    }
}