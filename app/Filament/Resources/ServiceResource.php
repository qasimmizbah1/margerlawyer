<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use FilamentTiptapEditor\TiptapEditor;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 5;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true) // Update slug when title changes
                ->afterStateUpdated(function ($state, $set) {
                    $set('slug', \Str::slug($state));
                }),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->rules(['alpha_dash:ascii']),
                Forms\Components\FileUpload::make('feature_image')
                    ->image()
                    ->columnSpanFull()
                    ->directory('services/feature-images'),
                    
                Forms\Components\Repeater::make('sections')
                    ->schema([
                        Forms\Components\TextInput::make('section_heading')
                        ->label('Section Heading')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('heading')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subheading')
                            ->maxLength(255),
                        TiptapEditor::make('description')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->columnSpanFull()
                            ->directory('services/section-images'),
                        Forms\Components\TextInput::make('button_1')
                            ->label('Button')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('button_1_url')
                            ->label('Button Link')
                            ->maxLength(255),
                       
                    ])->columnSpanFull()
                    ->columns(2),
                Forms\Components\Section::make('SEO settings')
                        ->schema([
                            Forms\Components\Textarea::make('short_description')
                            ->label('Meta description')
                                ->maxLength(500)
                                ->columnSpanFull(),
                            Forms\Components\TagsInput::make('keywords')
                                ->columnSpanFull(),
                    ])

                    

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('feature_image'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}