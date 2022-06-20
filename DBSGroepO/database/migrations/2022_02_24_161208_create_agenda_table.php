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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('title')->require;
            $table->mediumtext('description');
            $table->dateTime('start')->require;
            $table->dateTime('end')->require;
            $table->string('location')->nullable();
            $table->text('locationURL')->nullable();
            $table->boolean('isArchived')->default(false);
            $table->string('is_published')->default(false);
            $table->integer('amount_of_tickets')->default(0);
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
        Schema::dropIfExists('agenda');
    }
};
