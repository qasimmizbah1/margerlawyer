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
         Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('category')->nullable();

            $table->string('amount')->nullable();

            $table->string('transaction_type')->nullable();

            $table->text('short_description')->nullable();

            $table->string('button_text')
                ->default('View Case Study');

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
        Schema::dropIfExists('transactions');
    }
};
