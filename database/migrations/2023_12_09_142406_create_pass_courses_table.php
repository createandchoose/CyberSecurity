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
        Schema::create('pass_courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignUuid("user_id")->constrained("users")->cascadeOnDelete();
            $table->foreignUuid("course_id")->constrained("courses")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pass_courses');
    }
};
