<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigInteger('u_id')->autoIncrement();
            $table->string('u_firstname');
            $table->string('u_lastname');
            $table->string('u_mobileNum');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('u_status');
            $table->integer('u_role');
            $table->string('u_profileImg');
            $table->string('u_thumbnail');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
