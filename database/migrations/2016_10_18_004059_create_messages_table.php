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
            $table->integer('sending_id')->unsigned()->nullable()->index();
            $table->integer('contact_id')->unsigned()->nullable()->index();
            $table->integer('recipientable_id')->unsigned()->nullable()->index();
            $table->string('recipientable_type')->nullable();
            $table->integer('senderable_id')->unsigned()->nullable()->index();
            $table->string('senderable_type')->nullable();
            $table->string('provider_internal_id')->nullable()->index();
            $table->uuid('provider_philippides_uuid')->nullable()->index();
            $table->string('type')->nullable(); // outgoing, incoming
            $table->float('cost', 5, 3)->nullable();
            $table->string('status')->default('pending'); // pending, sent, error, received
            $table->integer('section_id')->unsigned()->nullable()->index();
            $table->boolean('global')->default(false);
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
        Schema::dropIfExists('messages');
    }
}
