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
        Schema::create('learn_to_sings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('learntosing_categorie');
            $table->string('title');
            $table->tinyText('description')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('location')->nullable()->default('Geen locatie');
            $table->string('mentor')->nullable()->default('Geen begeleider');
            $table->double('price')->default(0.00);
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
        Schema::dropIfExists('learn_to_sings');
    }
};
