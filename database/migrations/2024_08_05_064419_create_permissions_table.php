<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id("permissionId");
            $table->unsignedBigInteger("santriId");
            $table->text("description");
            $table->date("tglKeluar")->nullable();
            $table->date("tglKembali")->nullable();
            $table->boolean("isComback")->default(false);
            $table->text("file")->nullable();
            $table->timestamps();

            $table->foreign("santriId")->references("santriId")->on("santris");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
