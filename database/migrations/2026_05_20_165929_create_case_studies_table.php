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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('client_name')->nullable();

            $table->string('industry')->nullable();

            $table->text('short_description')->nullable();

            $table->longText('content');

            $table->string('feature_image')->nullable();

            $table->json('gallery')->nullable();

            $table->json('keywords')->nullable();

            $table->boolean('is_published')->default(false);

            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
