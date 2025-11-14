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
        Schema::create('vote_results', function (Blueprint $table) {
            $table->id();
            $table->integer('id_voter')->unique();
            $table->unsignedBigInteger('id_candidate');
            $table->timestamps();

            $table->foreign('id_candidate')->references('id')->on('candidates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_results');
    }
};
