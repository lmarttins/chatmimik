<?php

namespace Chatmimik\Domains\Users\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Chatmimik\Support\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        $this->schema->dropIfExists('users');
    }
}