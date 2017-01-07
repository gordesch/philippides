<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->integer('broadcast_list_id')->unsigned();
            $table->index('person_id');
            $table->index('broadcast_list_id');
            $table->timestamps();
            //$table->foreign('person_id')->references('id')->on('people');
            //$table->foreign('broadcast_list_id')->references('id')->on('broadcast_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_subscribers');
    }
}
