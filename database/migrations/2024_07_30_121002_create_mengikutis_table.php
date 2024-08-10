<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mengikutis', function (Blueprint $table) {
            $table->id("mengikutiId");
            $table->unsignedBigInteger("santriId");
            $table->unsignedBigInteger("matpelId");
            $table->timestamps();

            $table->foreign("santriId")->references("santriId")->on("santris");
            $table->foreign("matpelId")->references("matpelId")->on("matpels");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mengikutis');
    }
};
