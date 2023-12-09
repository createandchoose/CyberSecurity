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
        Schema::create('questions_pass_tests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->boolean("is_right");
            $table->foreignUuid("question_id")->constrained("questions")->cascadeOnDelete();
            $table->foreignUuid("pass_tests_id")->constrained("pass_tests")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_pass_tests');
    }
};
