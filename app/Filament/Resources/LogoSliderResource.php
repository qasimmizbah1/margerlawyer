<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogoSliderResource\Pages;
use App\Filament\Resources\LogoSliderResource\RelationManagers;
use App\Models\LogoSlider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogoSliderResource extends Resource
{
    protected static ?string $model = LogoSlider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Forms\Components\TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('slug', \Illuminate\Support\Str::slug($state))
                ),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Repeater::make('logos')
                ->defaultItems(1)
                ->collapsed(false)
                ->addActionLabel('Add Logo')
                ->schema([

                    Forms\Components\TextInput::make('title')
                        ->label('Logo Name'),

                    Forms\Components\FileUpload::make('image')
                        ->image()
                        ->directory('logo-slider')
                        ->required(),

                    Forms\Components\TextInput::make('url')
                        ->url()
                        ->prefix('https://'),

                ])
                ->columnSpanFull(),

        ]);
    }

    public static function table(Table $table): Table
    {
       return $table
        ->columns([

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('slug')
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d M Y'),

        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListLogoSliders::route('/'),
            'create' => Pages\CreateLogoSlider::route('/create'),
            'edit' => Pages\EditLogoSlider::route('/{record}/edit'),
        ];
    }
}
