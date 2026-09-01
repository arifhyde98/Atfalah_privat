<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->foreignId('curriculum_item_id')->nullable()->constrained('curriculum_items')->nullOnDelete();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->enum('type', ['file', 'link', 'video'])->default('file');
            $table->string('file_path', 500)->nullable();
            $table->string('external_url', 500)->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('published')->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};