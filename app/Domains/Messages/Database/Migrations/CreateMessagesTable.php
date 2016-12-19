<?php

namespace Chatmimik\Domains\Messages\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Chatmimik\Support\Database\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->drop('messages');
    }
}
