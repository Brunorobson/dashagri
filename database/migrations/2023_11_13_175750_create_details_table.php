<?php

use App\Models\Detail;
use App\Models\Farm;
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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('farm_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model:Farm::class)->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(model:Detail::class)->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
        Schema::dropIfExists('farm_details');
    }
};
