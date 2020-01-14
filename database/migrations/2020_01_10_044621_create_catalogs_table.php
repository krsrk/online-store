<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->string('product_name', 255)->nullable(false);
            $table->uuid('product_guid')->nullable();
            $table->integer('owner_id')->nullable();
            $table->integer('votes')->nullable();
            $table->text('product_description',600)->nullable();
            $table->double('product_price', 6, 2)->nullable();
            $table->string('product_image', 600)->nullable();
            $table->string('product_video', 600)->nullable();
            $table->enum('is_special', ['yes', 'no'])->default('no');
            $table->integer('product_stock')->unsigned()->nullable()->default(0);
            $table->enum('product_status', ['active', 'deleted','published'])->default('active');
            $table->bigIncrements('product_id');
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
        Schema::dropIfExists('catalogs');
    }
}
