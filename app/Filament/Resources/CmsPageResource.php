<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CmsPageResource\Pages;
use App\Filament\Resources\CmsPageResource\RelationManagers;
use App\Models\CmsPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Model;

class CmsPageResource extends Resource
{
    protected static ?string $model = CmsPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationGroup = 'Pages';
    protected static ?string $modelLabel = 'Page';
    protected static ?string $pluralModelLabel = 'Pages';
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true) 
                    ->afterStateUpdated(fn ($state, callable $set) => 
                        $set('slug', Str::slug($state))
                    ),
                
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                FileUpload::make('feature_image')
                    ->label('Feature Image')
                    ->image()
                    ->columnSpan(2)
                    ->directory('feature_image')
                    ->reorderable(),
                
                Repeater::make('content')
                    ->schema([
                        // Toggle::make('use_text_editor')
                        //     ->label('Use Text Area')
                        //     ->live()
                        //     ->default(false),
                        Forms\Components\TextInput::make('section_heading')
                            ->label('Section Title')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('heading')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subheading')
                            ->maxLength(255),
                        // Textarea::make('page_content')
                        //     ->columnSpanFull()
                        //     ->visible(fn (Get $get): bool => $get('use_text_editor')),
                        TiptapEditor::make('page_content')
                            ->label('Content Block')
                            ->columnSpan(2)
                            ->visible(fn (Get $get): bool => !$get('use_text_editor')),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->columnSpanFull()
                            ->directory('portfolios/section-images'),
                        Forms\Components\TextInput::make('button_1')
                            ->label('Button')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('button_1_url')
                            ->label('Button Link')
                            ->maxLength(255),

                        
                    ])

                    ->columns(2)
                    ->columnSpanFull()
                    ->addActionLabel('Add Content Block'), 
                
                Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('meta_keywords')
                    ->maxLength(255),

                Forms\Components\Textarea::make('meta_description')
                    ->maxLength(255)
                    ->columnSpanfull(),
                
                Toggle::make('is_active')
                    ->label('Active'),
                
                Toggle::make('is_home')
                    ->label('Set as Home Page')
                    ->afterStateUpdated(function ($state, Set $set, $get, ?Model $record) {
                        if ($state) {
                            // When this page is set as home, unset all others
                            CmsPage::where('id', '!=', $record?->id)
                                ->update(['is_home' => false]);
                        }
                    })
                    ->live()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\IconColumn::make('is_home')
                    ->label('Home Page')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCmsPages::route('/'),
            'create' => Pages\CreateCmsPage::route('/create'),
            'edit' => Pages\EditCmsPage::route('/{record}/edit'),
        ];
    }
}