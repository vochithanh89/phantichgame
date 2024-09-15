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
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('meta_name');
            $table->string('slug');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('blog_categories');
            $table->string('thumbnail');
            $table->string('description');
            $table->string('meta_desc');
            $table->longText('content');
            $table->integer('like_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->boolean('is_published')->default(true);
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_priority')->default(false);

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
        Schema::dropIfExists('blog_posts');
    }
};
