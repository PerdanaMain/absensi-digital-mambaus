<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id("guruId");
            $table->unsignedBigInteger("userId");
            $table->string("name");
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("userId")->references("userId")->on("users")->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
