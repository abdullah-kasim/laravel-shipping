<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shipper_id');
            $table->unsignedInteger('from_address_id');
            $table->unsignedInteger('to_address_id');
            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('CASCADE');
            $table->foreign('from_address_id')->references('id')->on('addresses')->onDelete('CASCADE');
            $table->foreign('to_address_id')->references('id')->on('addresses')->onDelete('CASCADE');
            $table->integer('cost');
            $table->timestamps();
            $table->unique(['shipper_id', 'from_address_id', 'to_address_id']); // To preserve database sanity
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_details');
    }
}
