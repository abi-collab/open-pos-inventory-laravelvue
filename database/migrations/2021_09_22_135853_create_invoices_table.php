<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            // $table->bigIncrements('Id');
            $table->string('ID');
            $table->primary('ID');
            $table->timestamps();
            // $table->uuid('customer_ID');
            $table->unsignedBigInteger('customer_ID');
            
            $table->date('transaction_date');
            $table->string('time');
            $table->string('createdBy');
            $table->foreign('customer_ID')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('amount_due');
        
            // $table->string('product_id');
            // $table->string('product_name');
            // $table->string('description');
            // $table->string('category');
            // $table->integer('unit_price');
            // $table->integer('order_qty');
            // $table->integer('sub_amount');
            // $table->integer('amount_due');
            // $table->integer('status');
            // $table->integer('status_description');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
