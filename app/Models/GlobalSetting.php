<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $table = 'global_settings';
    protected $guarded = [];
    protected $casts = [
        'navigation_menu' => 'array',
        'quick_links' => 'array',
        'contact_phones' => 'array',
        'contact_emails' => 'array',
    ];

    public static function defaultSettings(): array
    {
        return [
            'header_phone' => '+1234567890',
            'header_email' => 'info@example.com',
            'navigation_menu' => json_encode([
                ['label' => 'Home', 'url' => '/', 'new_tab' => false],
                ['label' => 'About', 'url' => '/about', 'new_tab' => false],
            ]),
            'copyright_text' => '© '.date('Y').' Your Company. All rights reserved.',
            'primary_color' => '#3b82f6',
            'secondary_color' => '#6b7280',
            'font_family' => 'sans-serif',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            // Ensure only one record exists
            if (GlobalSetting::exists()) {
                return false;
            }
        });
    }
}