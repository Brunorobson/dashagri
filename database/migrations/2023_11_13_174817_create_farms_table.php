<?php

use App\Models\Farm;
use App\Models\User;
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
            $table->string('name')->unique();
            $table->string('location'); 
            $table->text('description')->nullable();
            $table->integer('number_of_fields')->default(0);
            $table->boolean('is_active')->default(true);
            $table->decimal('total_acres', 8, 2)->nullable();
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
