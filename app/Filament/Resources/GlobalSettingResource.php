<?php
namespace App\Filament\Resources;

use App\Filament\Resources\GlobalSettingResource\Pages;
use App\Models\GlobalSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GlobalSettingResource extends Resource
{
    protected static ?string $model = GlobalSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';


    protected static ?string $navigationLabel = 'Global Settings';

    protected static ?string $modelLabel = 'Global Settings';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Global Settings')
                    ->tabs([
                        // Header Settings Tab
                        Forms\Components\Tabs\Tab::make('Header')
                            ->schema([
                                Forms\Components\FileUpload::make('main_logo')
                                    ->image()
                                    ->directory('global-settings/header')
                                    ->label('Main Logo'),
                                Forms\Components\FileUpload::make('alternative_logo')
                                    ->image()
                                    ->directory('global-settings/header')
                                    ->label('Alternative Logo'),
                                Forms\Components\TextInput::make('header_phone')
                                    ->label('Phone Number'),
                                Forms\Components\TextInput::make('header_email')
                                    ->label('Email Address')
                                    ->email(),
                                // Forms\Components\Repeater::make('navigation_menu')
                                //     ->label('Navigation Menu Items')
                                //     ->schema([
                                //         Forms\Components\TextInput::make('label')
                                //             ->required(),
                                //         Forms\Components\TextInput::make('url')
                                //             ->required()
                                //             ->url(),
                                //         Forms\Components\Toggle::make('new_tab')
                                //             ->label('Open in new tab'),
                                //     ])
                                //     ->columnSpanFull()
                                //     ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                            ]),
                        
                        // Footer Settings Tab
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->schema([
                                Forms\Components\FileUpload::make('footer_logo')
                                    ->image()
                                    ->directory('global-settings/footer')
                                    ->label('Footer Logo'),
                                Forms\Components\RichEditor::make('copyright_text')
                                    ->label('Copyright Text')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('footer_address')
                                    ->label('Address')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('about_text')
                                    ->label('About Text')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('promotion_text')
                                    ->label('Promotion Text')
                                    ->columnSpanFull(),    
                                // Forms\Components\Repeater::make('quick_links')
                                //     ->label('Quick Links')
                                //     ->schema([
                                //         Forms\Components\TextInput::make('label')
                                //             ->required(),
                                //         Forms\Components\TextInput::make('url')
                                //             ->required()
                                //             ->url(),
                                //     ])
                                //     ->columnSpanFull()
                                //     ->itemLabel(fn (array $state): ?string => $state['label'] ?? null),
                            ]),
                        
                        // Social Media Tab
                        Forms\Components\Tabs\Tab::make('Social Media')
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url(),
                                Forms\Components\TextInput::make('twitter_url')
                                    ->label('Twitter URL')
                                    ->url(),
                                Forms\Components\TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url(),
                                Forms\Components\TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url(),
                                Forms\Components\TextInput::make('youtube_url')
                                    ->label('YouTube URL')
                                    ->url(),
                                Forms\Components\TextInput::make('bsky_url')
                                    ->label('BSKY URL')
                                    ->url(),
                            ]),
                        
                        // Contact Information Tab
                        Forms\Components\Tabs\Tab::make('Contact Information')
                            ->schema([
                                Forms\Components\RichEditor::make('contact_address')
                                    ->label('Address')
                                    ->columnSpanFull(),
                                Forms\Components\Repeater::make('contact_phones')
                                    ->label('Phone Numbers')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->required(),
                                        Forms\Components\TextInput::make('number')
                                            ->required(),
                                    ])
                                    ->columnSpanFull(),
                                Forms\Components\Repeater::make('contact_emails')
                                    ->label('Email Addresses')
                                    ->schema([
                                        Forms\Components\TextInput::make('label')
                                            ->required(),
                                        Forms\Components\TextInput::make('address')
                                            ->required()
                                            ->email(),
                                    ])
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('map_embed_code')
                                    ->label('Map Embed Code')
                                    ->columnSpanFull()
                                    ->helperText('Paste your Google Maps iframe code here'),
                            ]),
                        
                        // SEO Settings Tab
                        Forms\Components\Tabs\Tab::make('SEO Settings')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60)
                                    ->helperText('Recommended length: 50-60 characters'),
                                Forms\Components\Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->helperText('Recommended length: 150-160 characters')
                                    ->columnSpanFull(),
                                Forms\Components\FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->directory('global-settings/seo')
                                    ->helperText('Upload a 32x32 or 16x16 pixel image'),
                                Forms\Components\Textarea::make('google_analytics_code')
                                    ->label('Google Analytics Code')
                                    ->columnSpanFull()
                                    ->helperText('Paste your GA4 measurement ID or tracking code'),
                                Forms\Components\Textarea::make('google_tag_manager')
                                    ->label('Google Analytics Code in body')
                                    ->columnSpanFull()
                                    ->helperText('Paste your GA4 measurement ID or tracking code in body'),
                            ]),
                        
                        // Theme Settings Tab
                        Forms\Components\Tabs\Tab::make('Theme Settings')
                            ->schema([
                                Forms\Components\ColorPicker::make('primary_color')
                                    ->label('Primary Color')
                                    ->default('#3b82f6'),
                                Forms\Components\ColorPicker::make('secondary_color')
                                    ->label('Secondary Color')
                                    ->default('#6b7280'),
                                Forms\Components\Select::make('font_family')
                                    ->label('Font Family')
                                    ->options([
                                        'sans-serif' => 'Sans Serif',
                                        'serif' => 'Serif',
                                        'monospace' => 'Monospace',
                                        'custom-font' => 'Custom Font',
                                    ])
                                    ->default('sans-serif'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([])
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditGlobalSetting::route('/'),
            // 'create' => Pages\CreateGlobalSetting::route('/create'),
            // 'edit' => Pages\EditGlobalSetting::route('/{record}/edit'),
        ];
    }

}