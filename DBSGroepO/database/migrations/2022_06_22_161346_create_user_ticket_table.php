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
        Schema::create('user_ticket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->references('id')->on('ticket')->cascadeOnDelete();
            $table->string('name')->require;
            $table->string('address')->require;
            $table->string('postalcode')->require;
            $table->string('place')->require;
            $table->string('phonenumber')->require;
            $table->string('email')->require;
            $table->integer('amount_of_tickets')->require;
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
        Schema::dropIfExists('user_ticket');
    }
};
