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

            $table->foreign("santriId")->references("santriId")->on("santris")->onDelete("cascade");
            $table->foreign("matpelId")->references("matpelId")->on("matpels")->onDelete("cascade");
            $table->foreign("statusId")->references("statusId")->on("statuses")->onDelete("cascade");
            $table->foreign("typeId")->references("typeId")->on("types")->onDelete("cascade");
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
