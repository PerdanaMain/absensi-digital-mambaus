<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matpels', function (Blueprint $table) {
            $table->id("matpelId");
            $table->unsignedBigInteger("kelasId");
            $table->unsignedBigInteger("typeId");
            $table->unsignedBigInteger("guruId");
            $table->string("name");
            $table->string("day")->nullable();
            $table->string("semester")->nullable();
            $table->time("time")->nullable();
            $table->string("description")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("kelasId")->references("kelasId")->on("kelas");
            $table->foreign("typeId")->references("typeId")->on("types");
            $table->foreign("guruId")->references("guruId")->on("gurus");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matpels');
    }
};
