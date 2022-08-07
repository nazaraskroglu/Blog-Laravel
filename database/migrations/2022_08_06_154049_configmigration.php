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
        Schema::create('configs', function (Blueprint $table) {
               $table->id();
               $table->string('title');
               $table->string('logo')->nullable();
               $table->string('favicon')->nullable();
               $table->integer('active')->default(1);
               $table->string('twitter')->nullable();
               $table->string('github')->nullable();
               $table->string('instagram')->nullable();
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
        Schema::dropIfExists('configs');
    }
};
