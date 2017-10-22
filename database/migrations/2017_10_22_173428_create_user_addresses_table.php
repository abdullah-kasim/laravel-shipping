<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->default(null)
                ->references('id')->on('users');
            $table->string("address_1")->nullable()->default(null);
            $table->string("address_2")->nullable()->default(null);
            $table->string("address_3")->nullable()->default(null);
            $table->unsignedInteger('address_id');
            $table->foreign("address_id")->references('id')->on('addresses')->onDelete('CASCADE');
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
        Schema::dropIfExists('user_addresses');
    }
}
