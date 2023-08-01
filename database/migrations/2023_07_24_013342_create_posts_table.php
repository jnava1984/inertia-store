<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', '255');
            $table->string('slug', '255');
            $table->string('image', '260')->nullable();
            $table->string('date')->default(Carbon::now());
            $table->text('descripcion', '255')->nullable();

            $table->enum('posted', ['yes', 'not'])->nullable('not');
            $table->enum('type', ['adverd', 'post', 'course', 'movie'])->nullable('post');

            $table->foreignId('Category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
