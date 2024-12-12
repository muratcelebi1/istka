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
        //php artisan migrate
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 250)->unique();
            $table->string('name', 200);
            $table->enum('is_active', ['active', 'passive'])->default('active');
            $table->softDeletes(); //deleted_at
            $table->timestamps(); // created_at, updated_at
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 250)->unique();
            $table->foreignId('category_id')->constrained('categories');
            $table->enum('is_active', ['active', 'passive'])->default('active');
            $table->softDeletes(); //deleted_at
            $table->timestamps(); // created_at, updated_at
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 250)->unique();
            $table->foreignId('book_id')->constrained('books');
            $table->text('comment');
            $table->softDeletes(); //deleted_at
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('books');
        Schema::dropIfExists('comments');
    }
};
