<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id("santriId");
            $table->unsignedBigInteger("pengurusId");
            $table->unsignedBigInteger("waliId");
            $table->string("name")->unique();
            $table->string("age")->nullable();
            $table->string("address")->nullable();
            $table->string("birthPlace")->nullable();
            $table->date("birthDate")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("pengurusId")->references("pengurusId")->on("penguruses")->onDelete("cascade");
            $table->foreign("waliId")->references("waliId")->on("walis")->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
