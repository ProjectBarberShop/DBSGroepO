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
        Schema::create('colom_context_webpages', function (Blueprint $table) {
            $table->foreignId('webpages_id')->references('id')->on('webpage')->cascadeOnDelete();
            $table->foreignId('colom_context_id')->references('id')->on('collomn_context')->cascadeOnDelete();
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
        Schema::dropIfExists('colom_context_webpages');
    }
};
