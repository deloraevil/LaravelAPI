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
        /*
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 39);
            $table->string('surname', 39);
            $table->string('phone', 12)->unique();
            $table->string('img_path')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->softDeletes();
        });*/

        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 39);
            $table->string('description', 399);
            $table->string('img_path')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->uuidMorphs('reviewable');

            $table->string('content', 550);
            $table->unsignedInteger('rating');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('reviews');
    }
};
