<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('work_program');
            $table->text('vision');
            $table->text('mission');
            $table->string('image');
            $table->string('video_link')->nullable();
            $table->unsignedBigInteger('id_position');
            $table->timestamps();

            $table->foreign('id_position')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
