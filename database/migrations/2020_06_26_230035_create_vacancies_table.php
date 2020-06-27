<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('title_nepali')->nullable();
            $table->string('level')->nullable();
            $table->string('level_nepali')->nullable();
            $table->integer('number')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('employment_type_nepali')->nullable();
            $table->string('location')->nullable();
            $table->string('location_nepali')->nullable();
            $table->string('salary')->nullable();
            $table->string('salary_nepali')->nullable();
            $table->string('image')->nullable();
            $table->enum('lang',['en','ne'])->default('en');
            $table->timestamp('apply_date')->nullable();
            $table->string('apply_link')->nullable();

            $table->unsignedBigInteger('company_id');

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('vacancies');
    }
}
