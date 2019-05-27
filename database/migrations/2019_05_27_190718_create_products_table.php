<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('img')->nullable();
            $table->boolean('is_img_local')->default(1);
            $table->boolean('is_public')->default(1);
            $table->unsignedInteger('category_id')->index();
//            $table->unsignedInteger('owner_id')->index();
            $table->timestamps();
//            $table->foreign('category_id')
//                ->references('id')
//                ->on('categories')
//                ->onDelete('cascade');
//            $table->foreign('owner_id')
//                ->references('id')
//                ->on('users')
//                ->onDelete('cascade');
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
