<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.`
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('type')->default(1);
            $table->string('content');
            $table->integer('is_full_width')->default(0);
            $table->string('note')->nullable();
            $table->string('source')->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_url2')->nullable();
            $table->string('source_url3')->nullable();
            $table->string('audio_url')->nullable();
            $table->boolean('is_poll')->default(0);
            $table->integer('total_views')->default(0);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->enum('lang', ['en','ne'])->default('en');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('posts');
    }
}
