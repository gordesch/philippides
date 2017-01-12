<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtualNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // ex: Sections 2-way-sms, Global Marketing...
            $table->string('number');
            $table->string('type'); // long, short
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
        Schema::dropIfExists('virtual_numbers');
    }
}
