<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('scope'); // super, global, section
            $table->string('type'); // admin, manager
            $table->timestamps();
        });

        // Initial config
        DB::table('roles')->insert(
            array(
                'name' => 'Super Admin',
                'scope' => 'super',
                'type' => 'admin',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Global Admin',
                'scope' => 'global',
                'type' => 'admin',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Global Manager',
                'scope' => 'global',
                'type' => 'manager',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Global User',
                'scope' => 'global',
                'type' => 'user',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Section Admin',
                'scope' => 'section',
                'type' => 'admin',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Section Manager',
                'scope' => 'section',
                'type' => 'manager',
            )
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Section User',
                'scope' => 'section',
                'type' => 'user',
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
        Schema::dropIfExists('roles');
    }
}
