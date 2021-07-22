<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Article extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->string('title');
            $table->string('image');
            $table->longText('article');
             $table->integer('hit')->default(0);
             $table->integer('durum')->default(0)->comment('0:passiv 1:aktiv');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();//bu silinen melumati ozunde saxliyir,berpa etmek olur,modula da elave edirik


            $table->foreign('cat_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');//ilgili categorini silende burda da silinir 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Articles');
    }
}
