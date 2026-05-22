<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;


class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Pages';
      

    public static function form(Form $form): Form
    {
        return $form
        
            ->schema([

             Section::make('Slider Image Details')
                ->columns(2)
                ->schema([
                Forms\Components\FileUpload::make('bgimage')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('sliders'),
                   
                
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('sliders'),
                
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),

                Forms\Components\TextInput::make('subtitle')
                    ->maxLength(255),
                    
                
                ]),
                Section::make('M&A Council')
                ->schema([
                    Forms\Components\TextInput::make('council_title')
                    ->maxLength(255),

                    Repeater::make('ma_council')
                        ->schema([

                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('subtitle')
                                ->required()
                                ->maxLength(255),

                        ])
                        ->defaultItems(3)
                        ->minItems(3)
                        ->maxItems(3)
                        ->columns(2),

                ]),
                Section::make('Slider Details')
                ->columns(2)
                ->schema([
                    
                Forms\Components\TextInput::make('details-heading')
                                ->required()
                                ->maxLength(255),

                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
                    
                Forms\Components\TextInput::make('button_text')
                    ->label('Button Text')
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('button_url')
                    ->label('Button URL')
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0),
                    
                Forms\Components\Toggle::make('is_active')
                    ->required()
                    ->default(true),
                ]),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
           ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order');
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
