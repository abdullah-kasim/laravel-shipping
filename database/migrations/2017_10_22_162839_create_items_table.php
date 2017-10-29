<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->unsignedInteger('merchant_id');
            $table->unsignedInteger('address_id');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('CASCADE');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('CASCADE');
            $table->integer('stock')->default(0);
            $table->longText('meta')->nullable()->default(null);
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
