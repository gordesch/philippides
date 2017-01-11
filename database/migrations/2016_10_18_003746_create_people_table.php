<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('mobile_phone_status')->default('unknown');
            $table->date('mobile_phone_checked_at')->nullable();
            $table->integer('virtual_number_id')->unsigned()->nullable();
            $table->string('landline')->nullable();
            $table->string('university')->nullable();
            $table->string('year')->nullable();
            $table->integer('section_id')->unsigned();
            $table->string('major')->nullable();
            $table->string('email')->nullable();
            $table->boolean('messageable')->nullable()->default(true);
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Initial config
        DB::table('people')->insert(
            array(
                'last_name' => 'ADMIN',
                'first_name' => 'Admin',
                'section_id' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
