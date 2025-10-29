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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Translatable name
            $table->json('bio')->nullable(); // Translatable biography
            $table->string('image')->nullable(); // Profile image
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('specialty')->nullable(); // Field of expertise
            $table->json('qualifications')->nullable(); // Academic qualifications
            $table->json('experience')->nullable(); // Work experience
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('slug')->unique(); // For URL friendly links
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
