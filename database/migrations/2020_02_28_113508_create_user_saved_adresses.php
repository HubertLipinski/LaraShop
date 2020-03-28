<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSavedAdresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_saved_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                ->unsigned();
            $table->string('display_name');
            $table->string('name');
            $table->string('surname');
            $table->string('address');
            $table->char('zip_code', 6)
                ->default('00-000');
            $table->string('city');
            $table->string('country');
            $table->char('number', 11)
                ->default('48123456789');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_saved_addresses');
    }
}
