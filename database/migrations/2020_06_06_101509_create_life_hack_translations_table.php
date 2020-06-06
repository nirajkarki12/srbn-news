<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeHackTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('life_hack_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('life_hack_id');
            $table->text('content')->nullable();
            
            $table->foreign('life_hack_id')->references('id')->on('life_hacks')->onDelete('cascade');
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
        Schema::dropIfExists('life_hack_translations');
    }
}
