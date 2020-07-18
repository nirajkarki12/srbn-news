<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->text('data');
            $table->enum('type',['daily','weekly','monthly','yearly'])->default('daily');
            $table->float('rating')->default(1);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('horoscope_id');
            $table->foreign('horoscope_id')->references('id')->on('horoscopes')->onUpdate('cascade');
            $table->unique(['type', 'horoscope_id', 'start_date', 'end_date']);
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
        Schema::dropIfExists('predictions');
    }
}
