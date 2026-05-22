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
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('slug')->unique();

            $table->string('subtitle')->nullable();

            $table->text('short_description')->nullable();

            $table->string('speaker_name')->nullable();

            $table->date('event_date')->nullable();

            $table->string('event_time')->nullable();

            $table->string('event_timezone')->nullable();

            $table->string('button_text')
                ->default('Register Now');

            $table->string('button_url')->nullable();

            $table->string('featured_image')->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};
