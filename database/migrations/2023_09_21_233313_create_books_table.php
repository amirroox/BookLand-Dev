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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('release')->nullable()->default('2023');
            $table->string('publisher')->nullable()->default('none');
            $table->string('url', 2048);
            $table->string('cover_url', 2048)->nullable();
            $table->string('photo_path', 1024)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
