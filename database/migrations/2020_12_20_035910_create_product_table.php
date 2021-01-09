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
            $table->integer('folder_id');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->string('summary')->nullable();
            $table->longText('introduce')->nullable();
            $table->string('code')->nullable();
            $table->string('text_domain');
            $table->integer('image_id')->nullable();
            $table->string('youtube')->nullable();
            $table->string('note')->nullable();
            $table->string('qty')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('product');
    }
}
