<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('section_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->rememberToken();
            $table->timestamps();
        });

        // Initial config
        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
                'section_id' => 1,
                'role_id' => 1,
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
        Schema::dropIfExists('users');
    }
}
