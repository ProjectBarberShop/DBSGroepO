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
        Schema::create('contact-requests', function (Blueprint $table) {
            $table->id();
            $table->string('title')->require;
            $table->string('firstname')->require;
            $table->string('preposition')->nullable();
            $table->string('lastname')->require;
            $table->string('email');
            $table->string('phonenumber');
            $table->mediumtext('message')->require;
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
        Schema::dropIfExists('contact-requests');
    }
};
