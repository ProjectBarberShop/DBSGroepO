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
        Schema::create('agendapunt_category', function (Blueprint $table) {
            $table->foreignId('agendapunt_id')->references('id')->on('agenda')->cascadeOnDelete();
            $table->foreignId('category_id')->references('id')->on('category')->cascadeOnDelete();
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
        Schema::dropIfExists('agendapunt_category');
    }
};
