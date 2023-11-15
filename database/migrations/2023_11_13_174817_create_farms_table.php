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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->name();
            $table->timestamps();
        });

        Schema::create('user_farm', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model:Farm::class)->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(model:User::class)->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
        Schema::dropIfExists('user_farm');
    }
};
