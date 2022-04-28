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
        Schema::create('dropdownItems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('navbar_item_id')->constrained('navbarItems')->cascadeOnDelete();
            $table->string('name')->nullable(false);
            $table->string("link")->nullable(false)->default('#');
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
        Schema::dropIfExists('dropdownItems');
    }
};
