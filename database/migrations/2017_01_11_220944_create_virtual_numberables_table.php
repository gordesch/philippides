<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualNumberablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_numberables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('virtual_number_id')->index();
            $table->integer('virtual_numberable_id')->index();
            $table->integer('virtual_numberable_type'); // section, user
            $table->string('type');
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
        Schema::dropIfExists('virtual_numberables');
    }
}
