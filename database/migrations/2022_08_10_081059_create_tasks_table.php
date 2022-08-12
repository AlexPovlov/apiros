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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('last_value')->nullable();
            $table->string('value');
            $table->integer('repetitions');
            $table->integer('repetition_repetitions')->nullable();
            $table->integer('salt')->nullable();
            $table->integer('sleep')->nullable();
            $table->integer('status')->default('start');
            $table->foreignId('job_id')->nullable()->constrained('jobs')->nullOnDelete();
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
        Schema::dropIfExists('tasks');
    }
};
