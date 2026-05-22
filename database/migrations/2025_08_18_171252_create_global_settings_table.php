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
        Schema::create('global_settings', function (Blueprint $table) {
            $table->id();
            
            // Header Settings
            $table->string('main_logo')->nullable();
            $table->string('alternative_logo')->nullable();
            $table->string('header_phone')->nullable();
            $table->string('header_email')->nullable();
            $table->json('navigation_menu')->nullable();
            
            // Footer Settings
            $table->string('footer_logo')->nullable();
            $table->text('copyright_text')->nullable();
            $table->text('footer_address')->nullable();
            $table->json('quick_links')->nullable();
            
            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('pinterest_url')->nullable();
            
            // Contact Information
            $table->text('contact_address')->nullable();
            $table->json('contact_phones')->nullable();
            $table->json('contact_emails')->nullable();
            $table->text('map_embed_code')->nullable();
            
            // SEO Settings
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('favicon')->nullable();
            $table->text('google_analytics_code')->nullable();
            
            // Theme Settings
            $table->string('primary_color')->default('#3b82f6');
            $table->string('secondary_color')->default('#6b7280');
            $table->string('font_family')->default('sans-serif');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_settings');
    }
};
