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
        Schema::create('webpages_youtube', function (Blueprint $table) {
            $table->foreignId('webpages_id')->references('id')->on('webpage')->cascadeOnDelete();
            $table->foreignId('youtube_id')->references('id')->on('youtube')->cascadeOnDelete();
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
        Schema::dropIfExists('webpages_youtube');
    }
};
