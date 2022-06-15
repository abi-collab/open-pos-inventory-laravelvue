<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ssku');
            $table->foreign('ssku')->references('id')->on('products');
            $table->string('serialnumber');
            $table->string('orderno')->nullable();
            $table->string('orderdate')->nullable();
            $table->string('returnno')->nullable();
            $table->string('petsa');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('customerid')->nullable();
            $table->foreign('customerid')->references('id')->on('customers');
            $table->string('imageid')->nullable();
            $table->string('returnStatus')->nullable();
            $table->string('authoredBy')->nullable();
            $table->string('ser_createdBy')->nullable();
            $table->string('ser_updatedBy')->nullable();
            $table->string('ser_updatedAt')->nullable();

            // $table->foreign('imageid')->references('imgId')->on('invoiceimages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serials');
    }
}
