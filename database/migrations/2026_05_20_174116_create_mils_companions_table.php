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
        Schema::create('mils_companions', function (Blueprint $table) {

    $table->id();

    $table->string('title');

    $table->string('slug')->unique();

    $table->text('short_description')->nullable();

    $table->longText('content')->nullable();

    $table->string('hero_image')->nullable();

    $table->json('gallery')->nullable();

    $table->json('features')->nullable();

    $table->string('android_url')->nullable();

    $table->string('ios_url')->nullable();

    $table->string('website_url')->nullable();

    $table->json('keywords')->nullable();

    $table->boolean('is_featured')->default(false);

    $table->boolean('is_published')->default(true);

    $table->timestamp('published_at')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mils_companions');
    }
};
