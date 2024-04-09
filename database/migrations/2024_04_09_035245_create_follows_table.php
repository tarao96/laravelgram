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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('following_user_id')->comment('フォローしているユーザID');
            $table->unsignedBigInteger('followed_user_id')->comment('フォローされているユーザID');
            $table->timestamps();

            $table->foreign('following_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followed_user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['following_user_id', 'followed_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
