<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id("absensiId");
            $table->unsignedBigInteger("santriId");
            $table->unsignedBigInteger("matpelId")->nullable();
            $table->unsignedBigInteger("statusId");
            $table->unsignedBigInteger("typeId");
            $table->date("date");
            $table->text("description")->nullable();
            $table->timestamps();

            $table->foreign("santriId")->references("santriId")->on("santris");
            $table->foreign("matpelId")->references("matpelId")->on("matpels");
            $table->foreign("statusId")->references("statusId")->on("statuses");
            $table->foreign("typeId")->references("typeId")->on("types");
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
