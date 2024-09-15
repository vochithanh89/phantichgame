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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('blog_categories')->onUpdate('cascade')->onDelete('restrict');
            $table->string('name');
            $table->string('meta_name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('description');
            $table->string('meta_desc');
            $table->boolean('is_published')->default(true);

            $table->foreignId('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreignId('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreignId('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
