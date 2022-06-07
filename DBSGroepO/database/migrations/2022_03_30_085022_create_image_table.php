<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->id()->onDelete('cascade');
            $table->string('title')->require;
            $table->string('discription');;
            $table->string('tagName')->references('tag')->on('imageTag')->require;
            $table->boolean('useInSlider')->require;
            $table->timestamps();
        });
        DB::statement("ALTER TABLE image ADD photo LONGBLOB ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image');
    }
};
