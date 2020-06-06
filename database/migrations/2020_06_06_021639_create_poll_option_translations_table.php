<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolloptionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polloption_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('polloption_id');
            $table->string('value')->nullable();

            $table->foreign('polloption_id')->references('id')->on('poll_options')->onDelete('cascade');
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
        Schema::dropIfExists('polloption_translations');
    }
}
