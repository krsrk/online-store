<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name', 100)->nullable();
            $table->uuid('product_guid')->nullable();
            $table->string('id_user_maker', 100)->nullable();
            $table->string('id_user_publisher', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video', 100)->nullable();
            $table->integer('stock')->unsigned()->nullable();
            $table->double('price', 6, 2)->nullable();
            $table->enum('is_special', ['0', '1'])->default('0');
            $table->enum('status', ['active', 'deleted','published'])->default('active');
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
        Schema::dropIfExists('product');
    }
}
