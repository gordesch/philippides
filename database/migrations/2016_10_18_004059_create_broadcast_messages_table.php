<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBroadcastMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broadcast_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('body');
            $table->integer('broadcast_list_id')->unsigned()->nullable();
            $table->string('sent')->default(false);
            $table->string('type'); // outgoing, incoming
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
        Schema::dropIfExists('broadcast_messages');
    }
}
