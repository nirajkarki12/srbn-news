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
            $table->unsignedBigInteger('horoscope_id');
            $table->text('nepali');
            $table->text('english');
            $table->enum('type',['daily','weekly','monthly','yearly'])->default('daily');
            $table->float('rating')->default(1);
            $table->timestamp('prediction_date')->nullable();

            $table->foreign('horoscope_id')->references('id')->on('horoscopes');
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
