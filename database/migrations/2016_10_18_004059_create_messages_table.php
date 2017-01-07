<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('broadcast_message_id')->unsigned()->nullable();
            $table->integer('sender_id')->unsigned()->nullable();
            $table->integer('recipient_id')->unsigned()->nullable();
            $table->integer('contact_id')->unsigned()->nullable();
            $table->uuid('uuid')->nullable();
            $table->string('provider_internal_id')->nullable();
            $table->float('cost', 2, 2)->nullable();
            $table->string('status')->default('pending'); // pending, sent, error
            $table->index('broadcast_message_id');
            $table->index('contact_id');
            $table->index('provider_internal_id');
            $table->timestamps();
//            $table->foreign('broadcast_message_id')->references('id')->on('broadcast_messages');
//            $table->foreign('sender_id')->references('id')->on('people');
//            $table->foreign('recipient_id')->references('id')->on('people');
//            $table->foreign('contact_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
