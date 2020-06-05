<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->text('quote')->nullable();
            $table->string('author')->nullable();

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
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
        Schema::dropIfExists('quote_translations');
    }
}
