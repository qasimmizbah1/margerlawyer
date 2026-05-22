<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandingPageResource\Pages;
use App\Filament\Resources\LandingPageResource\RelationManagers;
use App\Models\LandingPage;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandingPageResource extends Resource
{
    protected static ?string $model = LandingPage::class;
     protected static ?string $navigationGroup = 'Pages';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Domain Configuration')
                    ->schema([
                        Forms\Components\TextInput::make('domain_name')
                            ->label('Custom Domain')
                            ->hint('e.g., mylanding.example.com')
                            ->maxLength(255),
                            
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),


                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                            
                        Forms\Components\FileUpload::make('feature_image')
                            ->image()
                            ->directory('feature_image')
                            ->columnSpanFull(),

                      Repeater::make('description')
                ->schema([
            //          Toggle::make('use_text_editor')
            // ->label('Use Text Area')
            // ->live()
            // ->default(false),
            //  Textarea::make('page_content')
            // ->visible(fn (Get $get): bool => $get('use_text_editor')),

            TiptapEditor::make('page_content')
                        ->label('Content Block')
                        ->columnSpan(2)
                        ->visible(fn (Get $get): bool => !$get('use_text_editor')),
                ])
                ->minItems(1)
                ->columnSpanFull()
                ->addActionLabel('Add Content Block'), 
            Forms\Components\TextInput::make('meta_title')
                    ->maxLength(255),
                 Forms\Components\TextInput::make('meta_keywords')
                    ->maxLength(255),

                Forms\Components\Textarea::make('meta_description')
                    ->maxLength(255)
                    ->columnSpanfull(),
               


                    ]),
                    
                



                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('domain_name')
                    ->label('Domain')
                    ->searchable(),
                    
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true)),
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
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLandingPages::route('/'),
            'create' => Pages\CreateLandingPage::route('/create'),
            'edit' => Pages\EditLandingPage::route('/{record}/edit'),
        ];
    }
}