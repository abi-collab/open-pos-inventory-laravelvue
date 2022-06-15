<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->string('sku');
            // $table->primary('sku');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('price');
            $table->integer('category_id');
            $table->string('photo')->nullable();
            $table->string('stocks');
            $table->integer('sold')->nullable();
            $table->integer('criticalLevel');
            $table->string('authoredBy')->nullable();
            $table->string('updatedBy')->nullable();
            $table->string('update_reason')->nullable();

            // $table->integer('serialno');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
