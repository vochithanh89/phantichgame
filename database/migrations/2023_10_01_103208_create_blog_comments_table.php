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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->foreignId('parent_id')->nullable();
            $table->foreignId('post_id');
            $table->foreign('post_id')->references('id')->on('blog_posts');
            $table->text('content');

            $table->boolean('is_verify')->default(false);

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
        Schema::dropIfExists('blog_comments');
    }
};
