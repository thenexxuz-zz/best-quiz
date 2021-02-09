<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('question')->nullable(false);
            $table->json('answers')->nullable(false);
            $table->boolean('multiple_correct_answers')->default(false)->nullable(false);
            $table->json('correct_answers')->nullable(false);
            $table->text('explanation')->nullable(true);
            $table->enum('category', ['php', 'linux', 'docker', 'cloud'])->nullable(false);
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('easy')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
