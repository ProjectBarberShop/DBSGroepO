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
        Schema::create('image_webpages', function (Blueprint $table) {
            $table->primary(['image_id', 'webpages_id']);
            $table->foreignId('image_id')->references('id')->on('image')->cascadeOnDelete();
            $table->foreignId('webpages_id')->references('id')->on('webpage')->cascadeOnDelete();
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
        Schema::dropIfExists('_image__webpages');
    }
};
