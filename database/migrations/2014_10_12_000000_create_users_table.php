<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id("userId");
            $table->unsignedBigInteger('roleId');
            $table->string('username')->unique();
            $table->string('password');
            $table->text('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('roleId')->references('roleId')->on('roles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};