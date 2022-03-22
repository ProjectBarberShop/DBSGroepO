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
        Schema::create('colloms_webpage', function (Blueprint $table) {
            $table->foreignId('webpage_id')->references('id')->on('webpage')->cascadeOnDelete();
            $table->foreignId('collomn_context_id')->references('id')->on('collomn_context')->cascadeOnDelete();
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
        Schema::dropIfExists('colloms_webpage');
    }
};
